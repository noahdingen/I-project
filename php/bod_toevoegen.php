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

$check_tijd = $pdo->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM voorwerp WHERE voorwerpnummer = ?");
$check_tijd->execute(array($voorwerpnummer));
$eind_tijd = $check_tijd->fetchAll(PDO:: FETCH_ASSOC);

date_default_timezone_set("Europe/Amsterdam");
$eind_dag = $eind_tijd[0]['looptijdeindeDag'];
$eind_tijdstip = $eind_tijd[0]['looptijdeindeTijdstip'];
$huidige = date('Y-m-d H:i:s');

$eind = $eind_dag." ".$eind_tijdstip;

if($huidige > $eind){
	header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
}else{

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
}
?>