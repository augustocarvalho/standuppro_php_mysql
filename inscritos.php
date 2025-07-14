<?php
require_once "config.php";
// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_numero'], $_POST['delete_etapa'])) {
    $numero = intval($_POST['delete_numero']);
    $etapa_id = intval($_POST['delete_etapa']);

    $stmt = $con->prepare("DELETE FROM inscricao WHERE numero = ? AND etapa_idetapa = ?");
    $stmt->bind_param("ii", $numero, $etapa_id);
    if ($stmt->execute()) {
        echo "<script>alert('Inscrição excluída com sucesso.');</script>";
    } else {
        echo "<script>alert('Erro ao excluir a inscrição.');</script>";
    }
    $stmt->close();
}

require_once "menu.php";


function fetchResults($con, $query) {
    return mysqli_query($con, $query);
}

function selected($a, $b) {
    return ($a == $b) ? 'selected' : '';
}

$id_etapa = $_POST['etapa'] ?? null;
$id_categoria = $_POST['categoria'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscritos</title>
    <style>
        body {
            background-image: url("stdp_resultados01logo.jpg"), url("stdp_resultados02.jpg");
            background-repeat: no-repeat, repeat;
            background-size: 100% auto;
        }
        .nav > li > a > img {
            height: 80px;
        }
    </style>
</head>
<body>
<div class="container" id="cadastro">
    <form method="post">
        <table id="form_selecao">
            <tr>
                <td><strong>ETAPA:</strong></td>
                <td>
                    <select name="etapa" id="etapa" class="selectpicker" onchange="this.form.submit()">
                        <?php
                        $etapas = fetchResults($con, "SELECT * FROM etapa ORDER BY idetapa DESC");
                        while ($etapa = mysqli_fetch_assoc($etapas)) {
                            echo "<option value='{$etapa['idetapa']}' " . selected($id_etapa, $etapa['idetapa']) . ">
                                {$etapa['nome_etapa']} - {$etapa['local_etapa']}
                            </option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>CATEGORIA:</strong></td>
                <td>
                    <select name="categoria" id="categoria" class="selectpicker" onchange="this.form.submit()">
                        <option value="">Todas as categorias</option>
                        <?php
                        $categorias = fetchResults($con, "SELECT * FROM categoria ORDER BY descricao");
                        while ($cat = mysqli_fetch_assoc($categorias)) {
                            echo "<option value='{$cat['idcategoria']}' " . selected($id_categoria, $cat['idcategoria']) . ">
                                {$cat['descricao']}
                            </option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>

    <?php if ($id_etapa): ?>
        <br>
        <?php
        // Header info
        $etapa_q = fetchResults($con, "SELECT * FROM etapa WHERE idetapa='$id_etapa'");
        if ($etapa = mysqli_fetch_assoc($etapa_q)) {
            echo "<h3 align='center'>{$etapa['nome_etapa']} - {$etapa['local_etapa']}</h3><br>";
        }

        // Optional: Category display
        if ($id_categoria) {
            $cat_q = fetchResults($con, "SELECT descricao FROM categoria WHERE idcategoria='$id_categoria'");
            if ($cat = mysqli_fetch_assoc($cat_q)) {
                echo "<h4 align='center'>Categoria: {$cat['descricao']}</h4><br>";
            }
        }

        // Athlete list query
        $whereCategoria = $id_categoria ? "AND i.categoria_idcategoria = '$id_categoria'" : "";
        $sql = "
            SELECT i.numero, i.etapa_idetapa , a.nome, a.estado, a.cidade, c.descricao AS categoria
            FROM inscricao i
            JOIN atleta a ON i.atleta_cpf = a.cpf
            JOIN categoria c ON i.categoria_idcategoria = c.idcategoria
            WHERE i.etapa_idetapa = '$id_etapa' $whereCategoria
            ORDER BY i.numero ASC
        ";

        $res = fetchResults($con, $sql);

        echo "<table class='table table-striped table-bordered' style='width:800px; margin:auto;'>
        <thead>
            <tr>
                <th>#</th>
                <th>Número</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead><tbody>";

        $count = 1;
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                <td>{$count}</td>
                <td>{$row['numero']}</td>
                <td>" . ucwords(strtolower($row['nome'])) . "</td>
                <td>{$row['cidade']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['categoria']}</td>
                <td>
                    <form method='post' onsubmit='return confirm(\"Tem certeza que deseja excluir esta inscrição?\");'>
                        <input type='hidden' name='delete_numero' value='{$row['numero']}'>
                        <input type='hidden' name='delete_etapa' value='{$row['etapa_idetapa']}'>
                        <button type='submit' class='btn btn-danger btn-sm'>Excluir</button>
                    </form>
                </td>
            </tr>";
            $count++;
        }

        echo "</tbody></table>";
        ?>
    <?php endif; ?>
</div>
</body>
</html>
