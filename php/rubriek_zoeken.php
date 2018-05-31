<?php
function haalrubriekenop()
{
    $conn = verbindMetDatabase();

    $resultaat = $_POST['rubriek'];
    $rubriek = "%" . $resultaat . "%";

    $sql_rubriek = "select * from Allerubrieken where rubriekenpad like ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($rubriek));
    $rows = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    $aantal = count($rows);
    for($i = 0; $i < $aantal; $i++){
        echo '<option value = "' . $rows[$i]['rubrieknummer'] . '" >' . $rows[$i]['rubriekenpad'] . '</option >';

    }
}

function haalrubrieknummerop(){
    $conn = verbindMetDatabase();

    $resultaat = $_POST['rubriek_keuze'];

    $sql_rubriek = "select * from Allerubrieken where rubrieknummer = ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($resultaat));
    $rijen = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    echo $rijen[0]['rubrieknummer'];
}

function haalrubrieknaamop(){
    $conn = verbindMetDatabase();

    $resultaat = $_POST['rubriek_keuze'];

    $sql_rubriek = "select * from Allerubrieken where rubrieknummer = ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($resultaat));
    $rijen = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    echo $rijen[0]['rubriekenpad'];
}



?>




