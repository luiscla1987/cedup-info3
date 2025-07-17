<?php
require_once 'db_connect.php';

try {
    // Buscar todas as inscrições com informações do evento
    $sql = "SELECT i.id_inscricao, i.nome_participante, i.status_inscricao, 
                   e.nome_eventos, e.data_eventos
            FROM inscricoes i
            INNER JOIN eventos e ON i.id_evento = e.id_eventos
            ORDER BY e.data_eventos ASC, i.nome_participante ASC";
    
    $result = $conn->query($sql);
    
    $inscricoes = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $inscricoes[] = $row;
        }
    }
    
    retornarJSON(true, 'Inscrições carregadas com sucesso', ['inscricoes' => $inscricoes]);
    
} catch (Exception $e) {
    retornarJSON(false, 'Erro ao carregar inscrições: ' . $e->getMessage());
}

$conn->close();
?>

