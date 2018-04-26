<?php
function verbindMetDatabase() {
    $hostnaam = 'localhost';
    $databasenaam = 'EenmaalAndermaal';
    $gebruikersnaam = 'sa';
    $wachtwoord = 'renotje41';
    global $pdo;
    $pdo = new PDO("sqlsrv:Server=$hostnaam; Database=$databasenaam; ConnectionPooling = 0", "$gebruikersnaam", "$wachtwoord");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function valideerFormulierinput($data) {
    strip_tags($data);
    trim($data);

    return $data;
}

?>
