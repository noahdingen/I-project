<?php
$pdo = verbindMetDatabase();

$sql = "select gebruikersnaam, emailadres, voornaam, achternaam, datum, plaatsnaam, adresregel1, postcode, verkoper from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql_2 = "select banknaam, rekeningnummer, controleoptienaam, creditcardnummer from Verkoper where gebruikersnaam =?";
$query_2 = $pdo->prepare($sql_2);
$query_2->execute([$_SESSION['gebruikers']]);

$rows_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

$gebruikersnaam = $rows[0]['gebruikersnaam'];
$emailadres = $rows[0]['emailadres'];
$voornaam = $rows[0]['voornaam'];
$achternaam = $rows[0]['achternaam'];
$datum = $rows[0]['datum'];
$plaatsnaam = $rows[0]['plaatsnaam'];
$adres = $rows[0]['adresregel1'];
$postcode = $rows[0]['postcode'];
$verkoper = $rows[0]['verkoper'];

if($verkoper == 'ja  ') {
    $banknaam = $rows_2[0]['banknaam'];
    $rekingnummer = $rows_2[0]['rekeningnummer'];
    $controle_optie = $rows_2[0]['controleoptienaam'];
    $creditcardnummer = $rows_2[0]['creditcardnummer'];
}
?>