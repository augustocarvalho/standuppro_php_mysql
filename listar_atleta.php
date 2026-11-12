<?php
include "menu.php"; // Assuming this includes Bootstrap and header HTML

$message = "";
$error = "";

if (isset($_GET['inscrito'])) {
    $message = "Inscrição realizada com sucesso!";
}

if (isset($_GET['editado'])) {
    $message = "Atleta alterado com sucesso!";
}

/**
 * Busca atletas pelo nome. Sem termo, retorna todos.
 *
 * @return array<int, array{cpf: string, nome: string, cidade: ?string, estado: ?string}>
 */
function buscar_atletas(mysqli $con, string $busca = ''): array
{
    $busca = trim($busca);
    $atletas = [];

    if ($busca === '') {
        $resultado = $con->query("SELECT cpf, nome, cidade, estado FROM atleta ORDER BY nome");
    } else {
        $stmt = $con->prepare(
            "SELECT cpf, nome, cidade, estado
               FROM atleta
              WHERE nome LIKE ?
              ORDER BY nome"
        );

        // Trata os curingas do LIKE como texto digitado pelo usuário.
        $termo = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $busca) . '%';
        $stmt->bind_param("s", $termo);
        $stmt->execute();
        $resultado = $stmt->get_result();
    }

    while ($linha = $resultado->fetch_assoc()) {
        $atletas[] = $linha;
    }

    if (isset($stmt)) {
        $stmt->close();
    } else {
        $resultado->free();
    }

    return $atletas;
}

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

$busca = trim((string) ($_GET['busca'] ?? ''));
$athletes = buscar_atletas($con, $busca);
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

    <form method="get" action="listar_atleta.php" class="form-inline" style="width:700px; margin:18px auto 14px; text-align:center;">
        <input type="text"
               name="busca"
               class="input-xlarge search-query"
               placeholder="Buscar atleta pelo nome"
               value="<?= htmlspecialchars($busca) ?>">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <?php if ($busca !== ''): ?>
            <a class="btn" href="listar_atleta.php">Limpar</a>
        <?php endif; ?>
    </form>

    <?php if (empty($athletes)): ?>
        <?php if ($busca !== ''): ?>
            <p style="text-align:center;">Nenhum atleta encontrado para “<?= htmlspecialchars($busca) ?>”.</p>
        <?php else: ?>
            <p style="text-align:center;">Nenhum atleta cadastrado.</p>
        <?php endif; ?>
    <?php else: ?>
        <p style="text-align:center; color:#666;">
            <?= count($athletes) ?> atleta(s) encontrado(s)
        </p>
        <table class="table" style="width:700px; margin:auto;">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>CPF</th>
                    <th>CIDADE</th>
                    <th>UF</th>
                    <th class="text-center" style="white-space:nowrap;">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($athletes as $atleta): ?>
                    <tr>
                        <td><?= htmlspecialchars($atleta['nome']) ?></td>
                        <td><?= htmlspecialchars($atleta['cpf']) ?></td>
                        <td><?= htmlspecialchars($atleta['cidade'] ?? '') ?></td>
                        <td><?= htmlspecialchars($atleta['estado'] ?? '') ?></td>
                        <td class="text-center" style="white-space:nowrap;">
                            <a href="update.php?id=<?= urlencode($atleta['cpf']) ?>" class="btn btn-small btn-warning" style="margin-right:4px;">
                                Editar
                            </a>
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
