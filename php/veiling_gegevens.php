<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'databaseverbinding/database_connectie.php';

function haalafbeeldingenop($voorwerpnummer){
    $slides = array('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth', 'eleventh', 'twelfth');
    $conn = verbindMetDatabase();
    $bestand = $conn->prepare("select filenaam from Bestand where voorwerpnummer = ?");
    $bestand->execute(array($voorwerpnummer));
    $resultaat_bestand = $bestand->fetchAll(PDO::FETCH_NAMED);
    foreach ($resultaat_bestand as $key => $value) {
    if($key==0){
        $afbeeling = 'active';
    }
        else{
            $afbeeling = '';
        }
    echo '
    <div class="carousel-item ' . $afbeeling . '">
        <img src="' . $value['filenaam'] . '" alt="' . $slides[$key] . ' slide" height=500px width="500px">
    </div>
    ';
    }
}

function haaltitelop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT titel FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['titel'];
}

function haalbeschrijvingop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT beschrijving FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['beschrijving'];
}

function haalverkoperop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT verkoper, land FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $verkoper = $titel[0]['verkoper'];
    echo '<div class="col">
              <div class="col text-center">
              <b>Verkoper:</b>
              ' .$verkoper . '
              </div>
              <div class="col text-center">
             <b>Land:</b>
              '.$titel[0]['land'] . '
              </div>
              <div class="col text-center">
             <b>Aantal veilingen:</b>
              '.haalaantalveilingenop($verkoper).'
              </div>
              <div class="col text-center">
              <b>Datum voor het eerst actief:</b>
              '.haaldatumeersteveilingop($verkoper).'
              </div>
       </div>';
}

function haalaantalveilingenop($verkoper){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT COUNT(verkoper) AS aantalverkocht FROM Voorwerp WHERE verkoper = ?");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $aantalverkocht = $titel[0]['aantalverkocht'];
    return $aantalverkocht;
}

function haaldatumeersteveilingop($verkoper){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT TOP 1 looptijdbeginDag FROM Voorwerp WHERE verkoper = ? ORDER BY looptijdbeginDag ASC");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $looptijdbegindag = $titel[0]['looptijdbeginDag'];
    return $looptijdbegindag;
}

function haalvoorwerpdetailsop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT startprijs, betalingswijze, betalingsinstructie, verzendkosten, verzendinstructies  FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<div class="col">
              <div class="col text-center">
             <b> Bieden vanaf:</b>
             '.$titel[0]['startprijs'] . '
              </div>
              <div class="col text-center">
             <b> Betalingswijze:</b>
              '.$titel[0]['betalingswijze'] . '
              </div>
              <div class="col text-center">
             <b>Betalingsinstructie (optioneel):</b>
              '.$titel[0]['betalingsinstructie'] . '
              </div>
              <div class="col text-center">
              <b>Verzendkosten (optioneel):</b>
               '.$titel[0]['verzendkosten'] . '
              </div>
              <div class="col text-center">
              <b>Verzendinstructies (optioneel):</b>
               '.$titel[0]['verzendinstructies'] . '
              </div>
       </div>';
}

function haalbiedingenop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT bodbedrag, gebruikersnaam, bodDag, bodTijdstip FROM Bod WHERE voorwerpnummer = ? ORDER BY bodbedrag DESC");
    $sql->execute(array($voorwerpnummer));
    $bodgegevens = $sql->fetchAll(PDO::FETCH_NAMED);
    foreach ($bodgegevens as $value){
        echo '
       <div class="row">
              <div class="col text-center">
              ' . $value['gebruikersnaam'] . '
              </div>
              <div class="col text-center">
              &euro;'.$value['bodbedrag'] . '
              </div>
              <div class="col text-center">
              ' . $value['bodTijdstip'] . '
              </div>
       </div>
        ';
    }
}

function timer(){
	$timer_info = haaltijdop($_GET['voorwerpnummer']);
	}
	
	function haaltijdop($voorwerp){
	$conn = verbindMetDatabase();
	$sql = $conn->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp WHERE voorwerpnummer = ?");
	$sql->execute(array($_GET['voorwerpnummer']));
	$info = $sql->fetchAll(PDO::FETCH_ASSOC);
	$eindtijd = $info[0]['looptijdeindeDag']." ".$info[0]['looptijdeindeTijdstip'].' GMT+0200';
	echo "<script> setDeadline('".$eindtijd."'); initializeClock('clockdiv', deadline);</script>";
}
?>
