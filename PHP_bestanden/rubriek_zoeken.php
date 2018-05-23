<?php
include_once '../databaseverbinding/database_connectie.php';

$rubriekzoeken = true;

function haalrubriekenop(){
    $conn = verbindMetDatabase();

    $resultaat = $_POST['rubriek'];
    $rubriek = "%" . $resultaat . "%";


    $sql_rubriek = "select * from Categorieen where Name like ?";

    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($rubriek));
    $rows = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    $aantal = count($rows);
    for($i = 0; $i < $aantal; $i++){
        echo '<option value = "' . $rows[$i]['Name'] . '" >' . $rows[$i]['Name'] . '</option >';
    }
}

header('location: ../rubriek_veiling_toevoegen.php');

