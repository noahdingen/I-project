<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION['gebruikers'] == ''){
    $voorwerpnummer = $_GET['voorwerpnummer'];
    $error = "U dient ingelogd te zijn om te kunnen bieden";
    header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
}
else{
$voorwerpnummer = $_GET['voorwerpnummer'];
$bodbedrag = $_POST['bodbedrag'];
$gebruikersnaam = $_SESSION['gebruikers'];
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$sql = $conn->prepare("SELECT startprijs FROM Voorwerp WHERE voorwerpnummer = ?");
$sql->execute(array($voorwerpnummer));
$sql_check = $pdo->prepare("SELECT MAX(bodbedrag) as hoogste_bod, gebruikersnaam FROM Bod WHERE voorwerpnummer = ? GROUP BY bodbedrag , gebruikersnaam ORDER BY bodbedrag DESC ");
$sql_check->execute(array($voorwerpnummer));
$hoogste_bod = $sql_check->fetchAll(PDO:: FETCH_ASSOC);
$startbod = $sql->fetchAll();
//var_dump($hoogste_bod);
if (empty($hoogste_bod) && $hoogste_bod > $startbod[0]['startprijs']){
    $sql_insert = $pdo->prepare("INSERT INTO Bod VALUES (?, ?, ?, CAST(GETDATE() AS DATE), convert(time,GETDATE()))");
    $sql_insert->execute(array($voorwerpnummer, $bodbedrag, $gebruikersnaam));
    $error = "";
    header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer");
}
else{
if($hoogste_bod[0]["hoogste_bod"]<$bodbedrag && $bodbedrag > $startbod[0]['startprijs'] && $bodbedrag - $hoogste_bod[0]["hoogste_bod"] >= 1 ) {
    //var_dump($hoogste_bod);
    $lengte =  sizeof($hoogste_bod);
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
    if($hoogste_bod[0]["hoogste_bod"] > $startbod[0]['startprijs']){
        $error = 'bodbedrag is te laag!<br> U dient boven het startbedrag te bieden en boven het hoogste bod<br>U dient een minimale verhoging van €1,- te doen<br> dit is: €'. $hoogste_bod[0]["hoogste_bod"] ;
        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
    }
    else{
        $error = 'bodbedrag is te laag!<br> U dient boven het startbedrag te bieden en boven het hoogste bod<br> dit is: €'. $startbod[0]["startprijs"] ;
        header("location: ../detailpagina.php?voorwerpnummer=$voorwerpnummer&error=$error");
    }
}}}
?>