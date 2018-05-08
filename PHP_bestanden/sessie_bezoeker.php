<?php
if (!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION['gebruikers'])){
$gebruikersnaam = $_SESSION['gebruikers'];
$conn = verbindMetDatabase();
$sql = "SELECT voornaam, achternaam FROM Gebruiker WHERE gebruikersnaam = ?";
$data = $conn->prepare($sql);
$data->execute(array($gebruikersnaam));

$voornaam = $data->fetch(PDO::FETCH_NAMED);
$bezoeker = array($voornaam['voornaam'], $voornaam['achternaam']);
}

else{
$bezoeker = array('bezoeker', '');
}
?>