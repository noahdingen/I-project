<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../Database_verbinding/database_connectie.php';
function haaldetailsop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $voorwerp = $conn->prepare("select titel, beschrijving, looptijd, verkoper from Voorwerp where voorwerpnummer = ?");
    $voorwerp->execute(array($voorwerpnummer));
    $resultaat_voorwerp = $voorwerp->fetchAll(PDO::FETCH_NAMED);
    $titel = $resultaat_voorwerp[0]['titel'];
    $beschrijving = $resultaat_voorwerp[0]['beschrijving'];
    $looptijd = $resultaat_voorwerp[0]['looptijd'];
    $verkoper = $resultaat_voorwerp[0]['verkoper'];

    $bestand = $conn->prepare("select filenaam from Bestand where voorwerpnummer = ?");
    $bestand->execute(array($voorwerpnummer));
    $resultaat_bestand = $bestand->fetchAll(PDO::FETCH_NAMED);
    $afbeelding = $resultaat_bestand[0]['filenaam'];

    $bod = $conn->prepare("select bodbedrag, gebruikersnaam, bodTijdstip from Bod where voorwerpnummer = ?");
    $bod->execute(array($voorwerpnummer));
    $resultaat_bod = $bod->fetchAll(PDO::FETCH_NAMED);
    $bodbedrag = $resultaat_bod[0]['bodbedrag'];
    $koper = $resultaat_bod[0]['gebruikersnaam'];
    $bod_tijdstip = $resultaat_bod[0]['bodTijdstip'];

    $voorwerp_informatie = array('titel' => $titel, 'beschrijving' => $beschrijving, 'looptijd' => $looptijd, 'afbeelding' => $afbeelding,
                                'bodbedrag' => $bodbedrag, 'koper' => $koper, 'bodtijdstip' => $bod_tijdstip, 'verkoper' => $verkoper);
    return $voorwerp_informatie;
}
?>
