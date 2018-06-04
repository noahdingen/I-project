<?php
include_once('../databaseverbinding/database_connectie.php');
if (!isset($_SESSION)) {
    session_start();
}

//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$bank = $_POST['banknaam'];
$banknummer = $_POST['IBAN-Nummer'];
$creditcardnummer = $_POST['creditcardnummer'];
$verkoper = 'ja  ';
$gast = $_SESSION['gebruikers'];
$controle = 'Creditcard';
$conn = verbindMetDatabase();
$error = "Vul een geldig IBAN-Nummer in";

//Controleert of het ingevoerde IBAN nummer geldig is.
function checkIBAN($iban) {

    // maakt input normaal (haalt grote letters en spaties weg)
    $iban = strtoupper(str_replace(' ', '', $iban));

    if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {
        $land = substr($iban, 0, 2);
        $check = intval(substr($iban, 2, 2));
        $account = substr($iban, 4);

        // naar nummers
        $zoeken = range('A','Z');
        foreach (range(10,35) as $tmp)
            $vervang[]=strval($tmp);
        $numstr=str_replace($zoeken, $vervang, $account.$land.'00');

        // berekent het
        $checksom = intval(substr($numstr, 0, 1));
        for ($pos = 1; $pos < strlen($numstr); $pos++) {
            $checksom *= 10;
            $checksom += intval(substr($numstr, $pos,1));
            $checksom %= 97;
        }

        return ((98-$checksom) == $check);
    } else
        return false;
}

    if (!checkIBAN($banknummer)) {
        header("location: ../verkoper.php?error=$error");
    }else{

        $sql = "INSERT INTO Verkoper  VALUES(?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute(array($gast, $bank, $banknummer, $controle, $creditcardnummer));
;

        $sql2 = "UPDATE Gebruiker  set verkoper = '$verkoper' WHERE gebruikersnaam = '$gast' ";
        $query = $conn->prepare($sql2);
        $query->execute();

        header("Location: verkoperworden.php?bewerken=false");
        //header("Location: ../profielpagina.php?bewerken=false");
}
