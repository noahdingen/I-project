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

//afbeelding in map zetten
$tijdelijkbestand = $_FILES["afbeelding_1"]["tmp_name"];
$bestandsnaam = $_FILES["afbeelding_1"]["name"];
$locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;

move_uploaded_file($tijdelijkbestand,$locatie);


$informatie = array($titel, $beschrijving, $rubriek, $rubriek_keuze, $startprijs, $looptijd_dag, $betalingswijze,
    $betalingsinstructies, $verzendoptie, $land, $plaatsnaam, $verzendinstructies);

$sql_veiling = "INSERT INTO Voorwerp VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CAST(GETDATE() AS DATE), 
convert(time,getdate()), NULL, ?, ?, NULL, DATEADD(dd, 5, CAST(GETDATE() AS DATE)), convert(time,getdate()),'nee', null, ?)";

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
    $gebruiker,
    $bestandsnaam
    )
);

$sql_afbeelding = "insert into Bestand values(?,?)";

$afbeelding = $conn->prepare($sql_afbeelding);
$afbeelding->execute(array($bestandsnaam, $voorwerpnummer));



if(!empty($_FILES["afbeelding_2"]["tmp_name"]))
{
    $tijdelijkbestand = $_FILES["afbeelding_2"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_2"]["name"];
    $locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;
    move_uploaded_file($tijdelijkbestand,$locatie);

    $sql_afbeelding = "insert into Bestand values(?,?)";

    $afbeelding = $conn->prepare($sql_afbeelding);
    $afbeelding->execute(array($bestandsnaam, $voorwerpnummer));
}

if(!empty($_FILES["afbeelding_3"]["tmp_name"]))
{
    $tijdelijkbestand = $_FILES["afbeelding_3"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_3"]["name"];
    $locatie = "../assets/veilingen_afbeeldingen/".$bestandsnaam;

    move_uploaded_file($tijdelijkbestand,$locatie);

    $sql_afbeelding = "insert into Bestand values(?,?)";

    $afbeelding = $conn->prepare($sql_afbeelding);
    $afbeelding->execute(array($bestandsnaam, $voorwerpnummer));
}

?>