<?php
require_once 'db_connect.php';

try {
    // Buscar todos os eventos ordenados por data
    $sql = "SELECT id_eventos, nome_eventos, data_eventos FROM eventos ORDER BY data_eventos ASC";
    $result = $conn->query($sql);
    
    $eventos = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventos[] = $row;
        }
    }
    
    retornarJSON(true, 'Eventos carregados com sucesso', ['eventos' => $eventos]);
    
} catch (Exception $e) {
    retornarJSON(false, 'Erro ao carregar eventos: ' . $e->getMessage());
}

$conn->close();
?>

