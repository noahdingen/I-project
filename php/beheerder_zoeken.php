<?php
$gebruiker = $_SESSION['gebruikers'];
    $pdo = verbindMetDatabase();
    $sql = "select beheerder from Gebruiker where gebruikersnaam =?";
    $query = $pdo->prepare($sql);
    $query->execute(array($gebruiker));
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $beheerder = $rows[0]['beheerder'];
    if($beheerder == 'ja'){
        $vraag = true;
    }else{
        $vraag = false;
    }

