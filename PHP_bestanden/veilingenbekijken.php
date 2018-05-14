<?php

function haalplaatjeop($i){
    $conn = verbindMetDatabase();

      $data = $conn->query("SELECT * FROM Bestand  ORDER BY voorwerpnummer ");
      $data->execute();
      $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
         echo '<figure>
                    <img src="'. $resultaat[$i]['filenaam'].'">
               </figure>';

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

function haalinformatieop(){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){
        echo '<div class="col-md-4">';
        echo "<h2>". $resultaat[$i]['titel']. "</h2>";
        echo  haalplaatjeop($i);
        echo "<p>" . $resultaat[$i]['beschrijving'] ."</p>";
        ?>
        <p><a class="btn btn-secondary" href="detailpagina.php" role="button">Zie details &raquo;</a></p>
        </div>
        <?php
    }
}