<?php
$error = "Gebruikersnaam en/of wachtwoord is onjuist";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

include_once '../Database_verbinding/database_connectie.php';
setlocale(LC_ALL, 'nld_nld');

$gebruikersnaam = valideerFormulierinput($_POST['gebruikersnaam']);
$wachtwoord = valideerFormulierinput($_POST['wachtwoord']);

if (!empty($gebruikersnaam) && !empty($wachtwoord)) {
    if (bestaatGebruikersnaam($gebruikersnaam)) {
        if (bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord)) {
            header("location: ../index.php");
        } else {
            header("location: ../login.php?error=$error");
        }

    }
}

if (isset($_SESSION['errors'])) {
    header("Location: ../login.php");
}

function bestaatGebruikersnaam($gebruikersnaam) {
    $pdo = verbindMetDatabase();

    $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $gebruikersnaam = $query->fetchColumn();
    if ($gebruikersnaam) {
        return true;
    }
    return false;
}

function bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord) {
    $pdo = verbindMetDatabase();
    $sql = "SELECT wachtwoord FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $wachtwoord_hash = $query->fetchColumn();
    if (password_verify($wachtwoord, $wachtwoord_hash)) {
        return true;
    }
    return false;
}
?>