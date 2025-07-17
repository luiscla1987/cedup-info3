<?php

include('conecta.php');

if (isset($_GET['id_evento']) && is_numeric($_GET['id_evento'])) {
    $id_evento = $_GET['id_evento'];


    $sql_delete = "DELETE FROM eventos WHERE id_eventos = $id_evento";


    if (mysqli_query($conecta, $sql_delete)) {
        echo "Evento deletado com sucesso!";
    } else {
        echo "Erro ao deletar evento: " . mysqli_error($conecta);
    }
} else {
    echo "ID do evento não fornecido ou inválido!";
}
?>
