<?php
require_once "config.php";
require_once "ranking_gerador.php";

$acao = $_POST['acao'] ?? '';

$etapaSelecionada = isset($_POST['etapa'])
    ? (int) $_POST['etapa']
    : (isset($_GET['etapa']) ? (int) $_GET['etapa'] : (isset($_GET['id']) ? (int) $_GET['id'] : 0));

$circuitoSelecionado = isset($_POST['circuito'])
    ? (int) $_POST['circuito']
    : (isset($_GET['circuito']) ? (int) $_GET['circuito'] : 0);

$estrelasSelecionadas = isset($_POST['estrelas'])
    ? (int) $_POST['estrelas']
    : (isset($_GET['estrelas']) ? (int) $_GET['estrelas'] : 0);

$categoriasPost = $_POST['categorias'] ?? [];
if (!is_array($categoriasPost)) {
    $categoriasPost = [];
}
$categoriasSelecionadas = array_values(array_unique(array_map('intval', $categoriasPost)));

try {
    $etapas = ranking_select(
        $con,
        'SELECT idetapa, nome_etapa, local_etapa, associacao_idassociacao
           FROM etapa
          ORDER BY idetapa DESC'
    );

    if ($etapaSelecionada <= 0 && $etapas) {
        $etapaSelecionada = (int) $etapas[0]['idetapa'];
    }

    $etapaInfo = $etapaSelecionada > 0 ? ranking_etapa_info($con, $etapaSelecionada) : null;

    if (!$etapaInfo && $etapas) {
        $etapaSelecionada = (int) $etapas[0]['idetapa'];
        $etapaInfo = ranking_etapa_info($con, $etapaSelecionada);
    }

    if ($circuitoSelecionado <= 0) {
        $circuitoSelecionado = $etapaInfo ? ranking_circuito_sugerido($etapaInfo) : 1;
    }

    if ($estrelasSelecionadas <= 0) {
        $estrelaDetectada = $etapaInfo ? ranking_estrela_detectada($con, $etapaSelecionada, $circuitoSelecionado) : null;
        $estrelasSelecionadas = $estrelaDetectada ?: 1;
    }

    $categorias = $etapaSelecionada > 0 ? ranking_categorias_etapa($con, $etapaSelecionada) : [];

    if ($acao !== 'simular' && $acao !== 'gerar') {
        $categoriasSelecionadas = array_map(static function (array $categoria): int {
            return (int) $categoria['idcategoria'];
        }, $categorias);
    }
} catch (Throwable $e) {
    $etapas = [];
    $etapaInfo = null;
    $categorias = [];
    $erro = $e->getMessage();
}

$categoriasMarcadas = array_fill_keys($categoriasSelecionadas, true);
$erro = $erro ?? '';
$resultado = null;

if ($acao === 'simular' || $acao === 'gerar') {
    if (!$etapaInfo) {
        $erro = 'Selecione uma etapa válida.';
    } elseif ($circuitoSelecionado < 1 || $circuitoSelecionado > 4) {
        $erro = 'Selecione um circuito válido.';
    } elseif ($estrelasSelecionadas < 1 || $estrelasSelecionadas > 5) {
        $erro = 'Selecione a quantidade de estrelas do evento.';
    } elseif (!$categorias) {
        $erro = 'Nenhuma inscrição encontrada para esta etapa.';
    } else {
        $disponiveis = [];
        foreach ($categorias as $categoria) {
            $disponiveis[(int) $categoria['idcategoria']] = $categoria;
        }

        $categoriasProcessar = [];
        foreach ($categoriasSelecionadas as $idCategoria) {
            if (isset($disponiveis[$idCategoria])) {
                $categoriasProcessar[] = $disponiveis[$idCategoria];
            }
        }

        if (!$categoriasProcessar) {
            $erro = 'Selecione ao menos uma categoria para gerar o ranking.';
        } else {
            $erroProcessamento = null;
            $resultado = ranking_processar_etapa(
                $con,
                $etapaSelecionada,
                $circuitoSelecionado,
                $estrelasSelecionadas,
                $categoriasProcessar,
                $acao === 'gerar',
                $erroProcessamento
            );

            if ($resultado === null) {
                $erro = $erroProcessamento ?: 'Não foi possível gerar o ranking.';
            }
        }
    }
}

