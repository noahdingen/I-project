<?php
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