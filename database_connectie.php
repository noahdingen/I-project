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
    echo 'test.<br>';
}

?>

<?php

$hostname  = "(local)";	// naam van ibase_server_info
$dbname = "EenmaalAndermaal";    	// naam van database
$username = "sa";      	// gebruikersnaam
$pw = "Renotje41";

try {
    $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", "$username", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Er ging iets mis met de database.<br>";
    echo "De melding is {$e->getMessage()}<br><br>";
}
?>