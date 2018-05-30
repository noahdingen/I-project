<?php
include_once '../databaseverbinding/database_connectie.php';

$gebruiker = $_POST['gebruikersnaam'];
$pdo = verbindMetDatabase();
$gebruiker = $_POST['gebruikersnaam'];

    $data = $pdo->prepare("UPDATE Gebruiker SET geblokkeerd = 'ja' WHERE gebruikersnaam = '$gebruiker'");
    $data->execute();




header("location:");
