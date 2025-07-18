<?php
session_start();
require_once '../../back/conecta.php'; // Correto - sobe 2 níveis

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nivel_usuario = trim($_POST['nivel_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $cpf = trim($_POST['cpf']);
    
    if (empty($nivel_usuario) || empty($nome) || empty($email) || empty($senha) || empty($cpf)) {
        $erro = 'Por favor, preencha todos os campos.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        // Verificar se email já existe
        $stmt_email = $conecta->prepare("SELECT id_usuario FROM usuarios WHERE email_usuarios = ?");
        $stmt_email->bind_param("s", $email);
        $stmt_email->execute();
        $resultado_email = $stmt_email->get_result();
        
        if ($resultado_email->num_rows > 0) {
            $erro = 'Este email já está cadastrado.';
        } else {
            // Verificar se CPF já existe
            $stmt_cpf = $conecta->prepare("SELECT id_usuario FROM usuarios WHERE cpf_usuarios = ?");
            $stmt_cpf->bind_param("s", $cpf);
            $stmt_cpf->execute();
            $resultado_cpf = $stmt_cpf->get_result();
            
            if ($resultado_cpf->num_rows > 0) {
                $erro = 'Este CPF já está cadastrado.';
            } else {
                // Inserir novo usuário
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt_inserir = $conecta->prepare("INSERT INTO usuarios (nivel_usuarios, nome_usuarios, email_usuarios, senha_usuarios, cpf_usuarios) VALUES (?, ?, ?, ?, ?)");
                $stmt_inserir->bind_param("issss", $nivel_usuario, $nome, $email, $senha_hash, $cpf);
                
                if ($stmt_inserir->execute()) {
                    $sucesso = 'Usuário cadastrado com sucesso!';
                } else {
                    $erro = 'Erro ao cadastrar usuário: ' . $conecta->error;
                }
                $stmt_inserir->close();
            }
            $stmt_cpf->close();
        }
        $stmt_email->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="form-title">Cadastro de Usuário</h2>
        
        <?php if ($erro): ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        
        <?php if ($sucesso): ?>
            <div class="sucesso"><?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div>
                <label for="nivel_usuario">Nível do Usuário:</label>
                <select id="nivel_usuario" name="nivel_usuario" required>
                    <option value="">Selecione...</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuário</option>
                </select>
            </div>
            
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required minlength="6">
            </div>
            
            <div>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="000.000.000-00">
            </div>
            
            <button type="submit">Cadastrar</button>
        </form>
        
        <a href="menu.php">Voltar ao Menu</a>
    </div>

    <script>
        // Máscara para CPF
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>
