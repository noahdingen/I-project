<?php
include_once '../databaseverbinding/database_connectie.php';

$gebruiker = $_POST['gebruikersnaam'];
$pdo = verbindMetDatabase();
$geblokkeerd = $_POST['geblokkeerd'];

if($geblokkeerd == 'nee'){
    $data = $pdo->prepare("UPDATE Gebruiker SET geblokkeerd = 'ja' WHERE gebruikersnaam = '$gebruiker'");
    $data->execute();
}
if($geblokkeerd == 'ja'){
    $data = $pdo->prepare("UPDATE Gebruiker SET geblokkeerd = 'nee' WHERE gebruikersnaam = '$gebruiker'");
    $data->execute();
}

header("location: ../gebruiker_zoeken.php");
