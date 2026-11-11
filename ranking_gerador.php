<?php
require_once __DIR__ . '/ranking_pontos.php';

/**
 * Rótulo do circuito usado em ranking_circuito.
 */
function ranking_circuito_label(int $circuito): string
{
    $labels = [
        1 => 'ABASUP',
        2 => 'CBSUP',        
    ];

    return $labels[$circuito] ?? ('Circuito ' . $circuito);
}

/**
 * Rótulo da quantidade de estrelas do evento.
 */
function ranking_estrelas_label(int $estrelas): string
{
    return $estrelas . ' estrela' . ($estrelas === 1 ? '' : 's');
}

/**
 * Tenta sugerir o circuito de uma etapa pelo nome ou pela associação.
 */
function ranking_circuito_sugerido(array $etapa): int
{
    $nome = strtoupper((string) ($etapa['nome_etapa'] ?? ''));

    foreach ([2 => 'CBSUP', 1 => 'ABASUP', 3 => 'BRASILEIRO', 4 => 'YCB'] as $circuito => $palavra) {
        if (strpos($nome, $palavra) !== false) {
            return $circuito;
        }
    }

    $associacao = (int) ($etapa['associacao_idassociacao'] ?? 0);
    if ($associacao >= 1 && $associacao <= 4) {
        return $associacao;
    }

    return 1;
}

/**
 * Executa uma consulta preparada e devolve todas as linhas.
 *
 * @throws RuntimeException
 */
function ranking_select(mysqli $con, string $sql, string $types = '', array $params = []): array
{
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        throw new RuntimeException('Erro ao preparar consulta: ' . $con->error);
    }

    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        $erro = $stmt->error;
        $stmt->close();
        throw new RuntimeException('Erro ao executar consulta: ' . $erro);
    }

    $result = $stmt->get_result();
    if (!$result) {
        $erro = $stmt->error;
        $stmt->close();
        throw new RuntimeException('Erro ao obter resultado: ' . $erro);
    }

    $linhas = [];
    while ($linha = $result->fetch_assoc()) {
        $linhas[] = $linha;
    }

    $stmt->close();

    return $linhas;
}

/**
 * Executa um INSERT/UPDATE/DELETE preparado e devolve o número de linhas afetadas.
 *
 * @throws RuntimeException
 */
function ranking_execute(mysqli $con, string $sql, string $types = '', array $params = []): int
{
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        throw new RuntimeException('Erro ao preparar comando: ' . $con->error);
    }

    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        $erro = $stmt->error;
        $stmt->close();
        throw new RuntimeException('Erro ao executar comando: ' . $erro);
    }

    $afetadas = $stmt->affected_rows;
    $stmt->close();

    return $afetadas;
}

/**
 * Retorna os dados de uma etapa.
 */
function ranking_etapa_info(mysqli $con, int $etapa): ?array
{
    $linhas = ranking_select(
        $con,
        'SELECT idetapa, nome_etapa, local_etapa, associacao_idassociacao
           FROM etapa
          WHERE idetapa = ?
          LIMIT 1',
        'i',
        [$etapa]
    );

    return $linhas[0] ?? null;
}

/**
 * Categorias que possuem pelo menos uma inscrição na etapa.
 */
function ranking_categorias_etapa(mysqli $con, int $etapa): array
{
    return ranking_select(
        $con,
        'SELECT DISTINCT c.idcategoria, c.descricao
           FROM categoria c
           JOIN inscricao i ON i.categoria_idcategoria = c.idcategoria
          WHERE i.etapa_idetapa = ?
          ORDER BY c.descricao',
        'i',
        [$etapa]
    );
}

/**
 * Tenta descobrir a quantidade de estrelas usada anteriormente na etapa/circuito
 * comparando a maior pontuação existente com o 1º lugar de cada tabela.
 */
function ranking_estrela_detectada(mysqli $con, int $etapa, int $circuito): ?int
{
    $linhas = ranking_select(
        $con,
        'SELECT MAX(pontos) AS max_pontos
           FROM ranking_circuito
          WHERE etapa_idetapa = ?
            AND circuito_idcircuito = ?',
        'ii',
        [$etapa, $circuito]
    );

    $maxPontos = $linhas[0]['max_pontos'] ?? null;
    if ($maxPontos === null) {
        return null;
    }

    foreach (ranking_tabela_pontos() as $estrelas => $tabela) {
        if ((int) $maxPontos === (int) $tabela[0]) {
            return (int) $estrelas;
        }
    }

    return null;
}

/**
 * Inscritos de uma categoria, ordenados como no gerar_ranking original:
 * soma das colocações (longa + técnica) e, em caso de empate, colocação da longa.
 *
 * Agrupa por atleta para evitar duplicidade quando existir mais de uma
 * inscrição do mesmo atleta na mesma categoria.
 */
function ranking_inscricoes_categoria(mysqli $con, int $etapa, int $categoria): array
{
    return ranking_select(
        $con,
        'SELECT i.atleta_cpf,
                MAX(a.nome) AS nome,
                MIN(i.podio_longa) AS podio_longa,
                MIN(i.podio_tecnica) AS podio_tecnica,
                (COALESCE(MIN(i.podio_longa), 0) + COALESCE(MIN(i.podio_tecnica), 0)) AS geral
           FROM inscricao i
           LEFT JOIN atleta a ON a.cpf = i.atleta_cpf
          WHERE i.etapa_idetapa = ?
            AND i.categoria_idcategoria = ?
          GROUP BY i.atleta_cpf
          ORDER BY (MIN(i.podio_longa) IS NULL AND MIN(i.podio_tecnica) IS NULL) ASC,
                   geral ASC,
                   COALESCE(MIN(i.podio_longa), 0) ASC,
                   i.atleta_cpf ASC',
        'ii',
        [$etapa, $categoria]
    );
}

