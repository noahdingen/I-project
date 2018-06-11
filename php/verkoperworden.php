<?php
include_once('../databaseverbinding/database_connectie.php');
session_start();

//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$bank = $_POST['banknaam'];
$banknummer = $_POST['IBAN-Nummer'];
$creditcardnummer = $_POST['creditcardnummer'];
$verkoper = 'ja';
$gast = $_SESSION['gebruikers'];
$controle = 'Creditcard';
global $conn;
$conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$error = "Vul een geldig IBAN-Nummer in";

//Controleert of het ingevoerde IBAN nummer geldig is.
function checkIBAN($iban) {

// Normalize input (remove spaces and make upcase)
    $iban = strtoupper(str_replace(' ', '', $iban));

    if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {
        $country = substr($iban, 0, 2);
        $check = intval(substr($iban, 2, 2));
        $account = substr($iban, 4);

        // To numeric representation
        $search = range('A','Z');
        foreach (range(10,35) as $tmp)
            $replace[]=strval($tmp);
        $numstr=str_replace($search, $replace, $account.$country.'00');

        // Calculate checksum
        $checksum = intval(substr($numstr, 0, 1));
        for ($pos = 1; $pos < strlen($numstr); $pos++) {
            $checksum *= 10;
            $checksum += intval(substr($numstr, $pos,1));
            $checksum %= 97;
        }

        return ((98-$checksum) == $check);
    } else
        return false;
}

    if (!checkIBAN($banknummer)) {
        header("location: ../verkoper.php?error=$error");
    }else{

        $sql = "INSERT INTO Verkoper VALUES(?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute(array($gast, $bank, $banknummer, $controle, $creditcardnummer));

        $sql2 = "UPDATE Gebruiker set verkoper = '$verkoper' WHERE gebruikersnaam = ? ";
        $query = $conn->prepare($sql2);
        $query->execute(array($gast));

        header("Location: ../profielpagina.php?bewerken=false");
}
