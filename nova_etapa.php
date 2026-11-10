<?php
require_once "config.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_etapa = trim($_POST['nome_etapa']);
    $local_etapa = trim($_POST['local_etapa']);
    $associacao_id = intval($_POST['associacao_idassociacao']);

    if ($nome_etapa && $local_etapa && $associacao_id) {
        // Prepare insert (idetapa is generated automatically by AUTO_INCREMENT)
        $stmt = $con->prepare("INSERT INTO etapa (nome_etapa, local_etapa, associacao_idassociacao) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nome_etapa, $local_etapa, $associacao_id);

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

require_once "menu.php";
?>

<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 align="center">CRIAR NOVA ETAPA</h3>
            <br>
            <br>
        </div>

        <?php if ($message): ?>
            <div class="alert <?= (strpos($message, 'Erro') !== false || strpos($message, 'Por favor') !== false) ? 'alert-error' : 'alert-success' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" method="post" action="nova_etapa.php">
            <div class="control-group">
                <label class="control-label" for="nome_etapa">Nome da Etapa</label>
                <div class="controls">
                    <input style="min-height:35px;" type="text" id="nome_etapa" name="nome_etapa" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="local_etapa">Local da Etapa</label>
                <div class="controls">
                    <input style="min-height:35px;" type="text" id="local_etapa" name="local_etapa" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="associacao_idassociacao">ID da Associação</label>
                <div class="controls">
                    <input style="min-height:35px;" type="number" id="associacao_idassociacao" name="associacao_idassociacao" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Criar Etapa</button>
                <a class="btn" href="index.php">Back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
