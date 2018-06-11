<?php

$veilingenteller = 0;

//Haalt de thumbnail op van het voorwerp.

function haalplaatjeop($plaatje){
    echo '<figure>
        <img src="'. $plaatje .'" alt="veilingitem">
          </figure>';
}
//Haalt de titel op van het voorwerp.
function haaltitelop($titel){
    if(strlen ($titel) >21) {
        $veiling = substr($titel, 0, 17);
        echo "<h4>" . $veiling . "...</h4>";
    }else{
        echo "<h4>" . $titel . "</h4>";
    }
}
//Haalt de startprijs (minimale bod) van het voorwerp op.
function haalstartprijsop($startprijs){
    echo "<p>Bieden vanaf: €" . $startprijs ."</p>";
}
//Kijkt wat het hoogst geboden bedrag is en laat deze zien. Is er nog niks geboden, dan komt er Nog geen bod uitgebracht te staan.
function haalhuidigeprijsop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT bodbedrag  FROM Bod WHERE voorwerpnummer = ? ORDER BY bodbedrag DESC");
    $data->execute(array($voorwerpnummer));
    $bod = $data->fetchAll(PDO::FETCH_NAMED);
    if(!empty($bod)){
        echo "<p>Huidige bod: €" . $bod[0]['bodbedrag'] ."</p>";
    }
    else echo "<p>Nog geen bod uitgebracht</p>";
}
//Haalt de looptijd van de veiling op.
function haaltimerop($dag, $tijdstip, $geblokkeerd, $i){
    if($geblokkeerd == 'nee') {
        $eindtijd = $dag . " " . $tijdstip . ' GMT+0200';
        echo "<div id='clockdiv" . $i . "'><script> setDeadline('" . $eindtijd . "'); initializeClock('clockdiv" . $i . "', deadline);</script></div>";
    }else{
        echo 'Deze veiling is geblokkeerd';
    }
}
//Haalt de 12 nieuwste veilingen op.
function haalhompeginaop($beheerder){
    date_default_timezone_set("Europe/Amsterdam");
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($beheerder == 'ja'){
        $data = $conn->prepare("SELECT TOP 12 * FROM Voorwerp WHERE veilingGesloten = 'nee' ORDER BY looptijdbegindag DESC , looptijdbeginTijdstip DESC");

    }
    else{
        $data = $conn->prepare("SELECT TOP 12 * FROM Voorwerp WHERE geblokkeerd = 'nee' AND veilingGesloten = 'nee' ORDER BY looptijdbegindag DESC , looptijdbeginTijdstip DESC");
    }
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}
//Combineert de functies samen in 1 functie om onderstaande informatie op te halen.
function haalinformatieop($resultaat){
    for($i = 0; $i < count($resultaat); $i++) {
            haalveilinginformatieop($resultaat, $i);
    }
}

function haalveilinginformatieop($veiling, $i){
    echo '<div class="col-md-4">';
    echo haaltitelop($veiling[$i]["titel"]);
    echo haalplaatjeop($veiling[$i]["hoofdplaatje"]);
    echo haaltimerop($veiling[$i]["looptijdeindeDag"], $veiling[$i]["looptijdeindeTijdstip"], $veiling[$i]["geblokkeerd"], $i);
    echo haalstartprijsop($veiling[$i]["startprijs"]);
    echo haalhuidigeprijsop($veiling[$i]["voorwerpnummer"]);
    echo '<p><a class="btn btn-secondary" href="../detailpagina.php?voorwerpnummer=' . $veiling[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';
}

function haalrubriekenop($rubrieknummer, $rubrieken, $voorwerpen, $beheerder){
    for($i=0; $i<count($rubrieken); $i++){
        if($rubrieken[$i]["rubrieknummer"]==$rubrieknummer){
            haalrubriekinformatieop($rubrieken[$i]["rubrieknummer"], $voorwerpen, $beheerder);
            haalkindrubriekop($rubrieken[$i]["rubrieknummer"], $rubrieken, $voorwerpen, $beheerder);
        }
    }
}

function haalkindrubriekop($rubrieknummer, $rubrieken, $voorwerpen, $beheerder){
    for($i=0; $i<count($rubrieken); $i++){
        if($rubrieken[$i]["rubriek"]==$rubrieknummer){
            haalrubriekinformatieop($rubrieken[$i]["rubrieknummer"], $voorwerpen, $beheerder);
            haalkindrubriekop($rubrieken[$i]["rubrieknummer"], $rubrieken, $voorwerpen, $beheerder);
        }
    }
}

function haalvoorwerpeninrubriekenop(){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT V.voorwerpnummer, rubrieknummerOpLaagsteNiveau, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs, geblokkeerd FROM VoorwerpInRubriek R INNER JOIN Voorwerp V ON V.voorwerpnummer=R.voorwerpnummer");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    return $resultaat;
}

function haalrubriekinformatieop($rubrieknummer, $voorwerpen, $beheerder){
    for($i=0; $i<count($voorwerpen); $i++){
        if($voorwerpen[$i]["rubrieknummerOpLaagsteNiveau"]==$rubrieknummer){
            if($voorwerpen[$i]["geblokkeerd"] == 'nee' && ($voorwerpen[$i]["veilingGesloten"] == 'nee' || empty($voorwerpen[$i]["veilingGesloten"]))){
                $GLOBALS['veilingenteller']++;
                haalveilinginformatieop($voorwerpen, $i);
            }
            else if($beheerder == 'ja'){
                $GLOBALS['veilingenteller']++;
                haalveilinginformatieop($voorwerpen, $i);
            }
        }
    }
}
//Haalt veilingen op waarop de gebruiker heeft geboden.
function haalgebodenveilingenop($gebruikersnaam){
    date_default_timezone_set("Europe/Amsterdam");
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT DISTINCT Voorwerp.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs, geblokkeerd FROM Voorwerp INNER JOIN Bod ON Voorwerp.voorwerpnummer = Bod.voorwerpnummer WHERE Bod.gebruikersnaam =?");
    $data->execute(array($gebruikersnaam));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
    if(empty($resultaat)){
        echo '<div class="col text-center">'.'U heeft nog geen bod uitgebracht.'.'</div>';
    }
}

//Haalt de veilingen op die door de ingelogde persoon zijn geplaatst.
function haalmijnveilingenop($gebruikersnaam){
    date_default_timezone_set("Europe/Amsterdam");
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = $conn->prepare("SELECT DISTINCT Voorwerp.voorwerpnummer, titel, hoofdplaatje, looptijdeindeDag, looptijdeindeTijdstip, startprijs, geblokkeerd  FROM Voorwerp INNER JOIN Verkoper ON Voorwerp.verkoper = Verkoper.gebruikersnaam WHERE Verkoper.gebruikersnaam =? ");
    $data->execute(array($gebruikersnaam));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
    if(empty($resultaat)){
        echo '<div class="col text-center">'.'U heeft nog geen veilingen geplaatst.'.'</div>';
    }
}
