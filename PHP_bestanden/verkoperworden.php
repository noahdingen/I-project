<?php

//include_once('../Database_verbinding/database_connectie.php');
session_start();
//Regel hieronder is voor server!
require_once '../Server_verbinding/sql_srv_connect.php';

$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$creditcardnummer = $_POST['creditcardnummer'];
$verkoper = 'wel';
$gast = $_SESSION['gebruikers'];
$controle = 'Creditcard';
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh = $conn;
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