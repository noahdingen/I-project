<?php
if (!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION['gebruikers'])){
$gebruikersnaam = $_SESSION['gebruikers'];
global $conn;
$conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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