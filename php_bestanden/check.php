<?php
// fout meldingen voor account activatie
$error_een = "Activatie code onjuist";
$error_twee = "Gebruikersnaam bestaat niet";
$error_drie = "U dient beide velden in te vullen";

include_once '../database_verbinding/database_connectie.php';
//Regel hieronder is voor server!
require_once '../server_verbinding/sql_srv_connect.php';
global $conn;
$conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

setlocale(LC_ALL, 'nld_nld');
// Hier wordt gecontroleerd of de activatie code die per mail wordt verstuurd gekoppeld is aan het account en deze dan vervolgens op actief zet
$gebruikersnaam = valideerFormulierinput($_POST['gebruikersnaam']);
$mailcode = valideerFormulierinput($_POST['mailcode']);
if (!empty($gebruikersnaam) && !empty($mailcode)) {
    if (bestaatGebruikersnaam($gebruikersnaam)) {
        $bool = bestaatCombinatieVanGebruikersnaamEnmailcode($mailcode);
        if ($bool) {
            $_SESSION['gebruikers'] = $gebruikersnaam;
            $activeren = "UPDATE Gebruiker set activatie = 1 FROM Gebruiker WHERE gebruikersnaam = '$gebruikersnaam' ";
            $query = $conn->prepare($activeren);
            $query->execute();
           header("location: ../index.php");
        } else {
            header("location: ../check_account.php?error=$error_een");
        }
    }else {
        header("location: ../check_account.php?error=$error_twee");
    }
}
else {
    header("location: ../check_account.php?error=$error_drie");
}
// controleert of gebruikersnaam bestaat
function bestaatGebruikersnaam($gebruikersnaam) {
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $pdo = $conn;
    $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = '$gebruikersnaam'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $gebruikersnaam = $query->fetchColumn();
    return $gebruikersnaam;
}
// controleert de activatie code
function bestaatCombinatieVanGebruikersnaamEnmailcode($mailcode) {
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql2 = $conn->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE mailcode = '$mailcode'");
    $sql2->execute();
    $mailcode = $sql2->fetchColumn();
    return $mailcode;
}
?>