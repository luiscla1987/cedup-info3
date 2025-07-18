<?php
session_start();
require_once '../../back/conecta.php'; // Caminho corrigido

// Verificar se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

session_unset(); // Remove todas as variáveis de sessão
session_destroy(); 
header("Location: login.php");
exit;
?>
