<?php
include_once '../databaseverbinding/database_connectie.php';
$conn = verbindMetDatabase();

$titel = $_POST['titel'];
$beschrijving = $_POST['beschrijving'];
$rubriek = $_POST['rubriek'];
$rubriek_keuze = $_POST['rubriek_keuze'];
$startprijs = $_POST['startprijs'];
$looptijd_dag = $_POST['looptijd_dag'];
$betalingswijze = $_POST['betalingswijze'];
$afbeelding_1 = $_POST['afbeelding_1'];
$afbeelding_2 = $_POST['afbeelding_2'];
$afbeelding_3 = $_POST['afbeelding_3'];
$betalingsinstructies = $_POST['betalingsinstructies'];
$verzendoptie = $_POST['verzendoptie'];
$land = $_POST['land'];
$plaatsnaam = $_POST['plaatsnaam'];
$verzendinstructies = $_POST['verzendinstructies'];
$gebruiker = $_SESSION['gebruiker'];

$data = $conn->prepare("SELECT * FROM Voorwerp");
$data->execute();
$resultaat = $data->fetchAll(PDO::FETCH_NAMED);

$voorwerpnummer = count($resultaat) + 1;

$veilingen = $conn->prepare("INSERT INTO Voorwerp VALUES (?, ?, ?, ?, 'creditcard', ?, ?, ?, ?, CAST(GETDATE() AS DATE), convert(time,getdate()), NULL, ?, ?, NULL, DATEADD(dd, ?, CAST(GETDATE() AS DATE)), convert(time,getdate()),'nee', ?");
$veilingen->execute(array($voorwerpnummer, $titel, $beschrijving, $startprijs, $betalingsinstructies, $plaatsnaam, $land, $looptijd_dag, $verzendinstructies, $gebruiker, $looptijd_dag, $startprijs));
$resultaat_voorwerp = $veilingen->fetchAll(PDO::FETCH_NAMED);
?>