<?php

$hostname  = "localhost";	// naam van ibase_server_info
$dbname = "EenmaalAndermaal";    	// naam van database
$username = "sa";      	// gebruikersnaam
$pw = "dbrules";

try {
    $dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", "$username", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Er ging iets mis met de database.<br>";
    echo "De melding is {$e->getMessage()}<br><br>";
}
?>