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
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT MAX(bodbedrag) as hoogste_bod, gebruikersnaam FROM Bod WHERE voorwerpnummer = ? GROUP BY bodbedrag, gebruikersnaam  ORDER BY bodbedrag DESC ");
    $data->execute(array($voorwerpnummer));
    $bod = $data->fetchAll(PDO::FETCH_NAMED);
    if(!empty($bod)){
        echo "<p>Huidige bod: €" . $bod[0]['hoogste_bod'] .",-</p>";
    }
    else echo "Nog geen bod uitgebracht";
}

function haallooptijdop($i, $resultaat){
    echo "<p>De looptijd is " . $resultaat[$i]['looptijd'] ." dagen</p>";
}

function haaltimerop($i, $resultaat){
    $voorwerpnummer =  $resultaat[$i]["voorwerpnummer"];
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
    $eindtijd = $info[0]['looptijdeindeDag']." ".$info[0]['looptijdeindeTijdstip'].' GMT+0200';

    echo "<div id='clockdiv".$i."'><script> setDeadline('".$eindtijd."'); initializeClock('clockdiv".$i."', deadline);</script></div>";


}

function haalhompeginaop(){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}

function haalinformatieop($resultaat){
    $lijstnummer = 1;
    for($i = 0; $i < count($resultaat); $i++) {
        echo '<div class="col-md-4">';
        echo haaltitelop($i, $resultaat);
        echo haalplaatjeop($i, $resultaat);
        echo haaltimerop($i, $resultaat);
        echo haalstartprijsop($i, $resultaat);
        echo haalhuidigeprijsop($i, $resultaat);
        echo '<p><a class="btn btn-secondary" href="../detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';


    }
}
