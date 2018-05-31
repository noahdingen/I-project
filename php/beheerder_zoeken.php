<?php
if (isset($_SESSION['gebruikers'])) {
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
}else {
    $vraag = false;
}

    if(isset($_GET['voorwerpnummer'])) {
        $voorwerp = $_GET['voorwerpnummer'];
        $pdo = verbindMetDatabase();
        $sql_2 = "select geblokkeerd from Voorwerp where voorwerpnummer =?";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->execute(array($voorwerp));
        $rows_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
        $geblokkeerd = $rows_2[0]['geblokkeerd'];
        if ($geblokkeerd == 'ja') {
            $item = true;
        } else {
            $item = false;
        }
    }
