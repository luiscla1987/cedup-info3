<?php
$hostname = 'mysql';          // nome do serviço MySQL no docker-compose
$username = 'evento';         // usuário criado
$password = 'evento123';      // senha
$banco    = 'evento_db';      // banco de dados
$porta    = 3306;             // porta interna do MySQL no container

$conecta = mysqli_connect($hostname, $username, $password, $banco, $porta);

if (!$conecta) {
    die("A conexão falhou: " . mysqli_connect_error());
}
?>
