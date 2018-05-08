<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Database_verbinding/database_connectie.php';

$pdo = verbindMetDatabase();

$sql = "select gebruikersnaam, emailadres, voornaam, achternaam, datum, plaatsnaam, postcode, verkoper from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

$rows = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
var_dump($rows);
echo '</pre>';

echo '<pre>';
print_r($rows);
echo '</pre>';

//$gebruikersnaam = $rows['gebruikersnaam'];
/*$emailadres = $rows[0][1];
$voornaam = $rows[0][2];
$achternaam = $rows[0][3];
$datum = $rows[0][4];
$plaatsnaam = $rows[0][5];
$postcode = $rows[0][6];
$verkoper = $rows[0][7];*/
echo $rows[0][];
//echo $emailadres;
?>