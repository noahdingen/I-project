<?php
if (!isset($_SESSION)) {
    session_start();
}
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
$gebruiker = $_SESSION['gebruikers'];

$data = $conn->prepare("SELECT * FROM Voorwerp");
$data->execute();
$resultaat = $data->fetchAll(PDO::FETCH_NAMED);
$voorwerpnummer = count($resultaat) + 1;

$informatie = array($titel, $beschrijving, $rubriek, $rubriek_keuze, $startprijs, $looptijd_dag, $betalingswijze,
    $afbeelding_1, $betalingsinstructies, $verzendoptie, $land, $plaatsnaam, $verzendinstructies);

$sql_veiling = "INSERT INTO Voorwerp VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CAST(GETDATE() AS DATE), 
convert(time,getdate()), NULL, ?, ?, NULL, DATEADD(dd, 5, CAST(GETDATE() AS DATE)), convert(time,getdate()),'nee', null)";

$veilingen = $conn->prepare($sql_veiling);
$veilingen->execute(array($voorwerpnummer,
    $titel,
    $beschrijving,
    $startprijs,
    $betalingswijze,
    $betalingsinstructies,
    $plaatsnaam,
    $land,
    $looptijd_dag,
    $verzendinstructies,
    $gebruiker
    )
);


?>