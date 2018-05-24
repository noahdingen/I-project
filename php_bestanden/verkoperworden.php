<?php

include_once('../databaseverbinding/database_connectie.php');
session_start();
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
var_dump($banknummer);
$creditcardnummer = $_POST['creditcardnummer'];
$verkoper = 'ja  ';
$gast = $_SESSION['gebruikers'];
$controle = 'Creditcard';
$dbh = verbindMetDatabase();
$error = "Vul alle gegevens in";
$error2 = "Geen letters invullen";

if(!is_int($banknummer) || !is_int($creditcardnummer)){
    header("location: ../verkoper.php?error=$error2");
}

if (empty($banknummer) || empty($creditcardnummer)|| empty($bank)) {
        header("location: ../verkoper.php?error=$error");
    }

$sql = "INSERT INTO Verkoper  VALUES('$gast','$bank','$banknummer','$controle','$creditcardnummer')";
$query = $dbh->prepare($sql);
$query->execute(array($gast,$bank,$banknummer,'$controle',$creditcardnummer));

$sql2 = "UPDATE Gebruiker  set verkoper = '$verkoper' WHERE gebruikersnaam = '$gast' ";
$query = $dbh->prepare($sql2);
$query->execute();

header("Location: ../profielpagina.php?bewerken=false");