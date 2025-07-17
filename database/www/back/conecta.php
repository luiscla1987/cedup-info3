<?php
    $hostname = 'mysql'; 
    $username = 'root';
    $password = 'rootpassword';
    $banco = 'evento_db';

    $conecta = mysqli_connect($hostname, $username, $password, $banco);

    if(!$conecta){
        die("A conexão falhou: " . mysqli_connect_error());
    }
?>
