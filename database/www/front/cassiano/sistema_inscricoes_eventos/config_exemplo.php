<?php
/**
 * Arquivo de configuração de exemplo
 * Renomeie para config.php e ajuste as configurações conforme necessário
 */

// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'eventos_db');

// Configurações gerais
define('TIMEZONE', 'America/Sao_Paulo');
define('DEBUG_MODE', true);

// Configurar timezone
date_default_timezone_set(TIMEZONE);

// Configurações de erro (apenas para desenvolvimento)
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>

