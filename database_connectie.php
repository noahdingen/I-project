<?php
$hostnaam = 'localhost';
$databasenaam = 'EenmaalAndermaal';
$gebruikersnaam = 'sa';
$wachtwoord = 'dbrules';

try {
    $handler = new PDO("sqlsrv:Server=$hostnaam;Database=$databasenaam;
  ConnectionPooling=0", $gebruikersnaam, $wachtwoord);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo 'Er ging eventjes iets mis in de database. <br>';
}