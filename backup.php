<?php
require_once 'config.php'; // Must define $db_host, $db_user, $db_password, $db_name

if (isset($_GET['action']) && $_GET['action'] === 'dump') {
    $timestamp = date("Y-m-d_H-i-s");
    $filename = "dump_{$db_name}_{$timestamp}.sql";

    // 1. Get list of all tables
    $tables = [];
    $result = $con->query("SHOW TABLES");
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }

    // 2. Run mysqldump
    $command = "mysqldump --host=$'localhost' --user=$db_user --password=$db_password --add-drop-table --skip-extended-insert $db_name";
    $dump = shell_exec($command);

    if (!$dump) {
        die("Erro ao executar o mysqldump.");
    }

    // 3. Insert TRUNCATE TABLE before inserts
    foreach ($tables as $table) {
        $truncate_stmt = "TRUNCATE TABLE `$table`;\n";
        // Find the position of CREATE TABLE and INSERTs
        $pattern = "/(CREATE TABLE `?$table`?.*?;\n)/s";
        if (preg_match($pattern, $dump, $matches)) {
            $create_stmt = $matches[1];
            // Replace with CREATE + TRUNCATE
            $dump = str_replace($create_stmt, $create_stmt . "\n" . $truncate_stmt, $dump);
        }
    }

    // 4. Return file
    header('Content-Type: application/sql');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $dump;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backup MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container text-center">
        <h1 class="mb-4">Backup do Banco de Dados</h1>
        <a href="?action=dump" class="btn btn-primary btn-lg">
            Baixar Backup (.sql) com DROP e TRUNCATE
        </a>
    </div>
</body>
</html>
