<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$pdo = verbindMetDatabase();
$voorwerpnummer = $_GET['voorwerpnummer'];
$knopwaarde = $_GET['update'];

var_dump($knopwaarde);

    $data = $pdo->prepare("UPDATE Voorwerp SET geblokkeerd = 'ja' WHERE geblokkeerd = 'nee' AND voorwerpnummer = '$voorwerpnummer'");
    $data->execute();
    $count = $data->rowCount();



if($count >= 1) {
    echo "Uw veiling is geblokkeerd";
}else{
    header("location: ../detailpagina.php?voorwerpnummer=".$voorwerpnummer."&error=Uw veiling is geblokkeerd");

}



?>


