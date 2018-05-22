<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$pdo = verbindMetDatabase();
$oude_gebruikersnaam = $_GET['gebruikersnaam'];
//echo $oude_gebruikersnaam;
//echo $_SESSION['gebruikers'];
//header("location: ../profielpagina.php?error");


//$sql = "UPDATE Gebruiker SET 'gebruikersnaam'='Minus' WHERE 'gebruikersnaam'=$oude_gebruikersnaam";
//$query = $pdo->prepare($sql);
//$query->execute($_POST['gebruikersnaam']);
//header("location: ../profielpagina.php?bewerken=false");

$data = $pdo->prepare("UPDATE Gebruiker SET gebruikersnaam = 'Bob' WHERE gebruikersnaam = 'TEST'");
$data->execute();
header("location: ../profielpagina.php?bewerken=false");