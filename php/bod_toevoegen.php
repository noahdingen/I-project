<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$voorwerpnummer = $_GET['voorwerpnummer'];
$bodbedrag = $_POST['bodbedrag'];
$gebruikersnaam = $_SESSION['gebruikers'];
$pdo = verbindMetDatabase();
$sql_check = $pdo->prepare("SELECT MAX(bodbedrag) as hoogste_bod, gebruikersnaam FROM Bod WHERE voorwerpnummer = ? GROUP BY gebruikersnaam");
$sql_check->execute(array($voorwerpnummer));
$hoogste_bod = $sql_check->fetchAll(PDO:: FETCH_ASSOC);
var_dump($hoogste_bod['']);
if($hoogste_bod["hoogste_bod"]<$bodbedrag){
    var_dump($hoogste_bod);
    if($hoogste_bod["gebruikersnaam"]!=$gebruikersnaam){
        $sql_insert = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");
        $sql_insert->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));
        $error = "";
//        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
    }
    else {
        $error = "U heeft al het hoogste bod geplaatst";
        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
    }
}
else{
    header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error='bodbedrag is te laag'");
}
?>