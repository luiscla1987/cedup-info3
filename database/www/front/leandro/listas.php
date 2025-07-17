<?php
include 'config.php';

// Criar nova lista
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_lista'])) {
    $nome_lista = $_POST['nome_lista'];
    $stmt = $conn->prepare("INSERT INTO listas (nome) VALUES (?)");
    $stmt->bind_param('s', $nome_lista);
    $stmt->execute();
    $stmt->close();
    header("Location: listas.php");
    exit;
}

// Excluir lista
if (isset($_GET['excluir'])) {
    $id_excluir = intval($_GET['excluir']);
    $conn->query("DELETE FROM presencas WHERE lista_id = $id_excluir");
    $conn->query("DELETE FROM listas WHERE id = $id_excluir");
    header("Location: listas.php");
    exit;
}

// Buscar listas
$result = $conn->query("SELECT l.*, (SELECT COUNT(*) FROM presencas p WHERE p.lista_id = l.id) as num_participantes FROM listas l ORDER BY data_criacao DESC");
?>

<h1>Listas de Presença</h1>

<form method="POST">
    <input type="text" name="nome_lista" placeholder="Nova lista" required>
    <button type="submit">Criar Lista</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nome</th>
        <th>Data de Criação</th>
        <th>Número de Registros</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= $row['data_criacao'] ?></td>
            <td><?= $row['num_participantes'] ?></td>
            <td>
                <a href="registro.php?lista_id=<?= $row['id'] ?>">Registrar Presença</a> | 
                <a href="listas.php?excluir=<?= $row['id'] ?>" onclick="return confirm('Excluir lista?')">Excluir</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
