<?php
require_once "config.php";

$message = "";
$errors = [];

// Get athlete CPF from URL parameter 'id'
$atleta_cpf = trim($_GET['id'] ?? '');

if (!$atleta_cpf) {
    die("CPF do atleta não fornecido na URL.");
}

// Fetch athlete info
$atleta_nome = "";
$atleta_data_nascimento = "";
$stmt = $con->prepare("SELECT nome, data_nascimento FROM atleta WHERE cpf = ?");
$stmt->bind_param("s", $atleta_cpf);
$stmt->execute();
$stmt->bind_result($atleta_nome, $atleta_data_nascimento);
if (!$stmt->fetch()) {
    die("Atleta com CPF informado não encontrado.");
}
$stmt->close();

// Age for the current season (same rule previously used: event year minus birth year)
$idade_atleta = null;
if (!empty($atleta_data_nascimento) && preg_match('/^(\d{4})-\d{2}-\d{2}$/', $atleta_data_nascimento, $matches)) {
    $ano_nascimento = (int)$matches[1];
    $ano_atual = (int)date("Y");

    if ($ano_nascimento >= 1900 && $ano_nascimento <= $ano_atual) {
        $idade_atleta = $ano_atual - $ano_nascimento;
    }
}

// Age-based subcategories: when an athlete enters an open category, they are also
// registered in the corresponding Master (40+), G-Master (50+) or Kahuna/Legend
// (60+) category, depending on their age. Only the highest applicable age group
// is added, matching the original behavior.
// Format: base category => [minimum age => subcategory]
$subcategorias_idade = [
    5   => [40 => 6,   50 => 7,   60 => 119],
    8   => [40 => 9,   50 => 10,  60 => 120],
    11  => [40 => 24,  50 => 25,  60 => 71],
    12  => [40 => 26,  50 => 27,  60 => 72],
    13  => [40 => 15,  50 => 16],
    14  => [40 => 22,  50 => 23],
    17  => [40 => 29,  50 => 30,  60 => 121],
    20  => [40 => 39,  50 => 43,  60 => 74],
    28  => [40 => 31,  50 => 32,  60 => 122],
    33  => [40 => 40,  50 => 44],
    45  => [40 => 95,  50 => 96],
    46  => [40 => 93,  50 => 94],
    52  => [40 => 59,  50 => 60,  60 => 78],
    53  => [40 => 55,  50 => 56,  60 => 114],
    54  => [40 => 57,  50 => 58,  60 => 115],
    61  => [40 => 76,  50 => 77],
    79  => [40 => 80,  50 => 81],
    82  => [40 => 83,  50 => 84],
    85  => [40 => 86,  50 => 87],
    88  => [40 => 89,  50 => 90,  60 => 91],
    92  => [40 => 97,  50 => 98],
    104 => [40 => 105, 50 => 106],
    107 => [40 => 108, 50 => 109],
    110 => [40 => 111, 50 => 112],
];

/**
 * Returns the age subcategory for a base category, or null when there is none.
 */
function subcategoria_por_idade(array $mapa, int $categoria_id, ?int $idade): ?int
{
    if ($idade === null || !isset($mapa[$categoria_id])) {
        return null;
    }

    $subcategoria = null;
    $idade_minima_aplicada = null;

    foreach ($mapa[$categoria_id] as $idade_minima => $subcategoria_id) {
        if ($idade >= $idade_minima && ($idade_minima_aplicada === null || $idade_minima > $idade_minima_aplicada)) {
            $subcategoria = $subcategoria_id;
            $idade_minima_aplicada = $idade_minima;
        }
    }

    return $subcategoria;
}

// Fetch the last two etapas (events)
$etapas = [];
$etapa_result = $con->query("SELECT idetapa, nome_etapa FROM etapa ORDER BY idetapa DESC LIMIT 2");
if ($etapa_result) {
    while ($row = $etapa_result->fetch_assoc()) {
        $etapas[] = $row;
    }
}

// Default to the last etapa (highest idetapa)
$etapa_padrao = $etapas[0]['idetapa'] ?? '';
$etapa_selecionada = isset($_POST['etapa']) ? $_POST['etapa'] : $etapa_padrao;

