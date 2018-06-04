<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'databaseverbinding/database_connectie.php';

//Haalt meerdere afbeeldingen op voor de detail pagina.
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
//Haalt titel van het voorwerp op.
function haaltitelop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT titel FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['titel'];
}
//Haalt beschrijving van het voorwerp op.
function haalbeschrijvingop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT beschrijving FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['beschrijving'];
}
//Haalt verkoper van het voorwerp op.
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
             <b>Totaal aantal veilingen:</b>
              '.haalaantalveilingenop($verkoper).'
              </div>
              <div class="col text-center">
              <b>Eerste veiling toegevoegd op:</b>
              '.haaldatumeersteveilingop($verkoper).'
              </div>
       </div>';
}
//Haalt aantal veiligen van de verkoper op.
function haalaantalveilingenop($verkoper){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT COUNT(verkoper) AS aantalverkocht FROM Voorwerp WHERE verkoper = ?");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $aantalverkocht = $titel[0]['aantalverkocht'];
    return $aantalverkocht;
}
//Haalt de datum waarop de verkoper zijn eerste veilig heeft geplaatst op.
function haaldatumeersteveilingop($verkoper){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT TOP 1 looptijdbeginDag FROM Voorwerp WHERE verkoper = ? ORDER BY looptijdbeginDag ASC");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    //zet datum goed naar dd-mm-jjjj
    $datum_oud = $titel[0]['looptijdbeginDag'];
    $looptijdbegindag = date("d-m-Y", strtotime($datum_oud));
    return $looptijdbegindag;
}
//
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
             <b> Rubriekenpad:</b>
             '.haalrubriekenpadop($voorwerpnummer). '
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
//Haalt de geboden bedragen op
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
//Haalt het rubriekenpad van het voorwerp op.
function haalrubriekenpadop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT rubriekenpad, voorwerpnummer FROM Allerubrieken INNER JOIN VoorwerpInRubriek ON rubrieknummer = rubrieknummerOpLaagsteNiveau WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel= $sql->fetchAll(PDO::FETCH_NAMED);
    $rubriekenpad = $titel[0]['rubriekenpad'];
        return $rubriekenpad;

    }


//
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
//Haalt op of een voorwerp geblokkeerd is o niet.
function haalblokadeop($voorwerpnummer){
    $conn = verbindMetDatabase();
    $sql = $conn->prepare("SELECT geblokkeerd FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $blokkeer = $sql->fetchAll(PDO::FETCH_NAMED);
    return $blokkeer;
}

?>
