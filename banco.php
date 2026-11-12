<?php
$titulo = "Banco de Dados";
require_once "config.php";

set_time_limit(300);

function h_banco($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

/**
 * Lista as tabelas e views do banco atual.
 *
 * @return array<int, array{nome: string, tipo: string}>
 */
function banco_tabelas(mysqli $con): array
{
    $tabelas = [];
    $resultado = $con->query('SHOW FULL TABLES');

    if (!$resultado) {
        return $tabelas;
    }

    while ($linha = $resultado->fetch_row()) {
        $tabelas[] = [
            'nome' => (string) $linha[0],
            'tipo' => (string) ($linha[1] ?? 'BASE TABLE'),
        ];
    }

    $resultado->free();

    return $tabelas;
}

function banco_identificador(string $nome): string
{
    return '`' . str_replace('`', '``', $nome) . '`';
}

/**
 * Gera um dump SQL completo (estrutura + dados) do banco.
 *
 * @throws RuntimeException
 */
function banco_exportar_sql(mysqli $con, string $banco): string
{
    $sql = "-- StandupPRO - exportacao do banco de dados\n";
    $sql .= "-- Banco: {$banco}\n";
    $sql .= '-- Gerado em: ' . date('d/m/Y H:i:s') . "\n\n";
    $sql .= "SET NAMES utf8;\n";
    $sql .= "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';\n";
    $sql .= "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;\n\n";

    $views = [];

    foreach (banco_tabelas($con) as $tabela) {
        $nome = banco_identificador($tabela['nome']);

        if ($tabela['tipo'] === 'VIEW') {
            $views[] = $nome;
            continue;
        }

        $resultado = $con->query("SHOW CREATE TABLE {$nome}");
        if (!$resultado) {
            throw new RuntimeException('Erro ao ler a estrutura de ' . $tabela['nome'] . ': ' . $con->error);
        }

        $criacao = $resultado->fetch_row();
        $resultado->free();

        $sql .= "DROP TABLE IF EXISTS {$nome};\n";
        $sql .= $criacao[1] . ";\n\n";

        $resultado = $con->query("SELECT * FROM {$nome}");
        if (!$resultado) {
            throw new RuntimeException('Erro ao ler os dados de ' . $tabela['nome'] . ': ' . $con->error);
        }

        if ($resultado->num_rows > 0) {
            $colunas = [];
            foreach ($resultado->fetch_fields() as $campo) {
                $colunas[] = banco_identificador($campo->name);
            }

            $cabecalho = "INSERT INTO {$nome} (" . implode(', ', $colunas) . ") VALUES\n";
            $valores = [];

            while ($linha = $resultado->fetch_row()) {
                $valoresLinha = [];
                foreach ($linha as $valor) {
                    $valoresLinha[] = $valor === null
                        ? 'NULL'
                        : "'" . $con->real_escape_string((string) $valor) . "'";
                }

                $valores[] = '(' . implode(', ', $valoresLinha) . ')';

                if (count($valores) >= 500) {
                    $sql .= $cabecalho . implode(",\n", $valores) . ";\n";
                    $valores = [];
                }
            }

            if ($valores) {
                $sql .= $cabecalho . implode(",\n", $valores) . ";\n";
            }

            $sql .= "\n";
        }

        $resultado->free();
    }

    // Views são recriadas depois das tabelas.
    foreach ($views as $nome) {
        $resultado = $con->query("SHOW CREATE VIEW {$nome}");
        if (!$resultado) {
            throw new RuntimeException('Erro ao ler a view ' . $nome . ': ' . $con->error);
        }

        $criacao = $resultado->fetch_row();
        $resultado->free();

        $sql .= "DROP VIEW IF EXISTS {$nome};\n";
        $sql .= $criacao[1] . ";\n\n";
    }

    $sql .= "SET SQL_MODE=@OLD_SQL_MODE;\n";
    $sql .= "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;\n";

    return $sql;
}

function banco_tamanho(mysqli $con, string $banco): float
{
    $bancoEscapado = $con->real_escape_string($banco);
    $resultado = $con->query(
        "SELECT COALESCE(SUM(data_length + index_length), 0) AS bytes
           FROM information_schema.TABLES
          WHERE table_schema = '{$bancoEscapado}'
            AND table_type = 'BASE TABLE'"
    );

    if (!$resultado) {
        return 0;
    }

    $linha = $resultado->fetch_assoc();
    $resultado->free();

    return ((int) ($linha['bytes'] ?? 0)) / 1024 / 1024;
}

$tabelas = banco_tabelas($con);
$totalTabelas = count(array_filter($tabelas, static fn(array $tabela): bool => $tabela['tipo'] !== 'VIEW'));
$tamanhoBanco = banco_tamanho($con, $bd);
$mensagemImportacao = '';
$erroImportacao = '';
$importacaoIniciada = false;

// Exportação: responde antes de qualquer HTML ser enviado.
if (($_GET['acao'] ?? '') === 'exportar') {
    $formato = ($_GET['formato'] ?? 'sql') === 'gz' ? 'gz' : 'sql';

    try {
        $conteudo = banco_exportar_sql($con, $bd);
    } catch (Throwable $e) {
        http_response_code(500);
        echo 'Não foi possível exportar o banco: ' . h_banco($e->getMessage());
        exit;
    }

    $nomeArquivo = 'circuito_' . date('Y-m-d_His');

    if ($formato === 'gz') {
        $conteudo = gzencode($conteudo, 9);
        $nomeArquivo .= '.sql.gz';
        $tipoConteudo = 'application/gzip';
    } else {
        $nomeArquivo .= '.sql';
        $tipoConteudo = 'application/sql; charset=utf-8';
    }

    header('Content-Type: ' . $tipoConteudo);
    header('Content-Disposition: attachment; filename="' . $nomeArquivo . '"');
    header('Content-Length: ' . strlen($conteudo));
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    echo $conteudo;
    exit;
}

// Importação: substitui as tabelas existentes pelo conteúdo do arquivo.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'importar') {
    $mensagensErroUpload = [
        UPLOAD_ERR_INI_SIZE => 'O arquivo excede o limite de upload do servidor (' . ini_get('upload_max_filesize') . ').',
        UPLOAD_ERR_FORM_SIZE => 'O arquivo excede o limite permitido pelo formulário.',
        UPLOAD_ERR_PARTIAL => 'O envio do arquivo foi interrompido. Tente novamente.',
        UPLOAD_ERR_NO_FILE => 'Selecione um arquivo para importar.',
        UPLOAD_ERR_NO_TMP_DIR => 'O servidor não possui diretório temporário para o upload.',
        UPLOAD_ERR_CANT_WRITE => 'O servidor não conseguiu gravar o arquivo enviado.',
        UPLOAD_ERR_EXTENSION => 'O envio do arquivo foi bloqueado pelo servidor.',
    ];

    try {
        if (empty($_POST['confirmar'])) {
            throw new RuntimeException('Marque a confirmação antes de importar.');
        }

        if (!isset($_FILES['arquivo']) || !is_array($_FILES['arquivo'])) {
            throw new RuntimeException('Selecione um arquivo para importar.');
        }

        $arquivo = $_FILES['arquivo'];
        $erroUpload = (int) ($arquivo['error'] ?? UPLOAD_ERR_NO_FILE);

        if ($erroUpload !== UPLOAD_ERR_OK) {
            throw new RuntimeException($mensagensErroUpload[$erroUpload] ?? 'Não foi possível receber o arquivo.');
        }

        $nomeOriginal = (string) ($arquivo['name'] ?? '');
        $caminhoTemporario = (string) ($arquivo['tmp_name'] ?? '');

        if (!preg_match('/\.(sql|gz)$/i', $nomeOriginal)) {
            throw new RuntimeException('Envie um arquivo .sql ou .sql.gz.');
        }

        $conteudo = @file_get_contents($caminhoTemporario);
        if ($conteudo === false || trim($conteudo) === '') {
            throw new RuntimeException('O arquivo enviado está vazio ou não pôde ser lido.');
        }

        if (strncmp($conteudo, "\x1f\x8b", 2) === 0 || preg_match('/\.gz$/i', $nomeOriginal)) {
            $conteudoDescompactado = @gzdecode($conteudo);
            if ($conteudoDescompactado === false) {
                throw new RuntimeException('Não foi possível descompactar o arquivo .gz.');
            }
            $conteudo = $conteudoDescompactado;
        }

        // Remove BOM UTF-8, que atrapalha a primeira instrução.
        if (strncmp($conteudo, "\xEF\xBB\xBF", 3) === 0) {
            $conteudo = substr($conteudo, 3);
        }

        if (preg_match('/^\s*DELIMITER\b/im', $conteudo)) {
            throw new RuntimeException(
                'O arquivo contém a diretiva DELIMITER, que não é suportada. ' .
                'Exporte novamente sem rotinas ou triggers.'
            );
        }

        $con->query("SET SESSION sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");
        $con->query('SET FOREIGN_KEY_CHECKS=0');

        $importacaoIniciada = true;

        if (!$con->multi_query($conteudo)) {
            throw new RuntimeException($con->error);
        }

        do {
            $resultado = $con->store_result();
            if ($resultado) {
                $resultado->free();
            }

            if (!$con->more_results()) {
                break;
            }

            if (!$con->next_result()) {
                throw new RuntimeException($con->error);
            }
        } while (true);

        $con->query('SET FOREIGN_KEY_CHECKS=1');

        header('Location: banco.php?importado=1');
        exit;
    } catch (Throwable $e) {
        $erroImportacao = $e->getMessage();
    }
}

