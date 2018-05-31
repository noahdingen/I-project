<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$voorwerpnummer = $_GET['voorwerpnummer'];


$data = $pdo->prepare("UPDATE Voorwerp SET geblokkeerd = 'ja' WHERE geblokkeerd = 'nee' AND voorwerpnummer = '$voorwerpnummer'");
$data->execute();
$count = $data->rowCount();


if($count >= 1) {
    echo "Uw veiling is geblokkeerd";
}else{
    header("location: ../detailpagina.php?voorwerpnummer=".$voorwerpnummer."&error=Uw veiling is al geblokkeerd");

}

?>
