<?php
session_start();
// maak verbinding met database
require_once '../databaseverbinding/database_connectie.php';
//Regel hieronder is voor server!
//require_once '../server_verbinding/';
//if(isset($_GET['user'])){
//    $gebruiker = $_GET ['user'];
//    echo $gebruiker;
//}else{
//    $gebruiker = '';
//}

//if (!isset($_SESSION)) {
//    session_start();
//}
$title = 'wachtwoord wijzigen';
$paginatitel = 'wachtwoord wijzigen';
$pagina= './login.php';
//$pdo = verbindMetDatabase();
//Regel hieronder is voor server!
//$pdo = $conn;
$paginaFout = './db_registratie.php';
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gebruikersnaam = $_POST['gebruiker'];
    $query = $conn->prepare("DELETE FROM WachtwoordVeranderen WHERE gebruikersnaam = ?");
    $query->execute(array($gebruikersnaam));
        if ($_POST['wachtwoord'] == $_POST['bevestig_wachtwoord']) {
            $wachtwoord = $_POST['wachtwoord'];
            $wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
            $statement = "update Gebruiker set wachtwoord = ? where gebruikersnaam = ?";
            $opdracht = $conn->prepare($statement);
            $opdracht->execute(array($wachtwoord,$gebruikersnaam));
            echo 'Voltooid u wordt zo doorgestuurd.';
            header("refresh:5; url='../login.php'");
        }
        else {
            $error = "wachtwoorden komen niet overeen";
            header("refresh:0; url='../wachtwoord_wijzigen.php?error=$error'");
        }
