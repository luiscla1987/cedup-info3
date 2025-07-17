<?php
include 'config.php';

$lista_id = isset($_GET['lista_id']) ? intval($_GET['lista_id']) : 0;

// Buscar lista
$lista_result = $conn->query("SELECT * FROM listas WHERE id = $lista_id");
if ($lista_result->num_rows == 0) {
    die("Lista não encontrada.");
}
$lista = $lista_result->fetch_assoc();

// Registrar presença via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $presenca_id = intval($_POST['presenca_id']);
    $status = $_POST['status'];
    $hora_entrada = $_POST['hora_entrada'];
    $hora_saida = $_POST['hora_saida'];
    $observacoes = $_POST['observacoes'];

    if ($presenca_id > 0) {
        // Atualizar presença
        $stmt = $conn->prepare("UPDATE presencas SET status=?, hora_entrada=?, hora_saida=?, observacoes=? WHERE id=?");
        $stmt->bind_param('ssssi', $status, $hora_entrada, $hora_saida, $observacoes, $presenca_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Inserir nova presença
        $participante_id = intval($_POST['participante_id']);
        $stmt = $conn->prepare("INSERT INTO presencas (participante_id, lista_id, status, hora_entrada, hora_saida, observacoes) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iissss', $participante_id, $lista_id, $status, $hora_entrada, $hora_saida, $observacoes);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: registro.php?lista_id=$lista_id");
    exit;
}

// Buscar participantes já com presença na lista
$presencas = [];
$result = $conn->query("
    SELECT p.id as presenca_id, part.id as participante_id, part.nome, pre.status, pre.hora_entrada, pre.hora_saida, pre.observacoes 
    FROM participantes part
    LEFT JOIN presencas pre ON pre.participante_id = part.id AND pre.lista_id = $lista_id
    ORDER BY part.nome
");

while ($row = $result->fetch_assoc()) {
    $presencas[] = $row;
}
?>

<h1>Registro de Presença - Lista: <?= htmlspecialchars($lista['nome']) ?></h1>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nome</th>
        <th>Hora Entrada</th>
        <th>Hora Saída</th>
        <th>Status</th>
        <th>Observações</th>
        <th>Ação</th>
    </tr>
    <?php foreach ($presencas as $p): ?>
        <tr style="background-color:
            <?= $p['status'] == 'presente' ? '#c8f7c5' : ($p['status'] == 'ausente' ? '#f7c5c5' : '#f7f1c5') ?>;">
            <form method="POST" action="registro.php?lista_id=<?= $lista_id ?>">
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><input type="time" name="hora_entrada" value="<?= $p['hora_entrada'] ?? '' ?>"></td>
                <td><input type="time" name="hora_saida" value="<?= $p['hora_saida'] ?? '' ?>"></td>
                <td>
                    <select name="status">
                        <option value="presente" <?= $p['status'] == 'presente' ? 'selected' : '' ?>>Presente</option>
                        <option value="ausente" <?= $p['status'] == 'ausente' ? 'selected' : '' ?>>Ausente</option>
                        <option value="justificado" <?= $p['status'] == 'justificado' ? 'selected' : '' ?>>Justificado</option>
                    </select>
                </td>
                <td><input type="text" name="observacoes" value="<?= htmlspecialchars($p['observacoes']) ?>"></td>
                <td>
                    <input type="hidden" name="presenca_id" value="<?= $p['presenca_id'] ?? 0 ?>">
                    <input type="hidden" name="participante_id" value="<?= $p['participante_id'] ?>">
                    <button type="submit">Salvar</button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>