// Fetch categorias
$categorias = [];
$categoria_result = $con->query("SELECT idcategoria, descricao FROM categoria ORDER BY descricao");
if ($categoria_result) {
    while ($row = $categoria_result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etapa_id = intval($_POST['etapa'] ?? 0);
    $categoria_id = intval($_POST['categoria'] ?? 0);
    $numero = trim($_POST['numero'] ?? '');

    // Validate inputs
    if ($etapa_id <= 0) {
        $errors[] = "Por favor, selecione uma etapa válida.";
    }
    if ($categoria_id <= 0) {
        $errors[] = "Por favor, selecione uma categoria válida.";
    }
    if (empty($numero)) {
        $errors[] = "Por favor, informe o número da inscrição.";
    }

    if (!$errors) {
        // Check if the athlete is already registered in the selected category
        $stmt = $con->prepare("SELECT * FROM inscricao WHERE atleta_cpf = ? AND etapa_idetapa = ? AND categoria_idcategoria = ?");
        $stmt->bind_param("sii", $atleta_cpf, $etapa_id, $categoria_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Este atleta já está inscrito nesta etapa e categoria.";
        }
        $stmt->close();
    }

    if (!$errors) {
        // Register the selected category plus the age-based subcategory (if any)
        $categorias_inscricao = [$categoria_id];
        $subcategoria_idade = subcategoria_por_idade($subcategorias_idade, $categoria_id, $idade_atleta);

        if ($subcategoria_idade !== null && $subcategoria_idade !== $categoria_id) {
            $categorias_inscricao[] = $subcategoria_idade;
        }

        $stmt_check = $con->prepare("SELECT 1 FROM inscricao WHERE atleta_cpf = ? AND etapa_idetapa = ? AND categoria_idcategoria = ? LIMIT 1");
        $stmt_insert = $con->prepare("INSERT INTO inscricao (numero, atleta_cpf, etapa_idetapa, categoria_idcategoria) VALUES (?, ?, ?, ?)");

        $con->begin_transaction();

        foreach ($categorias_inscricao as $cat_id) {
            // Do not duplicate a subcategory the athlete already has in this etapa
            $stmt_check->bind_param("sii", $atleta_cpf, $etapa_id, $cat_id);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                $stmt_check->free_result();
                continue;
            }
            $stmt_check->free_result();

            $stmt_insert->bind_param("isii", $numero, $atleta_cpf, $etapa_id, $cat_id);

            if (!$stmt_insert->execute()) {
                $errors[] = "Erro ao realizar inscrição: " . $stmt_insert->error;
                break;
            }
        }

        $stmt_check->close();
        $stmt_insert->close();

        if ($errors) {
            $con->rollback();
        } else {
            $con->commit();

            // Redirect back to the athlete list after a successful subscription
            header("Location: listar_atleta.php?inscrito=1");
            exit;
        }
    }
}

include "menu.php";
?>


<style>
    body {
        background-image: url("stdp_atletas.jpg"), url("stdp_resultados02.jpg");
        background-repeat: no-repeat, repeat;
        background-size: 100% auto;
    }
</style>

<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 align="center">INSCREVER ATLETA NA ETAPA</h3>
            <br>
            <br>
        </div>

        <p><strong>Atleta:</strong> <?= htmlspecialchars($atleta_nome) ?> (CPF: <?= htmlspecialchars($atleta_cpf) ?><?php if ($idade_atleta !== null): ?> - <?= $idade_atleta ?> anos<?php endif; ?>)</p>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" method="post" action="">
            <div class="control-group">
                <label class="control-label" for="etapa">Etapa</label>
                <div class="controls">
                    <select name="etapa" id="etapa" required>
                        <option value="">-- Selecione a Etapa --</option>
                        <?php foreach ($etapas as $etapa): ?>
                            <option value="<?= $etapa['idetapa'] ?>" <?= $etapa_selecionada == $etapa['idetapa'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($etapa['nome_etapa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="categoria">Categoria</label>
                <div class="controls">
                    <select name="categoria" id="categoria" required>
                        <option value="">-- Selecione a Categoria --</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['idcategoria'] ?>" <?= (isset($_POST['categoria']) && $_POST['categoria'] == $cat['idcategoria']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="help-block">Atletas com 40+ também são inscritos na subcategoria Master, 50+ na G-Master e 60+ na Kahuna/Legend correspondente.</p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="numero">Número da inscrição</label>
                <div class="controls">
                    <input style="min-height:35px;" type="number" name="numero" id="numero" value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>" min="1" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Inscrever</button>
                <a class="btn" href="listar_atleta.php">Back</a>
            </div>
        </form>
    </div>
</div>
