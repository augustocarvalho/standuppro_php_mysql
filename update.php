<?php
require_once "config.php";

// CPF do atleta a ser alterado (chave primária da tabela atleta)
$cpf = trim((string) ($_GET['id'] ?? ''));

if ($cpf === '') {
    header("Location: listar_atleta.php");
    exit;
}

// Carrega os dados atuais do atleta
$stmt = $con->prepare(
    "SELECT cpf, nome, estado, data_nascimento, sexo, email, cod_cbsup, cidade, categoria_idcategoria
       FROM atleta
      WHERE cpf = ?"
);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$resultado = $stmt->get_result();
$atleta = $resultado->fetch_assoc();
$stmt->close();

if (!$atleta) {
    header("Location: listar_atleta.php");
    exit;
}

$errors = [];

$nome = $atleta['nome'] ?? '';
$data_nascimento = $atleta['data_nascimento'] ?? '';
$sexo = $atleta['sexo'] ?? '';
$email = $atleta['email'] ?? '';
$estado = $atleta['estado'] ?? '';
$cidade = $atleta['cidade'] ?? '';
$cod_cbsup = $atleta['cod_cbsup'] ?? '';
$categoria_id = $atleta['categoria_idcategoria'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');
    $sexo = trim($_POST['sexo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $estado = strtoupper(trim($_POST['estado'] ?? ''));
    $cidade = trim($_POST['cidade'] ?? '');
    $cod_cbsup = trim($_POST['cod_cbsup'] ?? '');
    $categoria_id = trim($_POST['categoria'] ?? '');

    if ($nome === '') {
        $errors[] = "Por favor, informe o nome do atleta.";
    }

    if ($data_nascimento !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_nascimento)) {
        $errors[] = "Data de nascimento inválida.";
    }

    if ($sexo !== '' && !in_array($sexo, ['M', 'F'], true)) {
        $errors[] = "Sexo inválido.";
    }

    if ($estado !== '' && !preg_match('/^[A-Z]{2}$/', $estado)) {
        $errors[] = "O estado deve ter duas letras (UF).";
    }

    if ($cod_cbsup !== '' && !ctype_digit($cod_cbsup)) {
        $errors[] = "O código CBSUP deve ser numérico.";
    }

    if ($categoria_id !== '' && !ctype_digit($categoria_id)) {
        $errors[] = "Categoria inválida.";
    }

    if (!$errors) {
        // Campos opcionais vazios são gravados como NULL
        $data_nascimento_valor = $data_nascimento !== '' ? $data_nascimento : null;
        $sexo_valor = $sexo !== '' ? $sexo : null;
        $cod_cbsup_valor = $cod_cbsup !== '' ? (int) $cod_cbsup : null;
        $categoria_valor = $categoria_id !== '' ? (int) $categoria_id : null;

        $stmt = $con->prepare(
            "UPDATE atleta
                SET nome = ?,
                    data_nascimento = ?,
                    sexo = ?,
                    email = ?,
                    estado = ?,
                    cidade = ?,
                    cod_cbsup = ?,
                    categoria_idcategoria = ?
              WHERE cpf = ?"
        );
        $stmt->bind_param(
            "ssssssiis",
            $nome,
            $data_nascimento_valor,
            $sexo_valor,
            $email,
            $estado,
            $cidade,
            $cod_cbsup_valor,
            $categoria_valor,
            $cpf
        );

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: listar_atleta.php?editado=1");
            exit;
        }

        $errors[] = "Erro ao alterar atleta: " . $stmt->error;
        $stmt->close();
    }
}

// Categorias cadastradas no banco
$categorias = [];
$categoria_result = $con->query("SELECT idcategoria, descricao FROM categoria ORDER BY descricao");
if ($categoria_result) {
    while ($row = $categoria_result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

include "menu.php";
?>

<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 align="center">ALTERAR ATLETA</h3>
            <br>
            <br>
        </div>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" action="update.php?id=<?= urlencode($cpf) ?>" method="post">
            <div class="control-group">
                <label class="control-label">CPF</label>
                <div class="controls">
                    <input style="min-height:35px;" type="text" value="<?= htmlspecialchars($cpf) ?>" disabled>
                    <span class="help-inline">O CPF não pode ser alterado.</span>
                </div>
            </div>

            <div class="control-group <?= $nome === '' ? 'error' : '' ?>">
                <label class="control-label" for="nome">Nome</label>
                <div class="controls">
                    <input style="min-height:35px;" name="nome" id="nome" type="text" autofocus required
                           placeholder="Nome" value="<?= htmlspecialchars($nome) ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="data_nascimento">Data de Nascimento</label>
                <div class="controls">
                    <input style="min-height:35px;" name="data_nascimento" id="data_nascimento" type="date"
                           value="<?= htmlspecialchars($data_nascimento) ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Sexo</label>
                <div class="controls">
                    <input type="radio" name="sexo" value="M" <?= $sexo !== 'F' ? 'checked' : '' ?>> Masculino
                    <input type="radio" name="sexo" value="F" <?= $sexo === 'F' ? 'checked' : '' ?>> Feminino
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input style="min-height:35px;" name="email" id="email" type="email"
                           placeholder="Email" value="<?= htmlspecialchars($email) ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="estado">Estado (UF)</label>
                <div class="controls">
                    <input style="min-height:35px;" name="estado" id="estado" type="text" maxlength="2"
                           placeholder="UF" value="<?= htmlspecialchars($estado) ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cidade">Cidade</label>
                <div class="controls">
                    <input style="min-height:35px;" name="cidade" id="cidade" type="text"
                           placeholder="Cidade" value="<?= htmlspecialchars($cidade) ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="categoria">Categoria</label>
                <div class="controls">
                    <select name="categoria" id="categoria">
                        <option value="">Escolha uma abaixo</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['idcategoria'] ?>"
                                <?= (string) $categoria_id === (string) $categoria['idcategoria'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoria['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cod_cbsup">Código CBSUP</label>
                <div class="controls">
                    <input style="min-height:35px;" name="cod_cbsup" id="cod_cbsup" type="number" min="0"
                           placeholder="Código CBSUP" value="<?= htmlspecialchars((string) $cod_cbsup) ?>">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a class="btn" href="listar_atleta.php">Voltar</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
