<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../databaseverbinding/database_connectie.php';
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$titel = $_POST['titel'];
$beschrijving = $_POST['beschrijving'];
$rubriek = $_POST['rubriek'];
$rubriek_keuze = $_POST['rubriek_keuze'];
$startprijs = $_POST['startprijs'];
$looptijd_dag = $_POST['looptijd_dag'];
$betalingswijze = $_POST['betalingswijze'];
/*
$afbeelding_1 = $_POST['afbeelding_1'];
$afbeelding_2 = $_POST['afbeelding_2'];
$afbeelding_3 = $_POST['afbeelding_3'];
*/
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
    /*$afbeelding_1,*/ $betalingsinstructies, $verzendoptie, $land, $plaatsnaam, $verzendinstructies);

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

$tijdelijkbestand = $_FILES["afbeelding_1"]["tmp_name"];
$bestandsnaam = $_FILES["afbeelding_1"]["name"];
$locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;

move_uploaded_file($tijdelijkbestand,$locatie);

if(isset($_POST['afbeelding_2']))
{
    $tijdelijkbestand = $_FILES["afbeelding_2"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_2"]["name"];
    $locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;

    move_uploaded_file($tijdelijkbestand,$locatie);
}

if(isset($_POST['afbeelding_3']))
{
    $tijdelijkbestand = $_FILES["afbeelding_3"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_3"]["name"];
    $locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;

    move_uploaded_file($tijdelijkbestand,$locatie);
}
?>