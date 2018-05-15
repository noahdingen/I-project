<?php

if (!isset($_SESSION)) {
    session_start();
}

$error_een = "Wachtwoord onjuist";
$error_twee = "Gebruikersnaam bestaat niet";
$error_drie = "U dient beide velden in te vullen";

include_once '../Database_verbinding/database_connectie.php';
//Regel hieronder is voor server!
require_once '../Server_verbinding/SQLSrvConnect.php';
setlocale(LC_ALL, 'nld_nld');


$gebruikersnaam = valideerFormulierinput($_POST['gebruikersnaam']);
$wachtwoord = valideerFormulierinput($_POST['wachtwoord']);


//
//function checkvalidatie(){
//    $conn = verbindMetDatabase();
//    $Gebruiker = $_SESSION['gebruikers'];
//
//    $data = $conn->prepare("SELECT verkoper FROM Gebruiker WHERE gebruikersnaam = '$Gebruiker'AND activatie = 1");
//    $data->execute();
//    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
//    for($i = 0; $i < count($resultaat); $i++){
//
//    }
//
//    if($i == 1){
//        return true;
//    }
//}

if (!empty($gebruikersnaam) && !empty($wachtwoord)) {
    if (bestaatGebruikersnaam($gebruikersnaam)) {
        if (bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord)) {
            $_SESSION['gebruikers'] = $gebruikersnaam;
            header("location: ../index.php");
        } else {
            header("location: ../login.php?error=$error_een");
        }
    }else {
        header("location: ../login.php?error=$error_twee");
    }
}
else {
    header("location: ../login.php?error=$error_drie");
}

function bestaatGebruikersnaam($gebruikersnaam) {
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn;
    $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $gebruikersnaam = $query->fetchColumn();
    return $gebruikersnaam;
}

function bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord) {
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT wachtwoord FROM Gebruiker WHERE gebruikersnaam = ?";
    $pdo = $conn;
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $wachtwoord_hash = $query->fetchColumn();
    return password_verify($wachtwoord, $wachtwoord_hash);
}
?>