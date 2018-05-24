<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$voorwerpnummer = $_GET['voorwerpnummer'];
$bodbedrag = $_POST['bodbedrag'];
$gebruikersnaam = $_SESSION['gebruikers'];
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;

$data = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");

$data->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));

header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
?>