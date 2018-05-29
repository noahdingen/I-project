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
$sql_check = $pdo->prepare("SELECT MAX(bodbedrag) as hoogste_bod, gebruikersnaam FROM Bod WHERE voorwerpnummer = ? GROUP BY gebruikersnaam");
$sql_check->execute(array($voorwerpnummer));
$hoogste_bod = $sql_check->fetchAll(PDO:: FETCH_ASSOC);
//var_dump($hoogste_bod);
if (empty($hoogste_bod)){
    $sql_insert = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");
    $sql_insert->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));
    $error = "";
    header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
}
else if($hoogste_bod[0]["hoogste_bod"]<$bodbedrag ){
    var_dump($hoogste_bod);
    if($hoogste_bod[0]["gebruikersnaam"]!=$gebruikersnaam){
        $sql_insert = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");
        $sql_insert->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));
        $error = "";
        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
    }
    else {
        $error = "U heeft al het hoogste bod geplaatst";
        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
    }
}
else{
    $error = "bodbedrag is te laag";
    header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
}
?>