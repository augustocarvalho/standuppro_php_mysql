<?php
require_once "config.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idetapa = intval($_POST['idetapa']);
    $nome_etapa = trim($_POST['nome_etapa']);
    $local_etapa = trim($_POST['local_etapa']);
    $associacao_id = intval($_POST['associacao_idassociacao']);

    if ($idetapa && $nome_etapa && $local_etapa && $associacao_id) {
        // Prepare insert
        $stmt = $con->prepare("INSERT INTO etapa (idetapa, nome_etapa, local_etapa, associacao_idassociacao) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $idetapa, $nome_etapa, $local_etapa, $associacao_id);

        if ($stmt->execute()) {
            $message = "Etapa criada com sucesso!";
        } else {
            $message = "Erro ao criar etapa: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Por favor, preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Nova Etapa</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 30px auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type=text], input[type=number] { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; font-weight: bold; cursor: pointer; }
        .message { margin-top: 20px; font-weight: bold; color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Criar Nova Etapa</h2>

<?php if ($message): ?>
    <div class="message <?= strpos($message, 'Erro') === false ? '' : 'error' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <label for="idetapa">ID da Etapa:</label>
    <input type="number" id="idetapa" name="idetapa" required>

    <label for="nome_etapa">Nome da Etapa:</label>
    <input type="text" id="nome_etapa" name="nome_etapa" required>

    <label for="local_etapa">Local da Etapa:</label>
    <input type="text" id="local_etapa" name="local_etapa" required>

    <label for="associacao_idassociacao">ID da Associação:</label>
    <input type="number" id="associacao_idassociacao" name="associacao_idassociacao" required>

    <button type="submit">Criar Etapa</button>
</form>

</body>
</html>
