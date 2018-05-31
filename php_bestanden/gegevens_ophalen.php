<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_GET['gebruikersnaam'])){
    $gebruiker= $_GET['gebruikersnaam'];
}else{
    $gebruiker= $_SESSION['gebruikers'];
}


global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$sql = "select gebruikersnaam, emailadres, voornaam, achternaam, datum, plaatsnaam, adresregel1, postcode, verkoper, geblokkeerd from Gebruiker where gebruikersnaam ='$gebruiker'";
$query = $pdo->prepare($sql);
$query->execute();

$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql_2 = "select banknaam, rekeningnummer, controleoptienaam, creditcardnummer from Verkoper where gebruikersnaam =?";
$query_2 = $pdo->prepare($sql_2);
$query_2->execute(array($gebruiker));

$rows_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

$gebruikersnaam = $rows[0]['gebruikersnaam'];
$emailadres = $rows[0]['emailadres'];
$voornaam = $rows[0]['voornaam'];
$achternaam = $rows[0]['achternaam'];

//De datum wordt hier van jjjj-mm-dd omgezet naar dd-mm-jjjj
$datum_oud = $rows[0]['datum'];
$datum_nieuw = date("d-m-Y", strtotime($datum_oud));

$plaatsnaam = $rows[0]['plaatsnaam'];
$adres = $rows[0]['adresregel1'];
$postcode = $rows[0]['postcode'];
$verkoper = $rows[0]['verkoper'];
$geblokkeerd = $rows[0]['geblokkeerd'];

if($verkoper == 'ja  ') {
    $banknaam = $rows_2[0]['banknaam'];
    $rekingnummer = $rows_2[0]['rekeningnummer'];
    $controle_optie = $rows_2[0]['controleoptienaam'];
    $creditcardnummer = $rows_2[0]['creditcardnummer'];
}

?>