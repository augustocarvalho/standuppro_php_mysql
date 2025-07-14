<?php
require_once "config.php";
include "menu.php";

$message = "";
$errors = [];

// Get athlete CPF from URL parameter 'id'
$atleta_cpf = trim($_GET['id'] ?? '');

if (!$atleta_cpf) {
    die("CPF do atleta não fornecido na URL.");
}

// Fetch athlete info (optional: to show athlete name)
$atleta_nome = "";
$stmt = $con->prepare("SELECT nome FROM atleta WHERE cpf = ?");
$stmt->bind_param("s", $atleta_cpf);
$stmt->execute();
$stmt->bind_result($atleta_nome);
if (!$stmt->fetch()) {
    die("Atleta com CPF informado não encontrado.");
}
$stmt->close();

// Fetch etapas (events)
$etapas = [];
$etapa_result = $con->query("SELECT idetapa, nome_etapa FROM etapa ORDER BY idetapa DESC");
if ($etapa_result) {
    while ($row = $etapa_result->fetch_assoc()) {
        $etapas[] = $row;
    }
}

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
        // Check if subscription already exists
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
        // Insert subscription
        $stmt = $con->prepare("INSERT INTO inscricao (numero, atleta_cpf, etapa_idetapa, categoria_idcategoria) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $numero, $atleta_cpf, $etapa_id, $categoria_id);

        if ($stmt->execute()) {
            $message = "Inscrição realizada com sucesso!";
        } else {
            $errors[] = "Erro ao realizar inscrição: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>


<div class="container my-5">
    <h2 class="mb-4">Inscrever Atleta na Etapa</h2>


    <p><strong>Atleta:</strong> <?= htmlspecialchars($atleta_nome) ?> (CPF: <?= htmlspecialchars($atleta_cpf) ?>)</p>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="etapa">Etapa:</label>
        <select name="etapa" id="etapa" required>
            <option value="">-- Selecione a Etapa --</option>
            <?php foreach ($etapas as $etapa): ?>
                <option value="<?= $etapa['idetapa'] ?>" <?= (isset($_POST['etapa']) && $_POST['etapa'] == $etapa['idetapa']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($etapa['nome_etapa']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <option value="">-- Selecione a Categoria --</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['idcategoria'] ?>" <?= (isset($_POST['categoria']) && $_POST['categoria'] == $cat['idcategoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['descricao']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="numero">Número da inscrição:</label>
        <input type="number" name="numero" id="numero" value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>" min="1" required>

        <button type="submit">Inscrever</button>
    </form>

</div>    