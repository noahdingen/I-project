<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 25-4-2018
 * Time: 13:46
 */
require_once('../Database_verbinding/database_connectie.php');

//$_SESSION['user'] = $_POST['username'];
$gebruiker = $_POST['Gebruiker'];
$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$controle = $_POST['controleoptienaam'];
$creditnummer = $_POST['rekeningnummer'];


$sql = "INSERT INTO Verkoper  VALUES('$gebruiker','$bank','$banknummer','$controle','$creditnummer')";
$query = $dbh->prepare($sql);
$query->execute(array($gebruiker,$bank,$banknummer,$controle,$creditnummer));
