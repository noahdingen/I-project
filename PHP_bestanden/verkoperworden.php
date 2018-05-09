<?php

include_once('../Database_verbinding/database_connectie.php');
session_start();
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$controle = $_POST['controleoptienaam'];
$creditnummer = $_POST['rekeningnummer'];
$verkoper = 'wel';
$gast = $_SESSION['gebruikers'];

$dbh = verbindMetDatabase();
$error = "Vul alle gegevens in";
$error2 = "Geen letters invullen";

    if(ctype_alpha($banknummer) || ctype_alpha($creditnummer)){
    header("location: ../verkoper.php?error=$error2");
}

if (empty($banknummer) || empty($creditnummer)|| empty($bank)|| empty($controle)) {
        header("location: ../verkoper.php?error=$error");
    }

$sql = "INSERT INTO Verkoper  VALUES('$gast','$bank','$banknummer','$controle','$creditnummer')";
$query = $dbh->prepare($sql);
$query->execute(array($gast,$bank,$banknummer,$controle,$creditnummer));

$sql2 = "UPDATE Gebruiker  set verkoper = '$verkoper' WHERE gebruikersnaam = '$gast' ";
$query = $dbh->prepare($sql2);
$query->execute();

header("Location: ../profielpagina.php");