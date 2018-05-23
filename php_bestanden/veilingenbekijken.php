<?php

function haalplaatjeop($i){
    $conn = verbindMetDatabase();

      $data = $conn->query("SELECT * FROM Bestand  ORDER BY voorwerpnummer ");
      $data->execute();
      $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
         echo '<figure>
                    <img src="../assets/veilingen_afbeeldingen'. $resultaat[$i]['filenaam'].'" alt="veilingitem">
               </figure>';

    }


function haaltitelop($i){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    if(strlen ($resultaat[$i]['titel']) >21) {
        $veiling = substr($resultaat[$i]['titel'], 0, 20);
        echo "<h3>" . $veiling . "...</h3>";
    }else{
        echo "<h3>" . $resultaat[$i]['titel']. "</h3>";
    }

}

function haalprijsop($i){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
        echo "<p>€" . $resultaat[$i]['startprijs'] .",-</p>";

}

function haallooptijdop($i){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    echo "<p>De looptijd is " . $resultaat[$i]['looptijd'] ." dagen</p>";

}

function haalinformatieop(){
    $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < 6; $i++){
        echo '<div class="col-md-4">';
        echo haaltitelop($i);
        echo  haalplaatjeop($i);
        echo haallooptijdop($i);
        echo haalprijsop($i);
        echo '<p><a class="btn btn-secondary" href="detailpagina.php?voorwerpnummer=' . ($i+1) . '" role="button">Zie details &raquo;</a></p>
        </div>';
    }
}
