<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    retornarJSON(false, 'Método não permitido');
}

// Validar dados de entrada
if (empty($_POST['id_evento']) || empty($_POST['nome_participante']) || empty($_POST['acao'])) {
    retornarJSON(false, 'Todos os campos são obrigatórios');
}

$id_evento = (int) sanitizar($_POST['id_evento']);
$nome_participante = sanitizar($_POST['nome_participante']);
$acao = sanitizar($_POST['acao']);

// Validar ação
if (!in_array($acao, ['confirmar', 'cancelar'])) {
    retornarJSON(false, 'Ação inválida');
}

try {
    // Verificar se o evento existe
    $sql_evento = "SELECT id_eventos, nome_eventos FROM eventos WHERE id_eventos = ?";
    $stmt_evento = $conn->prepare($sql_evento);
    $stmt_evento->bind_param("i", $id_evento);
    $stmt_evento->execute();
    $result_evento = $stmt_evento->get_result();
    
    if ($result_evento->num_rows === 0) {
        retornarJSON(false, 'Evento não encontrado');
    }
    
    $evento = $result_evento->fetch_assoc();
    
    // Verificar se já existe uma inscrição para este participante neste evento
    $sql_check = "SELECT id_inscricao, status_inscricao FROM inscricoes WHERE id_evento = ? AND nome_participante = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("is", $id_evento, $nome_participante);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    $status = ($acao === 'confirmar') ? 'confirmada' : 'cancelada';
    
    if ($result_check->num_rows > 0) {
        // Atualizar inscrição existente
        $inscricao_existente = $result_check->fetch_assoc();
        
        if ($inscricao_existente['status_inscricao'] === $status) {
            $mensagem = ($acao === 'confirmar') ? 
                'Inscrição já está confirmada para este evento' : 
                'Inscrição já está cancelada para este evento';
            retornarJSON(false, $mensagem);
        }
        
        $sql_update = "UPDATE inscricoes SET status_inscricao = ? WHERE id_inscricao = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $status, $inscricao_existente['id_inscricao']);
        
        if ($stmt_update->execute()) {
            $mensagem = ($acao === 'confirmar') ? 
                "Inscrição confirmada com sucesso para o evento '{$evento['nome_eventos']}'" : 
                "Inscrição cancelada com sucesso para o evento '{$evento['nome_eventos']}'";
            retornarJSON(true, $mensagem);
        } else {
            retornarJSON(false, 'Erro ao atualizar inscrição');
        }
        
    } else {
        // Criar nova inscrição
        if ($acao === 'cancelar') {
            retornarJSON(false, 'Não é possível cancelar uma inscrição que não existe');
        }
        
        $sql_insert = "INSERT INTO inscricoes (id_evento, nome_participante, status_inscricao) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iss", $id_evento, $nome_participante, $status);
        
        if ($stmt_insert->execute()) {
            retornarJSON(true, "Inscrição confirmada com sucesso para o evento '{$evento['nome_eventos']}'");
        } else {
            retornarJSON(false, 'Erro ao criar inscrição');
        }
    }
    
} catch (Exception $e) {
    retornarJSON(false, 'Erro interno do servidor: ' . $e->getMessage());
}

$conn->close();
?>

