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
    $data = $conn->prepare("SELECT bodbedrag  FROM Bod WHERE voorwerpnummer = ? ");
    $data->execute(array($voorwerpnummer));
    $bod = $data->fetchAll(PDO::FETCH_NAMED);
    if(!empty($bod)){
        echo "<p>Huidige bod: €" . $bod[$i]['bodbedrag'] ."</p>";
    }
    else echo "Nog geen bod uitgebracht";
}

function haaltimerop($i, $resultaat){
	$voorwerpnummer =  $resultaat[$i]["voorwerpnummer"];
	$conn = verbindMetDatabase();
	$sql = $conn->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp WHERE voorwerpnummer = ? and geblokkeerd = 'nee'");
	$sql->execute(array($voorwerpnummer));
	$info = $sql->fetchAll(PDO::FETCH_ASSOC);
	$eindtijd = $info[0]['looptijdeindeDag']." ".$info[0]['looptijdeindeTijdstip'].' GMT+0200';

	echo "<div id='clockdiv".$i."'><script> setDeadline('".$eindtijd."'); initializeClock('clockdiv".$i."', deadline);</script></div>";
}

function haalhompeginaop(){
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp WHERE geblokkeerd = 'nee' AND (looptijdeindeDag = ? AND looptijdeindeTijdstip > ?) OR looptijdeindeDag > ?");
    $data->execute(array($huidige_dag, $huidige_tijd, $huidige_dag));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    haalinformatieop($resultaat);
}

function haalinformatieop($resultaat){
    $lijstnummer = 1;
    for($i = 0; $i < count($resultaat); $i++) {
        if (haalblokadeop($resultaat[$i]["voorwerpnummer"])[0]['geblokkeerd'] == 'ja') {
            include_once 'beheerder_zoeken.php';
            if ($vraag == true) {
                echo '<div class="col-md-4">';
                echo haaltitelop($i, $resultaat);
                echo haalplaatjeop($i, $resultaat);
                echo 'Deze veiling is geblokkeerd';
                echo haalstartprijsop($i, $resultaat);
                echo haalhuidigeprijsop($i, $resultaat);
                echo '<p><a class="btn btn-secondary" href="detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';
            }
        } else {
            echo '<div class="col-md-4">';
            echo haaltitelop($i, $resultaat);
            echo haalplaatjeop($i, $resultaat);
            echo haaltimerop($i, $resultaat);
            echo haalstartprijsop($i, $resultaat);
            echo haalhuidigeprijsop($i, $resultaat);
            echo '<p><a class="btn btn-secondary" href="detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"] . '" role="button">Zie details &raquo;</a></p></div>';
        }
    }
}
