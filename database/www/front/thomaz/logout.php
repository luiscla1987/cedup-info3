<?php
session_start();
require_once '../../back/conecta.php';

ini_set('session.cookie_httponly', 1); // Impede acesso via JavaScript
ini_set('session.cookie_samesite', 'Strict'); // Proteção adicional contra CSRF
ini_set('session.gc_maxlifetime', 1800); // 30 minutos de inatividade

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