/**
 * Insere as inscrições que ainda não existem em ranking_circuito e atualiza
 * pontos/colocação de cada atleta, sempre por categoria.
 *
 * @param array $categorias Lista de arrays com idcategoria/descricao.
 * @param bool  $aplicar    false = apenas simula; true = grava no banco.
 * @param string|null $erro Recebe a mensagem de erro, se houver.
 */
function ranking_processar_etapa(
    mysqli $con,
    int $etapa,
    int $circuito,
    int $estrelas,
    array $categorias,
    bool $aplicar,
    ?string &$erro = null
): ?array {
    $erro = null;
    $tabelaPontos = ranking_pontos_estrela($estrelas);
    $transacaoAberta = false;

    try {
        if ($aplicar && !mysqli_begin_transaction($con)) {
            throw new RuntimeException('Não foi possível iniciar a transação: ' . $con->error);
        }
        $transacaoAberta = $aplicar;

        $resumo = [
            'etapa' => $etapa,
            'circuito' => $circuito,
            'estrelas' => $estrelas,
            'inseridas' => 0,
            'atletas' => 0,
            'sem_resultado' => 0,
            'categorias' => [],
        ];

        foreach ($categorias as $categoria) {
            $idCategoria = (int) ($categoria['idcategoria'] ?? 0);
            if ($idCategoria <= 0) {
                continue;
            }

            $descricao = (string) ($categoria['descricao'] ?? ('Categoria ' . $idCategoria));

            $existentes = [];
            $linhasExistentes = ranking_select(
                $con,
                'SELECT atleta_cpf
                   FROM ranking_circuito
                  WHERE etapa_idetapa = ?
                    AND circuito_idcircuito = ?
                    AND categoria_idcategoria = ?',
                'iii',
                [$etapa, $circuito, $idCategoria]
            );
            foreach ($linhasExistentes as $linha) {
                $existentes[$linha['atleta_cpf']] = true;
            }

            $inscricoes = ranking_inscricoes_categoria($con, $etapa, $idCategoria);
            if (!$inscricoes) {
                continue;
            }

            $inseridas = 0;
            if ($aplicar) {
                $inseridas = ranking_execute(
                    $con,
                    'INSERT INTO ranking_circuito
                        (categoria_idcategoria, atleta_cpf, pontos, etapa_idetapa, colocacao, circuito_idcircuito)
                     SELECT DISTINCT i.categoria_idcategoria, i.atleta_cpf, 0, i.etapa_idetapa, 0, ?
                       FROM inscricao i
                       LEFT JOIN ranking_circuito rc
                         ON rc.atleta_cpf = i.atleta_cpf
                        AND rc.categoria_idcategoria = i.categoria_idcategoria
                        AND rc.etapa_idetapa = i.etapa_idetapa
                        AND rc.circuito_idcircuito = ?
                      WHERE i.etapa_idetapa = ?
                        AND i.categoria_idcategoria = ?
                        AND rc.atleta_cpf IS NULL',
                    'iiii',
                    [$circuito, $circuito, $etapa, $idCategoria]
                );
            } else {
                foreach ($inscricoes as $inscricao) {
                    if (!isset($existentes[$inscricao['atleta_cpf']])) {
                        $inseridas++;
                    }
                }
            }

            $linhas = [];
            $colocacao = 1;
            $semResultadoCategoria = 0;

            foreach ($inscricoes as $inscricao) {
                $cpf = (string) $inscricao['atleta_cpf'];
                $pontos = $tabelaPontos[$colocacao - 1] ?? 0;

                if ($aplicar) {
                    ranking_execute(
                        $con,
                        'UPDATE ranking_circuito
                            SET pontos = ?, colocacao = ?
                          WHERE atleta_cpf = ?
                            AND categoria_idcategoria = ?
                            AND etapa_idetapa = ?
                            AND circuito_idcircuito = ?',
                        'iisiii',
                        [$pontos, $colocacao, $cpf, $idCategoria, $etapa, $circuito]
                    );
                }

                $semResultado = $inscricao['podio_longa'] === null && $inscricao['podio_tecnica'] === null;
                if ($semResultado) {
                    $semResultadoCategoria++;
                }

                $linhas[] = [
                    'atleta_cpf' => $cpf,
                    'nome' => $inscricao['nome'],
                    'colocacao' => $colocacao,
                    'pontos' => $pontos,
                    'inserido' => !isset($existentes[$cpf]),
                    'sem_resultado' => $semResultado,
                ];

                $colocacao++;
            }

            $resumo['inseridas'] += $inseridas;
            $resumo['atletas'] += count($linhas);
            $resumo['sem_resultado'] += $semResultadoCategoria;
            $resumo['categorias'][] = [
                'idcategoria' => $idCategoria,
                'descricao' => $descricao,
                'inseridas' => $inseridas,
                'sem_resultado' => $semResultadoCategoria,
                'linhas' => $linhas,
            ];
        }

        if ($aplicar) {
            if (!mysqli_commit($con)) {
                throw new RuntimeException('Não foi possível confirmar a transação: ' . $con->error);
            }
            $transacaoAberta = false;
        }

        return $resumo;
    } catch (Throwable $e) {
        if ($transacaoAberta) {
            mysqli_rollback($con);
        }
        $erro = $e->getMessage();

        return null;
    }
}
