<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$pdo = verbindMetDatabase();

$sql = "UPDATE Gebruiker SET gebruikersnaam='GET_[gebruikersnaam]' WHERE gebruikersnaam = 'TEST'";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

echo 'hallo';
echo $_SESSION['gebruikers'];

header("location: ../profielpagina.php?error");



//foreach ($klantgegevens as $value){
//    if(isset($value)){
//        echo $value;
//    }
//}
//header("location: ../profielpagina.php?bewerken=false");