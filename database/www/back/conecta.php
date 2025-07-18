<?php
// Configurações de conexão baseadas no docker-compose.yml
$hostname = 'mysql';          // Nome do serviço MySQL no docker-compose
$username = 'evento';         // Usuário criado
$password = 'evento123';      // Senha
$banco    = 'evento_db';      // Banco de dados
$porta    = 3306;             // Porta interna do MySQL no container

// Tentar conexão com retry
$max_tentativas = 5;
$tentativa = 0;
$conecta = null;

while ($tentativa < $max_tentativas && !$conecta) {
    $tentativa++;
    
    try {
        $conecta = mysqli_connect($hostname, $username, $password, $banco, $porta);
        
        if ($conecta) {
            // Definir charset para UTF-8
            mysqli_set_charset($conecta, "utf8");
            break;
        }
    } catch (Exception $e) {
        error_log("Tentativa $tentativa falhou: " . $e->getMessage());
    }
    
    if ($tentativa < $max_tentativas) {
        sleep(2); // Aguarda 2 segundos antes da próxima tentativa
    }
}

if (!$conecta) {
    $erro_detalhado = "Erro de conexão após $max_tentativas tentativas:\n";
    $erro_detalhado .= "Host: $hostname\n";
    $erro_detalhado .= "Usuário: $username\n";
    $erro_detalhado .= "Banco: $banco\n";
    $erro_detalhado .= "Porta: $porta\n";
    $erro_detalhado .= "Erro MySQL: " . mysqli_connect_error();
    
    error_log($erro_detalhado);
    die("A conexão com o banco de dados falhou. Verifique os logs para mais detalhes.");
}

// Teste de conexão bem-sucedida
error_log("Conexão com MySQL estabelecida com sucesso!");
?>
