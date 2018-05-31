<?php

if (!isset($_SESSION)) {
    session_start();
}

$error_een = "Wachtwoord onjuist";
$error_twee = "Gebruikersnaam bestaat niet";
$error_drie = "U dient beide velden in te vullen";
$error_vier = "Dit account  bestaat niet of is niet geactiveerd!";
$error_vijf = "Uw account is geblokkeerd!";

include_once '../databaseverbinding/database_connectie.php';
//Regel hieronder is voor server!
//require_once '../server_verbinding/sql_srv_connect.php';
setlocale(LC_ALL, 'nld_nld');


$gebruikersnaam = valideerFormulierinput($_POST['gebruikersnaam']);
$wachtwoord = valideerFormulierinput($_POST['wachtwoord']);
$geblokkeerd = is_gebruiker_geblokkeerd($gebruikersnaam);
// functie om te controleren of een account is geactiveerd
function checkvalidatie($gebruiker){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = '$gebruiker'AND activatie = 1");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){

    }
    return $i;
}
// checkt alle ingevoegde waardes
if (!empty($gebruikersnaam) && !empty($wachtwoord)) {
    if (bestaatGebruikersnaam($gebruikersnaam)) {
        if (checkvalidatie($gebruikersnaam)) {
            if($geblokkeerd == 'nee') {
                if (bestaatCombinatieVanGebruikersnaamEnWachtwoord($gebruikersnaam, $wachtwoord)) {
                    $_SESSION['gebruikers'] = $gebruikersnaam;
                    header("refresh:0; url='../index.php'");
                } else {
                    header("location: ../login.php?error=$error_een");
                }
            }
            else{
                header("location: ../login.php?error=$error_vijf");
            }
        } else {
            header("location: ../login.php?error=$error_vier");
        }}
    else {
            header("location: ../login.php?error=$error_twee");
    }
}
else {
    header("location: ../login.php?error=$error_drie");
}
// controleert of gebruikersnaam bestaat
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
// controleert of combinatie van gebruikersnaam met wachtwoord bestaat
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

function is_gebruiker_geblokkeerd($gebruikersnaam){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn;

    $sql = "SELECT geblokkeerd FROM Gebruiker WHERE gebruikersnaam = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$gebruikersnaam]);
    $geblokkeerd = $query->fetchColumn();
    return $geblokkeerd;
}
?>