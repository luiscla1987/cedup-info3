<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $dataHora = date("Y-m-d H:i:s");

    $linha = "$nome,$dataHora\n";

    file_put_contents("presencas.csv", $linha, FILE_APPEND | LOCK_EX);

    echo "<p>Presença registrada com sucesso!</p>";
    echo "<a href='exportacao.php'>Voltar</a>";
}
?>
