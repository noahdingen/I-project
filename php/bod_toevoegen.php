<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$voorwerpnummer = $_GET['voorwerpnummer'];
$bodbedrag = $_POST['bodbedrag'];
$gebruikersnaam = $_SESSION['gebruikers'];
$pdo = verbindMetDatabase();

$data = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");

$data->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));

header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
?>