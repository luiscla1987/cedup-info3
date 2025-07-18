<?php
session_start();
require_once("../../back/conecta.php"); // Correto - sobe 2 níveis

// Verificar se usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Função para obter o nome do nível de usuário
function getNomeNivel($nivel_int) {
    switch ($nivel_int) {
        case 1: return 'Administrador';
        case 2: return 'Usuário';
        default: return 'Desconhecido';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        .container-menu-c {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .menu-container {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 80px;
            width: 100%;
        }

        .menu-c {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            background-color: #ccc;
            width: 300px;
            padding: 20px;
        }

        .menu {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            width: 100%;
            flex-direction: column;
        }

        ul {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        a {
            background-color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            color: #333;
        }

        a:hover {
            background-color: #f0f0f0;
        }

        .conteudo {
            width: 100%;
            padding: 40px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #dc3545 !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container-menu-c">
        <div class="menu-container">
            <div class="menu-c">
                <div class="menu">
                    <ul>
                        <li><a href="../../index.php">Início</a></li>
                        <?php if (isset($_SESSION['nivel_usuario']) && $_SESSION['nivel_usuario'] == 1): ?>
                        <li><a href="cadastro-usuario.php">Cadastrar usuários</a></li>
                        <li><a href="#">Listar usuários</a></li>
                        <li><a href="#">Cadastrar eventos</a></li>
                        <li><a href="#">Listar eventos</a></li>
                        <?php endif; ?>
                        <li><a href="#">Meus eventos</a></li>
                    </ul>
                    <a href="logout.php" class="logout-btn">Sair</a>
                </div>
            </div>

            <div class="conteudo">
                <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</h2>
                <p>Nível: <?php echo getNomeNivel($_SESSION['nivel_usuario']); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
