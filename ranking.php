<?php
$titulo = "Rankings";
require_once "config.php";
require_once "menu.php";

/**
 * Localiza os rankings de um circuito a partir dos arquivos existentes.
 * Retorna [ano => arquivo], ordenado do ano mais recente para o mais antigo.
 */
function rankings_por_padrao(string $padrao): array
{
    $arquivos = [];

    foreach (glob(__DIR__ . '/' . $padrao) ?: [] as $caminho) {
        if (preg_match('/_(\d{4})\.php$/', $caminho, $encontrado)) {
            $arquivos[(int) $encontrado[1]] = basename($caminho);
        }
    }

    krsort($arquivos);

    return $arquivos;
}

function h_ranking($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$circuitos = [
    'abasup' => 'ABASUP',
    'cbsup' => 'CBSUP',
];

$rankings = [
    'abasup' => rankings_por_padrao('ranking_categoria_*.php'),
    'cbsup' => rankings_por_padrao('ranking_cbsup_*.php'),
];

// O ranking ABASUP 2017 usa o nome original do arquivo, sem o ano.
if (is_file(__DIR__ . '/ranking_categoria.php')) {
    $rankings['abasup'][2017] = 'ranking_categoria.php';
    krsort($rankings['abasup']);
}

$circuitoParam = $_GET['circuito'] ?? 'abasup';
$circuito = is_string($circuitoParam) ? strtolower($circuitoParam) : 'abasup';
if (!isset($rankings[$circuito])) {
    $circuito = 'abasup';
}

$anos = array_keys($rankings[$circuito]);
$anoParam = $_GET['ano'] ?? null;
$ano = is_scalar($anoParam) ? (int) $anoParam : 0;
if (!in_array($ano, $anos, true)) {
    $ano = $anos[0] ?? 0;
}

$arquivoSelecionado = $ano > 0 ? $rankings[$circuito][$ano] : null;
?>

<style>
    .rankings-card {
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid #e1e6ec;
        border-radius: 8px;
        padding: 28px;
        margin-top: 75px;
        margin-bottom: 35px;
    }
    .rankings-card h2 {
        margin-top: 0;
        text-align: center;
    }
    .rankings-card .lead {
        text-align: center;
        color: #5a6470;
        margin-bottom: 22px;
    }
    .rankings-forma td {
        padding: 5px 12px 5px 0;
        vertical-align: middle;
    }
    .rankings-selecionado {
        background: #eef6ff;
        border: 1px solid #c9e0f7;
        border-radius: 6px;
        padding: 18px 22px;
        margin: 24px 0;
        text-align: center;
    }
    .rankings-selecionado h3 {
        margin: 8px 0 15px;
    }
</style>

<div class="container">
    <div class="rankings-card">
        <h2>RANKINGS</h2>
        <p class="lead">
            Selecione o circuito e o ano para acessar o ranking.
        </p>

        <form method="get" action="ranking.php" class="rankings-forma">
            <table>
                <tr>
                    <td><strong>CIRCUITO:</strong></td>
                    <td>
                        <select name="circuito" id="circuito" class="selectpicker" onchange="this.form.submit()">
                            <?php foreach ($circuitos as $codigo => $nome): ?>
                                <option value="<?= h_ranking($codigo) ?>" <?= $codigo === $circuito ? 'selected' : '' ?>>
                                    <?= h_ranking($nome) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>ANO:</strong></td>
                    <td>
                        <select name="ano" id="ano" class="selectpicker" onchange="this.form.submit()">
                            <?php if (!$anos): ?>
                                <option value="">Nenhum ano disponível</option>
                            <?php endif; ?>
                            <?php foreach ($anos as $anoDisponivel): ?>
                                <option value="<?= (int) $anoDisponivel ?>" <?= $anoDisponivel === $ano ? 'selected' : '' ?>>
                                    <?= (int) $anoDisponivel ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>

        <?php if ($arquivoSelecionado): ?>
            <div class="rankings-selecionado">
                <span class="label label-info"><?= h_ranking($circuitos[$circuito]) ?></span>
                <h3>Ranking <?= h_ranking($circuitos[$circuito]) ?> <?= (int) $ano ?></h3>
                <a class="btn btn-primary" href="<?= h_ranking($arquivoSelecionado) ?>">
                    Abrir ranking <?= h_ranking($circuitos[$circuito]) ?> <?= (int) $ano ?>
                </a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Nenhum ranking encontrado para este circuito.</div>
        <?php endif; ?>
    </div>
</div>