function h($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function nomeAtletaRanking($nome, string $cpf): string
{
    if ($nome === null || $nome === '') {
        return 'Atleta não cadastrado (' . $cpf . ')';
    }

    return ucwords(strtolower($nome));
}

$tabelaPontos = ranking_pontos_estrela($estrelasSelecionadas);

require_once "menu.php";
?>

<style>
    .ranking-card {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e1e6ec;
        border-radius: 8px;
        padding: 24px;
        margin-top: 70px;
        margin-bottom: 30px;
    }
    .ranking-card h3 {
        margin-top: 0;
    }
    .ranking-form td {
        padding: 5px 10px 5px 0;
        vertical-align: middle;
    }
    .ranking-categorias {
        max-height: 260px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 12px;
        background: #fff;
    }
    .ranking-categorias label {
        display: block;
        font-weight: normal;
        margin-bottom: 3px;
    }
    .ranking-pontos {
        line-height: 28px;
        color: #555;
    }
    .ranking-pontos strong {
        color: #333;
    }
    .ranking-resultado details {
        margin-bottom: 10px;
    }
    .ranking-resultado summary {
        cursor: pointer;
        font-weight: bold;
        padding: 3px 0;
    }
    .ranking-resultado table {
        margin-top: 8px;
    }
</style>

<div class="container">
    <div class="ranking-card">
        <h3 align="center">GERAR RANKING DA ETAPA</h3>
        <p class="muted" style="text-align:center">
            A página insere automaticamente em <strong>ranking_circuito</strong> as inscrições
            que ainda não existem para a etapa/circuito e depois atualiza pontos e colocação
            categoria por categoria, usando a tabela de pontuação das estrelas do evento.
        </p>

        <?php if ($erro): ?>
            <div class="alert alert-error"><?= h($erro) ?></div>
        <?php endif; ?>

        <?php if (!$etapas): ?>
            <div class="alert alert-info">Nenhuma etapa cadastrada.</div>
        <?php endif; ?>

        <?php if ($etapaSelecionada > 0 && !$categorias && $acao !== 'simular' && $acao !== 'gerar'): ?>
            <div class="alert alert-info">Nenhuma inscrição encontrada para esta etapa.</div>
        <?php endif; ?>

        <?php if ($resultado): ?>
            <div class="alert alert-success">
                <strong><?= $acao === 'gerar' ? 'Ranking gerado!' : 'Simulação concluída.' ?></strong>
                <?php if ($acao === 'gerar'): ?>
                    <?= (int) $resultado['inseridas'] ?> inscrição(ões) adicionada(s),
                    <?= (int) $resultado['atletas'] ?> atleta(s) pontuado(s)
                    em <?= count($resultado['categorias']) ?> categoria(s).
                <?php else: ?>
                    <?= (int) $resultado['inseridas'] ?> inscrição(ões) seriam adicionada(s),
                    <?= (int) $resultado['atletas'] ?> atleta(s) receberiam pontos
                    em <?= count($resultado['categorias']) ?> categoria(s).
                    Nenhuma alteração foi gravada.
                <?php endif; ?>
                <br>
                Etapa <?= (int) $resultado['etapa'] ?><?= $etapaInfo ? ' - ' . h($etapaInfo['nome_etapa']) : '' ?> &middot;
                Circuito <?= h(ranking_circuito_label((int) $resultado['circuito'])) ?> &middot;
                <?= h(ranking_estrelas_label((int) $resultado['estrelas'])) ?>
            </div>

            <?php if ((int) $resultado['sem_resultado'] > 0): ?>
                <div class="alert alert-warning">
                    Atenção: <?= (int) $resultado['sem_resultado'] ?> atleta(s) estão sem resultado
                    (podio_longa e podio_tecnica vazios). Gere o resultado final da etapa antes
                    de pontuar o ranking se isso não for esperado.
                </div>
            <?php endif; ?>

            <div class="ranking-resultado">
                <?php foreach ($resultado['categorias'] as $categoriaResultado): ?>
                    <details>
                        <summary>
                            <?= h($categoriaResultado['descricao']) ?>
                            &mdash; <?= count($categoriaResultado['linhas']) ?> atleta(s)
                            <?php if ((int) $categoriaResultado['inseridas'] > 0): ?>
                                &middot; <?= (int) $categoriaResultado['inseridas'] ?> nova(s) inscrição(ões)
                            <?php endif; ?>
                        </summary>
                        <table class="table table-condensed table-striped" style="width:auto">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Atleta</th>
                                    <th>Colocação</th>
                                    <th>Pontos</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categoriaResultado['linhas'] as $linha): ?>
                                    <tr>
                                        <td><?= (int) $linha['colocacao'] ?></td>
                                        <td><?= h(nomeAtletaRanking($linha['nome'], $linha['atleta_cpf'])) ?></td>
                                        <td><?= (int) $linha['colocacao'] ?>º</td>
                                        <td>
                                            <?= (int) $linha['pontos'] ?>
                                            <?php if ((int) $linha['pontos'] === 0): ?>
                                                <small>(fora do top 30)</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($linha['inserido']): ?>
                                                <span class="label label-info">Inserido</span>
                                            <?php else: ?>
                                                <span class="label">Atualizado</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>
                <?php endforeach; ?>
            </div>

            <?php if ($acao === 'gerar' && in_array($circuitoSelecionado, [1, 2], true)): ?>
                <p style="margin-top:15px">
                    <a class="btn btn-primary" href="<?= $circuitoSelecionado === 1 ? 'ranking_categoria_2026.php' : 'ranking_cbsup_2026.php' ?>">
                        Ver ranking <?= h(ranking_circuito_label($circuitoSelecionado)) ?> 2026
                    </a>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <form method="post" id="rankingForm">
            <input type="hidden" name="acao" id="acao" value="">

            <table class="ranking-form">
                <tr>
                    <td><strong>ETAPA:</strong></td>
                    <td>
                        <select name="etapa" id="etapa" class="selectpicker" onchange="rankingSubmit('carregar')">
                            <?php foreach ($etapas as $etapa): ?>
                                <option value="<?= (int) $etapa['idetapa'] ?>" <?= $etapaSelecionada === (int) $etapa['idetapa'] ? 'selected' : '' ?>>
                                    <?= h($etapa['nome_etapa']) ?> - <?= h($etapa['local_etapa']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>CIRCUITO:</strong></td>
                    <td>
                        <select name="circuito" id="circuito">
                            <?php for ($circuito = 1; $circuito <= 2; $circuito++): ?>
                                <option value="<?= $circuito ?>" <?= $circuitoSelecionado === $circuito ? 'selected' : '' ?>>
                                    <?= h(ranking_circuito_label($circuito)) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        <span class="help-inline">Circuito usado na tabela ranking_circuito.</span>
                    </td>
                </tr>
                <tr>
                    <td><strong>ESTRELAS:</strong></td>
                    <td>
                        <select name="estrelas" id="estrelas">
                            <?php for ($estrelas = 1; $estrelas <= 5; $estrelas++): ?>
                                <option value="<?= $estrelas ?>" <?= $estrelasSelecionadas === $estrelas ? 'selected' : '' ?>>
                                    <?= h(ranking_estrelas_label($estrelas)) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        <span class="help-inline">Define a tabela de pontos usada no evento.</span>
                    </td>
                </tr>
            </table>

            <?php if ($estrelasSelecionadas >= 1 && $estrelasSelecionadas <= 5): ?>
                <details style="margin: 10px 0 18px">
                    <summary>Ver pontuação de <?= h(ranking_estrelas_label($estrelasSelecionadas)) ?> por colocação</summary>
                    <p class="ranking-pontos">
                        <?php foreach ($tabelaPontos as $indice => $pontos): ?>
                            <?= $indice + 1 ?>º: <strong><?= (int) $pontos ?></strong><?= $indice < count($tabelaPontos) - 1 ? ' &middot; ' : '' ?>
                        <?php endforeach; ?>
                    </p>
                </details>
            <?php endif; ?>

            <?php if ($categorias): ?>
                <h4>Categorias da etapa</h4>
                <p style="margin-bottom:8px">
                    <a href="#" onclick="rankingMarcarCategorias(true); return false;">Marcar todas</a>
                    &middot;
                    <a href="#" onclick="rankingMarcarCategorias(false); return false;">Desmarcar todas</a>
                </p>
                <div class="ranking-categorias">
                    <?php foreach ($categorias as $categoria): ?>
                        <label>
                            <input type="checkbox"
                                   name="categorias[]"
                                   value="<?= (int) $categoria['idcategoria'] ?>"
                                   <?= isset($categoriasMarcadas[(int) $categoria['idcategoria']]) ? 'checked' : '' ?>>
                            <?= h($categoria['descricao']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="form-actions" style="margin-top:18px">
                <button type="button" class="btn" onclick="rankingSubmit('carregar')">
                    Carregar categorias
                </button>
                <button type="button" class="btn btn-info" onclick="rankingSubmit('simular')">
                    Simular
                </button>
                <button type="button" class="btn btn-success"
                        onclick="if (confirm('Gerar o ranking e gravar as alterações?')) { rankingSubmit('gerar'); }">
                    Gerar ranking
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function rankingSubmit(acao) {
        document.getElementById('acao').value = acao;
        document.getElementById('rankingForm').submit();
    }

    function rankingMarcarCategorias(marcar) {
        var caixas = document.querySelectorAll('input[name="categorias[]"]');
        for (var i = 0; i < caixas.length; i++) {
            caixas[i].checked = marcar;
        }
    }
</script>
</body>
</html>
