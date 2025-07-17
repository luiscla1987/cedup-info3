<?php
    $hostname = 'mysql';          // nome do serviço (container) no docker-compose
    $username = 'evento';         // usuário criado no compose
    $password = 'evento123';      // senha do usuário
    $banco    = 'evento_db';      // nome do banco criado

    $conecta = mysqli_connect($hostname, $username, $password, $banco);

    if (!$conecta) {
        die("A conexão falhou: " . mysqli_connect_error());
    }
?>
