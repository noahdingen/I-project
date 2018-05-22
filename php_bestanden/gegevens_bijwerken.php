<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$pdo = verbindMetDatabase();
$oude_gebruikersnaam = $_GET['gebruikersnaam'];
$nieuwe_gebruikersnaam = $_POST['gebruikersnaam'];
foreach ($_POST as $key => $value){
    if($value != '') {
        echo "UPDATE Gebruiker SET $key = '$value' WHERE gebruikersnaam = '$oude_gebruikersnaam'";
        if($key==='gebruikersnaam' && $nieuwe_gebruikersnaam!==''){
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = '$value' WHERE gebruikersnaam = '$oude_gebruikersnaam'");
            $_SESSION['gebruikers'] = $nieuwe_gebruikersnaam;
        }
        else if($nieuwe_gebruikersnaam===''){
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = '$value' WHERE gebruikersnaam = '$oude_gebruikersnaam'");
        }
        else{
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = '$value' WHERE gebruikersnaam = '$nieuwe_gebruikersnaam'");
            $_SESSION['gebruikers'] = $nieuwe_gebruikersnaam;
        }
        $data->execute();
    }
}
header("location: ../profielpagina.php?bewerken=false");