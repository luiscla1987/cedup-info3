<?php
$servername = "localhost";
$username = "root";        // coloque seu usuário do MySQL aqui
$password = "";            // coloque sua senha do MySQL aqui
$dbname = "controle_presenca";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
