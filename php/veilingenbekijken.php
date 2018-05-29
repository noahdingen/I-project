<?php

function haalplaatjeop($i, $resultaat){
    echo '<figure>
        <img src="'. $resultaat[$i]['hoofdplaatje'].'" alt="veilingitem">
          </figure>';
    }

function haaltitelop($i, $resultaat){
    if(strlen ($resultaat[$i]['titel']) >21) {
        $veiling = substr($resultaat[$i]['titel'], 0, 20);
        echo "<h3>" . $veiling . "...</h3>";
    }else{
        echo "<h3>" . $resultaat[$i]['titel']. "</h3>";
    }

}

function haalstartprijsop($i, $resultaat){
    echo "<p>Bieden vanaf: €" . $resultaat[$i]['startprijs'] ."</p>";
}

function haalhuidigeprijsop($i, $resultaat){
    $voorwerpnummer = $resultaat[$i]["voorwerpnummer"];
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT bodbedrag  FROM Bod WHERE voorwerpnummer = ?");
    $data->execute(array($voorwerpnummer));
    $bod = $data->fetchAll(PDO::FETCH_NAMED);
    if(!empty($bod)){
        echo "<p>Huidige bod: €" . $bod[$i]['bodbedrag'] .",-</p>";
    }
    else echo "Nog geen bod uitgebracht";
}

function haallooptijdop($i, $resultaat){
    echo "<p>De looptijd is " . $resultaat[$i]['looptijd'] ." dagen</p>";
}

function haalhompeginaop(){
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}

function haalinformatieop($resultaat){
    for($i = 0; $i < count($resultaat); $i++) {
            echo '<div class="col-md-4">';
            echo haaltitelop($i, $resultaat);
            echo haalplaatjeop($i, $resultaat);
            echo haallooptijdop($i, $resultaat);
            echo haalstartprijsop($i, $resultaat);
            echo haalhuidigeprijsop($i, $resultaat);
            echo '<p><a class="btn btn-secondary" href="detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';
    }
}
