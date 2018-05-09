<?php

include_once('../Database_verbinding/database_connectie.php');
session_start();
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';
$_SESSION['user'] = $_POST['username'];
$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$controle = $_POST['controleoptienaam'];
$creditnummer = $_POST['rekeningnummer'];
$verkoper = 'wel';
$gast = $_SESSION['user'];

$dbh = verbindMetDatabase();



$sql = "INSERT INTO Verkoper  VALUES('$gebruiker','$bank','$banknummer','$controle','$creditnummer')";
$query = $dbh->prepare($sql);
$query->execute(array($gebruiker,$bank,$banknummer,$controle,$creditnummer));

$sql2 = "UPDATE Gebruiker  set verkoper = '$verkoper' WHERE gebruikersnaam = $gast ";
$query = $dbh->prepare($sql2);
$query->execute();

header("Location: ../profielpagina.php");