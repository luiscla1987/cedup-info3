<?php
// Configurações do banco de dados
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'eventos_db';

// Criar conexão
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir charset para UTF-8
$conn->set_charset("utf8");

// Função para sanitizar dados de entrada
function sanitizar($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Função para retornar resposta JSON
function retornarJSON($success, $message, $data = null) {
    header('Content-Type: application/json');
    $response = [
        'success' => $success,
        'message' => $message
    ];
    
    if ($data !== null) {
        $response = array_merge($response, $data);
    }
    
    echo json_encode($response);
    exit;
}
?>

