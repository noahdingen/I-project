<?php
//$conn = verbindMetDatabase();
//
//$data = $conn->prepare("SELECT * FROM Voorwerp");
//$data->execute();
//$resultaat = $data->fetchAll(PDO::FETCH_NAMED);
//for($i = 0; $i < count($resultaat); $i++){
//    echo "<div>"  . $resultaat[$i]['titel'] . $resultaat[$i]['beschrijving'] ."</div>";
//}
//$afbeelding = $conn->prepare("SELECT * FROM Bestand");
//$afbeelding->execute();
//$resultaat = $afbeelding->fetchAll(PDO::FETCH_NAMED);
//for($i = 0; $i < count($afbeelding); $i++){
//    echo "<div>"  . $afbeelding[$i]['titel'] . $afbeelding[$i]['beschrijving'] ."</div>";
//}

function haalplaatjeop(){
    $conn = verbindMetDatabase();

      $data = $conn->query("SELECT * FROM Bestand");
      $row = $data->fetch(); echo $row['filenaam'],"";

    }

function haaltitelop(){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){
        echo "<h2>". $resultaat[$i]['titel']. "</h2>";
    }
}

function haalbeschrijvingop(){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){
        echo "<p>" . $resultaat[$i]['beschrijving'] ."</p>";
    }
}

