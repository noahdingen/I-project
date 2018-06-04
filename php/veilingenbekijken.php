<?php

function haalplaatjeop($i, $resultaat){
    echo '<figure>
        <img src="'. $resultaat[$i]['hoofdplaatje'].'" alt="veilingitem">
          </figure>';
    }

function haaltitelop($i, $resultaat){
    if(strlen ($resultaat[$i]['titel']) >21) {
        $veiling = substr($resultaat[$i]['titel'], 0, 17);
        echo "<h4>" . $veiling . "...</h4>";
    }else{
        echo "<h4>" . $resultaat[$i]['titel']. "</h4>";
    }
}

function haalstartprijsop($i, $resultaat){
    echo "<p>Bieden vanaf: €" . $resultaat[$i]['startprijs'] ."</p>";
}

function haalhuidigeprijsop($i, $resultaat){
    $voorwerpnummer = $resultaat[$i]["voorwerpnummer"];
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT bodbedrag  FROM Bod WHERE voorwerpnummer = ? ORDER BY bodbedrag DESC");
    $data->execute(array($voorwerpnummer));
    $bod = $data->fetchAll(PDO::FETCH_NAMED);
    if(!empty($bod)){
        echo "<p>Huidige bod: €" . $bod[0]['bodbedrag'] ."</p>";
    }
    else echo "Nog geen bod uitgebracht";
}

function haaltimerop($i, $resultaat){
    if($resultaat[$i]["geblokkeerd"] == 'nee') {
        $eindtijd = $resultaat[0]['looptijdeindeDag'] . " " . $resultaat[0]['looptijdeindeTijdstip'] . ' GMT+0200';
        echo "<div id='clockdiv" . $i . "'><script> setDeadline('" . $eindtijd . "'); initializeClock('clockdiv" . $i . "', deadline);</script></div>";
    }else{
        echo 'Deze veiling is geblokkeerd';
    }
}

function haalhompeginaop($beheerder){
	date_default_timezone_set("Europe/Amsterdam");
    $conn = verbindMetDatabase();
    if($beheerder){
        $data = $conn->prepare("SELECT TOP 12 * FROM Voorwerp WHERE veilingGesloten = 'nee'");

    }
    else{
        $data = $conn->prepare("SELECT TOP 12 * FROM Voorwerp WHERE geblokkeerd = 'nee' AND veilingGesloten = 'nee'");
    }
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}

function haalinformatieop($resultaat){
    for($i = 0; $i < count($resultaat); $i++) {
            echo '<div class="col-md-4">';
            echo haaltitelop($i, $resultaat);
            echo haalplaatjeop($i, $resultaat);
            echo haaltimerop($i, $resultaat);
            echo haalstartprijsop($i, $resultaat);
            echo haalhuidigeprijsop($i, $resultaat);
            echo '<p><a class="btn btn-secondary" href="detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';
    }
}

function haalrubriekenop($rubrieknummer, $rubrieken, $beheerder){
    for($i=0; $i<count($rubrieken); $i++){
        if($rubrieken[$i]["rubrieknummer"]==$rubrieknummer){

        }
    }
    echo '
    <div class="container">
    <h1 class="display-4">Resultaten</h1>
    <div class="row">
    ';
}

function haalrubriekinformatieop($i, $beheerder){
    $conn = verbindMetDatabase();
    if($beheerder){
        $data = $conn->prepare("SELECT V.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs, geblokkeerd FROM VoorwerpInRubriek R INNER JOIN Voorwerp V ON V.voorwerpnummer=R.voorwerpnummer WHERE rubrieknummerOpLaagsteNiveau = ?");
    }
    else {
        $data = $conn->prepare("SELECT V.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs, geblokkeerd FROM VoorwerpInRubriek R INNER JOIN Voorwerp V ON V.voorwerpnummer=R.voorwerpnummer WHERE rubrieknummerOpLaagsteNiveau = ? and geblokkeerd = 'nee'");
    }
    $data->execute(array($i));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}

function haalbekekenveilingenop($gebruikersnaam){
    date_default_timezone_set("Europe/Amsterdam");
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT DISTINCT Voorwerp.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs FROM Voorwerp INNER JOIN Bod ON Voorwerp.voorwerpnummer = Bod.voorwerpnummer WHERE Bod.gebruikersnaam =?");
    $data->execute(array($gebruikersnaam));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
    if(empty($resultaat)){
       echo '<div class="text-center">'.'U heeft nog geen bod uitgebracht.'.'</div>';
    }
}


function haalmijnveilingenop($gebruikersnaam){
    date_default_timezone_set("Europe/Amsterdam");
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT DISTINCT Voorwerp.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs FROM Voorwerp INNER JOIN Verkoper ON Voorwerp.verkoper = Verkoper.gebruikersnaam WHERE Verkoper.gebruikersnaam =? ");
    $data->execute(array($gebruikersnaam));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
    if(empty($resultaat)){
        echo '<div>'.'U heeft nog geen geen veilingen geplaatst.'.'</div>';
    }
}
