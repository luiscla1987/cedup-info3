<?php
include 'config.php';

$listas = [];
$result = $conn->query("SELECT * FROM listas ORDER BY nome");
while ($row = $result->fetch_assoc()) {
    $listas[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lista_id = intval($_POST['lista_id']);
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    // Cabeçalho CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=exportacao_presenca.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Nome', 'Data Registro', 'Hora Entrada', 'Hora Saída', 'Status', 'Observações']);

    $sql = "SELECT part.nome, pre.data_registro, pre.hora_entrada, pre.hora_saida, pre.status, pre.observacoes 
            FROM presencas pre 
            JOIN participantes part ON part.id = pre.participante_id 
            WHERE pre.lista_id = ? 
            AND pre.data_registro BETWEEN ? AND ? 
            ORDER BY pre.data_registro";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $lista_id, $data_inicio, $data_fim);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        fputcsv($output, [
            $row['nome'], 
            $row['data_registro'], 
            $row['hora_entrada'], 
            $row['hora_saida'], 
            $row['status'], 
            $row['observacoes']
        ]);
    }

    fclose($output);
    exit;
}
?>

<h1>Exportar Dados</h1>

<form method="POST">
    <label>Lista:</label>
    <select name="lista_id" required>
        <option value="">Selecione...</option>
        <?php foreach ($listas as $l): ?>
            <option value="<?= $l['id'] ?>"><?= htmlspecialchars($l['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Data Início:</label>
    <input type="date" name="data_inicio" required><br><br>

    <label>Data Fim:</label>
    <input type="date" name="data_fim" required><br><br>

    <button type="submit">Exportar CSV</button>
</form>
