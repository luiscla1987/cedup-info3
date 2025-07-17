<?php
include('../back/conecta.php');

$sql = "SELECT * FROM eventos";
$resultado = $conecta->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>Eventos Cadastrados</h1>
    <?php if ($resultado->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Capacidade</th>
                    <th>Valor</th>
                    <th>Local</th>
                </tr>
            </thead>
            <tbody>
                <?php while($evento = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $evento['id_eventos']; ?></td>
                        <td><?php echo $evento['nome_eventos']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($evento['data_eventos'])); ?></td>
                        <td><?php echo $evento['hora_eventos']; ?></td>
                        <td><?php echo $evento['capacidade']; ?></td>
                        <td>R$ <?php echo number_format($evento['valor'], 2, ',', '.'); ?></td>
                        <td><?php echo $evento['local_eventos']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum evento encontrado.</p>
    <?php endif; ?>

    <?php $conecta->close(); ?>

    teste
</body>
</html>
