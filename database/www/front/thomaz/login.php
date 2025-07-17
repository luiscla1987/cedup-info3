<?php
session_start();
require_once '../../back/conecta.php';

$erro = '';
$sucesso = '';

$senha = "admin";
$hash = password_hash($senha, PASSWORD_DEFAULT);
echo $hash;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    
    if (empty($email) || empty($senha)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        // Prepara a consulta para buscar o usuário pelo email
        $stmt = $conecta->prepare("SELECT id_usuario, nome_usuarios, nivel_usuarios, senha_usuarios FROM usuarios WHERE email_usuarios = ?");
        if ($stmt === false) {
            $erro = 'Erro ao preparar consulta: ' . $conecta->error;
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows == 1) {
                $usuario = $resultado->fetch_assoc();
                
                // Verifica se a senha fornecida corresponde à senha hash no banco de dados
                if ($senha === $usuario['senha_usuarios']) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nome_usuario'] = $usuario['nome_usuarios'];
                    $_SESSION['nivel_usuario'] = $usuario['nivel_usuarios'];
                    $_SESSION['logado'] = true;
                    header('Location: ../index.php');
                    exit();
                } else {
                    $erro = 'Email ou senha incorretos. (Senha não corresponde)';
                }
            } else {
                $erro = 'Email ou senha incorretos. (Usuário não encontrado)';
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <h2>Login</h2>
        
        <?php if ($erro): ?>
            <div><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <?php if ($sucesso): ?>
            <div><?php echo $sucesso; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
