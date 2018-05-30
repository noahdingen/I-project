<?php
include_once 'databaseverbinding/database_connectie.php';



global $conn;
$conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
if(isset($_POST['gebruikersnaam_zoeken'])) {
    $resultaat = $_POST['gebruikersnaam_zoeken'];
}
else{
    $resultaat ='helemaal nul';
}

$conn = verbindMetDatabase();
$data = $conn->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam LIKE'%" . $resultaat . "%'");
$data->execute();
$rijen = $data->fetchAll(PDO::FETCH_NAMED);
$aantal = count($rijen);
if (!empty($rijen)) {
    for ($i = 0; $i < $aantal; $i++) {
        echo $rijen[$i]['gebruikersnaam'];
        echo '<br>';
    }
}
// header("location:zoek_gebruiker.php?gebruikers=$resultaat");
//        } else {
//
//            //header("location: gebruiker_zoeken.php?error=Geen gebruikers gevonden");
//        }
//    }
//gebruikers_ophalen();
///header("location:gebruiker_zoeken.php?gebruikers=$resultaat");