if (($_GET['importado'] ?? '') === '1') {
    $mensagemImportacao = 'Banco de dados importado com sucesso.';
}

require_once "menu.php";
?>

<style>
    .banco-card {
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid #e1e6ec;
        border-radius: 8px;
        padding: 28px;
        margin-top: 75px;
        margin-bottom: 35px;
    }
    .banco-card h2 {
        margin-top: 0;
        text-align: center;
    }
    .banco-card .lead {
        text-align: center;
        color: #5a6470;
        margin-bottom: 24px;
    }
    .banco-info {
        background: #f6f9fc;
        border: 1px solid #dde6ee;
        border-radius: 6px;
        padding: 10px 15px;
        margin-bottom: 15px;
        color: #53606d;
    }
    .banco-secao {
        border-top: 1px solid #e5ebf1;
        margin-top: 28px;
        padding-top: 22px;
    }
    .banco-secao h3 {
        margin-top: 0;
    }
    .banco-exportar .btn {
        margin-right: 8px;
        margin-bottom: 8px;
    }
    .banco-importar input[type="file"] {
        margin-bottom: 12px;
    }
    .banco-importar label.checkbox {
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="banco-card">
        <h2>BANCO DE DADOS</h2>
        <p class="lead">
            Exporte uma cópia completa do banco ou restaure os dados a partir de um arquivo SQL.
        </p>

        <?php if ($mensagemImportacao): ?>
            <div class="alert alert-success"><?= h_banco($mensagemImportacao) ?></div>
        <?php endif; ?>

        <?php if ($erroImportacao): ?>
            <div class="alert alert-error">
                <strong>Erro na importação:</strong> <?= h_banco($erroImportacao) ?>
                <?php if ($importacaoIniciada): ?>
                    <br>
                    <small>A importação pode ter sido aplicada parcialmente. Verifique os dados.</small>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="banco-info">
            Banco <strong><?= h_banco($bd) ?></strong>
            &middot; <?= (int) $totalTabelas ?> tabela(s)
            &middot; <?= number_format($tamanhoBanco, 2, ',', '.') ?> MB
        </div>

        <div class="banco-secao banco-exportar">
            <h3>Exportar</h3>
            <p>Baixe a estrutura e todos os dados do banco em um único arquivo.</p>
            <a class="btn btn-primary" href="banco.php?acao=exportar&amp;formato=gz">
                Baixar .sql.gz (recomendado)
            </a>
            <a class="btn" href="banco.php?acao=exportar&amp;formato=sql">
                Baixar .sql
            </a>
        </div>

        <div class="banco-secao banco-importar">
            <h3>Importar</h3>
            <p class="text-error">
                <strong>Atenção:</strong> a importação substitui as tabelas atuais pelos dados do arquivo.
                Faça uma exportação antes de continuar.
            </p>
            <p class="muted">
                Aceita arquivos <code>.sql</code> e <code>.sql.gz</code>.
                Limite de upload do servidor: <?= h_banco(ini_get('upload_max_filesize')) ?>.
            </p>

            <form method="post" action="banco.php" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="importar">

                <input type="file" name="arquivo" accept=".sql,.gz,application/sql,application/gzip" required>

                <label class="checkbox">
                    <input type="checkbox" name="confirmar" value="1" required>
                    Confirmo que os dados atuais serão substituídos pelo conteúdo do arquivo.
                </label>

                <div class="form-actions" style="margin-top:15px">
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Importar o arquivo e substituir os dados atuais?');">
                        Importar banco
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
