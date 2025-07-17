<?php
include('conecta.php');


$nome_eventos = $_POST['nome_eventos'];
$data_eventos = $_POST['data_eventos'];
$hora_eventos = $_POST['hora_eventos'];
$capacidade = $_POST['capacidade'];
$valor = $_POST['valor'];
$local_eventos = $_POST['local_eventos'];
$descricao     = $_POST['descricao'];

if ($nome_eventos != "" && $data_eventos != "" && $hora_eventos != "") {
    $sql_insert = "INSERT INTO eventos (nome_eventos, data_eventos, hora_eventos, capacidade, valor, local_eventos, descricao) 
                   VALUES ('$nome_eventos', '$data_eventos', '$hora_eventos', '$capacidade', '$valor', '$local_eventos','$descricao')";
    
    if (mysqli_query($conecta, $sql_insert)) {
        echo "Evento cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar evento: " . mysqli_error($conecta);
    }
} else {
    echo "Preencha todos os campos obrigatórios!";
}
?>
