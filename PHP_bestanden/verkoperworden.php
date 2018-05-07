<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 25-4-2018
 * Time: 13:46
 */
include_once('../Database_verbinding/database_connectie.php');
$_SESSION['user'] = $_POST['username'];
$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$controle = $_POST['controleoptienaam'];
$creditnummer = $_POST['rekeningnummer'];
$verkoper = 'wel';
$gast = $_SESSION['user'];




$sql = "INSERT INTO Verkoper  VALUES('$gebruiker','$bank','$banknummer','$controle','$creditnummer')";
$query = $dbh->prepare($sql);
$query->execute(array($gebruiker,$bank,$banknummer,$controle,$creditnummer));

$sql2 = "UPDATE Gebruiker  set verkoper = '$verkoper' WHERE gebruikersnaam = $gast ";
$query = $dbh->prepare($sql2);
$query->execute();

header("Location: ../profielpagina.php");