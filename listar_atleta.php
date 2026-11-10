<?php
include "menu.php"; // Assuming this includes Bootstrap and header HTML

$message = "";
$error = "";

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_cpf'])) {
    $cpf_to_delete = $_POST['delete_cpf'];

    $stmt = $con->prepare("DELETE FROM atleta WHERE cpf = ?");
    $stmt->bind_param("s", $cpf_to_delete);

    if ($stmt->execute()) {
        $message = "Atleta com CPF $cpf_to_delete removido com sucesso.";
    } else {
        $error = "Erro ao remover atleta: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch athletes
$athletes = [];
$result = $con->query("SELECT cpf, nome FROM atleta ORDER BY nome");
while ($row = $result->fetch_assoc()) {
    $athletes[] = $row;
}
?>

<style>
    body {
        background-image: url("stdp_atletas.jpg"), url("stdp_resultados02.jpg");
        background-repeat: no-repeat, repeat;
        background-size: 100% auto;
    }
</style>

<div class="container my-5">
    <h2 align="center">Lista de Atletas</h2>

    <?php if ($message): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($athletes)): ?>
        <p>Nenhum atleta cadastrado.</p>
    <?php else: ?>
        <table class="table" style="width:700px; margin:auto;">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th class="text-center" style="white-space:nowrap;">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($athletes as $atleta): ?>
                    <tr>
                        <td><?= htmlspecialchars($atleta['nome']) ?></td>
                        <td><?= htmlspecialchars($atleta['cpf']) ?></td>
                        <td class="text-center" style="white-space:nowrap;">
                            <a href="inscricao.php?id=<?= urlencode($atleta['cpf']) ?>" class="btn btn-small btn-primary" style="margin-right:4px;">
                                Inscrever
                            </a>
                            <form method="post" style="display:inline; margin:0;" onsubmit="return confirm('Deseja realmente excluir o atleta <?= addslashes($atleta['nome']) ?>?');">
                                <input type="hidden" name="delete_cpf" value="<?= htmlspecialchars($atleta['cpf']) ?>" />
                                <button type="submit" class="btn btn-small btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
