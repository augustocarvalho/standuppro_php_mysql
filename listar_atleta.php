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

<div class="container my-5">
    <h2 class="mb-4">Lista de Atletas</h2>

    <?php if ($message): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($athletes)): ?>
        <p>Nenhum atleta cadastrado.</p>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($athletes as $atleta): ?>
                    <tr>
                        <td><?= htmlspecialchars($atleta['nome']) ?></td>
                        <td><?= htmlspecialchars($atleta['cpf']) ?></td>
                        <td class="text-center">
                            <a href="inscricao.php?id=<?= urlencode($atleta['cpf']) ?>" class="btn btn-sm btn-primary me-2">
                                Inscrever
                            </a>
                            <form method="post" class="d-inline" onsubmit="return confirm('Deseja realmente excluir o atleta <?= addslashes($atleta['nome']) ?>?');">
                                <input type="hidden" name="delete_cpf" value="<?= htmlspecialchars($atleta['cpf']) ?>" />
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
