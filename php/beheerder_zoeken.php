<?php
if(isset($_GET['voorwerpnummer'])) {
    $voorwerp = $_GET['voorwerpnummer'];

    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn;
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