<?php
include_once '../databaseverbinding/database_connectie.php';

if(isset($_POST['zoeken'])) {
    $zoek = $_POST['zoeken'];
}
else {
    $zoek = '';
}

$pdo = verbindMetDatabase();

$data = $pdo->prepare("SELECT TOP 6 Titel FROM Items WHERE Titel LIKE'%".$zoek."%'");
$data->execute();
$resultaat = $data->fetchAll(PDO::FETCH_NAMED);

$totaal = count($resultaat);

for($i=0; $i < $totaal; $i++) {
    echo $resultaat[$i]['Titel'];
    echo"<br>";
}