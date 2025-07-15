<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Presença</title>
</head>
<body>
    <h1>Registro de Presença</h1>
    <form method="POST" action="registro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <button type="submit">Registrar Presença</button>
    </form>

    <br>
    <a href="exportacao.php">Exportar Lista (CSV)</a>
</body>
</html>
