<?php
require_once "config.php";
require_once "menu.php";

function fetchResults($con, $query) {
    return mysqli_query($con, $query);
}

function selected($a, $b) {
    return ($a == $b) ? 'selected' : '';
}

function athleteName($row) {
    if (!empty($row['nome'])) {
        return ucwords(strtolower($row['nome']));
    }
    return '<em>Atleta não cadastrado (' . htmlspecialchars($row['atleta_cpf']) . ')</em>';
}

$id_etapa = $_POST['etapa'] ?? null;
$id_categoria = $_POST['categoria'] ?? null;

// On first load, use the same etapa shown as selected in the dropdown
if ($id_etapa === null) {
    $primeira_etapa = fetchResults($con, "SELECT idetapa FROM etapa ORDER BY idetapa DESC LIMIT 1");
    if ($row = mysqli_fetch_assoc($primeira_etapa)) {
        $id_etapa = $row['idetapa'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resultados</title>
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
                    <select name="etapa" id="etapa" class="selectpicker" onchange="this.form.categoria.value=''; this.form.submit()">
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
                        <option value="">Escolha uma abaixo</option>
                        <option value="00" <?= selected($id_categoria, "00") ?>>GERAL</option>
                        <?php
                        // Only categories with at least one finisher in the selected etapa
                        $id_etapa_int = (int) $id_etapa;
                        $categorias = fetchResults($con, "
                            SELECT DISTINCT c.idcategoria, c.descricao
                            FROM categoria c
                            JOIN inscricao i ON i.categoria_idcategoria = c.idcategoria
                            WHERE i.etapa_idetapa = '$id_etapa_int'
                              AND i.tempo <> '00:00:00'
                            ORDER BY c.descricao
                        ");
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

    <?php if ($id_categoria !== null): ?>
        <?php
        $count = 1;

        // Header Info
        $etapa_q = fetchResults($con, "SELECT * FROM etapa WHERE idetapa='$id_etapa'");
        if ($row = mysqli_fetch_assoc($etapa_q)) {
            echo "<br><h3 align='center'>{$row['nome_etapa']} - {$row['local_etapa']}</h3><br>";
        }

        if ($id_categoria != "00") {
            $cat_q = fetchResults($con, "SELECT descricao FROM categoria WHERE idcategoria='$id_categoria'");
            if ($row = mysqli_fetch_assoc($cat_q)) {
                echo "<h3 align='center'>RESULTADO - {$row['descricao']}</h3><br>";
            }
        } else {
            echo "<h3 align='center'>RESULTADO GERAL</h3><br>";
        }

        // Result Table
        if ($id_categoria != "00") {
            if ($id_etapa >= 20) {
                $sql = "
                    SELECT i.numero, i.atleta_cpf, p.nome, p.estado, p.cidade, i.tempo
                    FROM inscricao i
                    LEFT JOIN atleta p ON i.atleta_cpf = p.cpf
                    JOIN categoria c ON i.categoria_idcategoria = c.idcategoria
                    WHERE i.etapa_idetapa = '$id_etapa'
                      AND i.categoria_idcategoria = '$id_categoria'
                      AND i.tempo <> '00:00:00'
                    ORDER BY i.tempo
                ";
                $res = fetchResults($con, $sql);

                echo "<table class='table' style='width:700px; margin:auto;'>
                    <thead>
                        <tr>
                            <th>#</th><th>NÚMERO</th><th>NOME</th><th>CIDADE</th><th>UF</th><th>TEMPO</th>
                        </tr>
                    </thead><tbody>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['numero']}</td>
                        <td>" . athleteName($row) . "</td>
                        <td>{$row['cidade']}</td>
                        <td>{$row['estado']}</td>
                        <td>{$row['tempo']}</td>
                    </tr>";
                    $count++;
                }

                echo "</tbody></table>";
            } else {
                // For etapas < 20
                $sql = "
                    SELECT i.numero, i.atleta_cpf, p.nome, p.estado, i.tempo
                    FROM inscricao i
                    LEFT JOIN atleta p ON i.atleta_cpf = p.cpf
                    JOIN categoria c ON i.categoria_idcategoria = c.idcategoria
                    WHERE i.etapa_idetapa = '$id_etapa'
                      AND i.categoria_idcategoria = '$id_categoria'
                      AND i.tempo <> '00:00:00'
                    ORDER BY i.tempo
                ";
                $res = fetchResults($con, $sql);

                echo "<table class='table' style='width:700px; margin:auto;'>
                    <thead>
                        <tr><th>#</th><th>NÚMERO</th><th>NOME</th><th>UF</th><th>TEMPO</th></tr>
                    </thead><tbody>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['numero']}</td>
                        <td>" . athleteName($row) . "</td>
                        <td>{$row['estado']}</td>
                        <td>{$row['tempo']}</td>
                    </tr>";
                    $count++;
                }

                echo "</tbody></table>";
            }
        } else {
            // GERAL (all categories)
            $sql = "
                SELECT i.numero, i.atleta_cpf, p.nome, p.estado, c.descricao, i.tempo
                FROM inscricao i
                LEFT JOIN atleta p ON i.atleta_cpf = p.cpf
                JOIN categoria c ON i.categoria_idcategoria = c.idcategoria
                WHERE i.etapa_idetapa = '$id_etapa'
                  AND i.tempo <> '00:00:00'
                ORDER BY i.tempo
            ";
            $res = fetchResults($con, $sql);

            echo "<table class='table' style='width:700px; margin:auto;'>
                <thead>
                    <tr><th>#</th><th>NÚMERO</th><th>NOME</th><th>UF</th><th>CATEGORIA</th><th>TEMPO</th></tr>
                </thead><tbody>";

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$count}</td>
                    <td>{$row['numero']}</td>
                    <td>" . athleteName($row) . "</td>
                    <td>{$row['estado']}</td>
                    <td>{$row['descricao']}</td>
                    <td>{$row['tempo']}</td>
                </tr>";
                $count++;
            }

            echo "</tbody></table>";
        }
        ?>
    <?php endif; ?>
</div>
</body>
</html>
