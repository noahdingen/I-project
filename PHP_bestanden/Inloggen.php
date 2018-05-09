<?php

if (!isset($_SESSION)) {
    session_start();
}

$error_een = "Wachtwoord onjuist";
$error_twee = "Gebruikersnaam bestaat niet";
$error_drie = "U dient beide velden in te vullen";

include_once '../Database_verbinding/database_connectie.php';
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';
setlocale(LC_ALL, 'nld_nld');

$gebruikersnaam = valideerFormulierinput($_POST['gebruikersnaam']);
$wachtwoord = valideerFormulierinput($_POST['wachtwoord']);

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
    $pdo = verbindMetDatabase();

    $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $gebruikersnaam = $query->fetchColumn();
    return $gebruikersnaam;
}

function bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord) {
    $pdo = verbindMetDatabase();
    $sql = "SELECT wachtwoord FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $wachtwoord_hash = $query->fetchColumn();
    return password_verify($wachtwoord, $wachtwoord_hash);
}
?>