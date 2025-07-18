<?php
    include("back/conecta.php");

    if (file_exists(__DIR__ . "/thomaz/menu.php")) {
        include(__DIR__ . "/thomaz/menu.php");
    } else {
        echo "Arquivo menu.php não encontrado!";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
</head>
<body>

    <h1>TESTANDO........</h1>
</body>
</html>