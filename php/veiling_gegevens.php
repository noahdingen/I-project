<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../databaseverbinding/database_connectie.php';

//Haalt meerdere afbeeldingen op voor de detail pagina.
function haalafbeeldingenop($voorwerpnummer){
    $slides = array('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth', 'eleventh', 'twelfth');
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
    <div class="carousel-item ' . $afbeeling . ' "><div class="zoom">
        <img src="' . $value['filenaam'] . '" alt="' . $slides[$key] . ' slide" height="250" width="350">
    </div></div>
    ';
    }
}
//Haalt titel van het voorwerp op.
function haaltitelop($voorwerpnummer){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT titel FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['titel'];
}
//Haalt beschrijving van het voorwerp op.
function haalbeschrijvingop($voorwerpnummer){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT beschrijving FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['beschrijving'];
}
//Haalt alle verkoperinformatie van het voorwerp op.
function haalverkoperop($voorwerpnummer){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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

//Haalt het totaal aantal veiligen op van de verkoper, dit zegt iets over de betrouwbaarheid van de gebruiker.
function haalaantalveilingenop($verkoper){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT COUNT(verkoper) AS aantalverkocht FROM Voorwerp WHERE verkoper = ?");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $aantalverkocht = $titel[0]['aantalverkocht'];
    return $aantalverkocht;
}
//Haalt de datum waarop de verkoper zijn eerste veilig heeft geplaatst op.
function haaldatumeersteveilingop($verkoper){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT TOP 1 looptijdbeginDag FROM Voorwerp WHERE verkoper = ? ORDER BY looptijdbeginDag ASC");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    //zet datum goed naar dd-mm-jjjj
    $datum_oud = $titel[0]['looptijdbeginDag'];
    $looptijdbegindag = date("d-m-Y", strtotime($datum_oud));
    return $looptijdbegindag;
}
//
function haalvoorwerpdetailsop($voorwerpnummer, $rubrieken){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT startprijs, betalingswijze, betalingsinstructie, verzendkosten, verzendinstructies  FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<div class="col">
              <div class="col text-center">
             <b> Bieden vanaf:</b>
             &euro;'.$titel[0]['startprijs'] . '
              </div>
               <div class="col text-center">
             <b> Rubriekenpad:</b>
             '; echo haalrubrieknummerop($voorwerpnummer,$rubrieken). '
              </div>
              <div class="col text-center">
             <b> Betalingswijze:</b>
              '.$titel[0]['betalingswijze'] . '
              </div>';
    if($titel[0]['betalingsinstructie'] != ''){ echo'
                <div class="col text-center">
             <b> Betalingsinstructie:</b>
                '.$titel[0]['betalingsinstructie'] . '
                </div>';}
    if($titel[0]['verzendkosten'] != ''){ echo'
            <div class="col text-center">
              <b>Verzendkosten:</b>
            '.$titel[0]['verzendkosten'] . '
            </div>';
    }
    if($titel[0]['verzendinstructies'] != ''){ echo'
              <div class="col text-center">
              <b>Verzendinstructies:</b>
               '.$titel[0]['verzendinstructies'] . '
              </div>';}
    echo '</div>';
}
//Haalt de geboden bedragen op
function haalbiedingenop($voorwerpnummer){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT top 10 bodbedrag, gebruikersnaam, bodDag, bodTijdstip FROM Bod WHERE voorwerpnummer = ? ORDER BY bodbedrag DESC");
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
function haalrubriekenpadop($rubrieknummer,$rubrieken){
    for($i=0; $i<count($rubrieken); $i++){
        if($rubrieken[$i]["rubrieknummer"] == $rubrieknummer && $rubrieknummer!=-1){
            echo '<a class="rubriekenlink" href=../index.php?rubrieknummer=' . $rubrieken[$i]["rubrieknummer"] . '>' . $rubrieken[$i]["rubrieknaam"] .'</a> / '  . haalrubriekenpadop($rubrieken[$i]["rubriek"], $rubrieken) . '';
        }
    }
    }


function haalrubrieknummerop($voorwerpnummer,$rubrieken){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT rubrieknummerOpLaagsteNiveau FROM VoorwerpInRubriek WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $rubrieknummerOpLaagsteNiveau = $sql->fetchAll(PDO::FETCH_NAMED);
    haalrubriekenpadop($rubrieknummerOpLaagsteNiveau[0]["rubrieknummerOpLaagsteNiveau"],$rubrieken);
}


//
function timer(){
	$timer_info = haaltijdop($_GET['voorwerpnummer']);
	}
	
	function haaltijdop($voorwerp){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql = $conn->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp WHERE voorwerpnummer = ?");
	$sql->execute(array($_GET['voorwerpnummer']));
	$info = $sql->fetchAll(PDO::FETCH_ASSOC);
	$eindtijd = $info[0]['looptijdeindeDag']." ".$info[0]['looptijdeindeTijdstip'].' GMT+0200';
	echo "<script> setDeadline('".$eindtijd."'); initializeClock('clockdiv', deadline);</script>";
}
//Haalt op of een voorwerp geblokkeerd is o niet.
function haalblokadeop($voorwerpnummer){
    global $conn;
    $conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = $conn->prepare("SELECT geblokkeerd FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $blokkeer = $sql->fetchAll(PDO::FETCH_NAMED);
    return $blokkeer;
}

?>
