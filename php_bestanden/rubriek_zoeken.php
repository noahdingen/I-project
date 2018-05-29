<?php
function haalrubriekenop()
{
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultaat = $_POST['rubriek_keuze'];

    $sql_rubriek = "select * from Allerubrieken where rubrieknummer = ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($resultaat));
    $rijen = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    echo $rijen[0]['rubrieknummer'];
}

function haalrubrieknaamop(){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultaat = $_POST['rubriek_keuze'];

    $sql_rubriek = "select * from Allerubrieken where rubrieknummer = ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($resultaat));
    $rijen = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    echo $rijen[0]['rubriekenpad'];
}

?>
