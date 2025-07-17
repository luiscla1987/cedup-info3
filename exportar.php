<?php
$arquivo = "presencas.csv";

if (file_exists($arquivo)) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="lista_presenca.csv"');
    readfile($arquivo);
    exit;
} else {
    echo "Nenhuma presença registrada ainda.";
}
