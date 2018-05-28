<?php
include_once '../databaseverbinding/database_connectie.php';
if (!isset($_SESSION)) {
    session_start();
}
$conn = verbindMetDatabase();

$titel = $_POST['titel'];
$beschrijving = $_POST['beschrijving'];
$rubriek = $_POST['rubriek'];
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

$fileExt = explode('.', $bestandsnaam);
$fileActualExt = strtolower((end($fileExt)));
$fileNameNew = uniqid('', true).".".$fileActualExt;
$locatie_map = "../assets/veilingen_afbeeldingen/".$fileNameNew;
$locatie_db = "assets/veilingen_afbeeldingen/".$fileNameNew;

move_uploaded_file($tijdelijkbestand,$locatie_map);


$informatie = array($titel, $beschrijving, $rubriek, $startprijs, $looptijd_dag, $betalingswijze,
    $betalingsinstructies, $verzendoptie, $land, $plaatsnaam, $verzendinstructies);

//voorwerp in database zetten
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
            $locatie_db
        )
    );

//rubriek in database zetten
$conn = verbindMetDatabase();
$sql_rubriek = "insert into VoorwerpInRubriek values(?,?)";
$rubrieken = $conn->prepare($sql_rubriek);
$rubrieken->execute(array($voorwerpnummer, $rubriek));


//afbeeldingen in database zetten
$sql_afbeelding = "insert into Bestand values(?,?)";

$afbeelding = $conn->prepare($sql_afbeelding);
$afbeelding->execute(array($locatie_db, $voorwerpnummer));



if(!empty($_FILES["afbeelding_2"]["tmp_name"]))
{
    $tijdelijkbestand = $_FILES["afbeelding_2"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_2"]["name"];

    $fileExt = explode('.', $bestandsnaam);
    $fileActualExt = strtolower((end($fileExt)));
    $fileNameNew = uniqid('', true).".".$fileActualExt;
    $locatie_map = "../assets/veilingen_afbeeldingen/".$fileNameNew;
    $locatie_db = "assets/veilingen_afbeeldingen/".$fileNameNew;

    move_uploaded_file($tijdelijkbestand,$locatie_map);

    $sql_afbeelding = "insert into Bestand values(?,?)";

    $afbeelding = $conn->prepare($sql_afbeelding);
    $afbeelding->execute(array($locatie_db, $voorwerpnummer));
}

if(!empty($_FILES["afbeelding_3"]["tmp_name"]))
{
    $tijdelijkbestand = $_FILES["afbeelding_3"]["tmp_name"];
    $bestandsnaam = $_FILES["afbeelding_3"]["name"];

    $fileExt = explode('.', $bestandsnaam);
    $fileActualExt = strtolower((end($fileExt)));
    $fileNameNew = uniqid('', true).".".$fileActualExt;
    $locatie_map = "../assets/veilingen_afbeeldingen/".$fileNameNew;
    $locatie_db = "assets/veilingen_afbeeldingen/".$fileNameNew;

    move_uploaded_file($tijdelijkbestand,$locatie_map);

    $sql_afbeelding = "insert into Bestand values(?,?)";

    $afbeelding = $conn->prepare($sql_afbeelding);
    $afbeelding->execute(array($locatie_db, $voorwerpnummer));
}

header("location: ../succesvol_veiling.php");
?>