<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../databaseverbinding/database_connectie.php';
//Haalt meerdere afbeeldingen op voor de detail pagina.
function haalafbeeldingenop($voorwerpnummer){
    $slides = array('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth', 'eleventh', 'twelfth');
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT titel FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['titel'];
}
//Haalt beschrijving van het voorwerp op.
function haalbeschrijvingop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT beschrijving FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<h4>Beschrijving:</h4>'.$titel[0]['beschrijving'].'';
}
//Haalt verkoper van het voorwerp op.
function haalverkoperop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT COUNT(verkoper) AS aantalverkocht FROM Voorwerp WHERE verkoper = ?");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    $aantalverkocht = $titel[0]['aantalverkocht'];
    return $aantalverkocht;
}
//Haalt de datum waarop de verkoper zijn eerste veilig heeft geplaatst op.
function haaldatumeersteveilingop($verkoper){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT TOP 1 looptijdbeginDag FROM Voorwerp WHERE verkoper = ? ORDER BY looptijdbeginDag ASC");
    $sql->execute(array($verkoper));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    //zet datum goed naar dd-mm-jjjj
    $datum_oud = $titel[0]['looptijdbeginDag'];
    $looptijdbegindag = date("d-m-Y", strtotime($datum_oud));
    return $looptijdbegindag;
}
function haalvoorwerpdetailsop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

function haalverzendingop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT betalingsinstructie, verzendinstructies FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<div class="col">
              <div class="col text-center">';
    if($titel[0]['betalingsinstructie'] != ''){
        echo"<h4>Betaling instructie:</h4>
         " . $titel[0]['betalingsinstructie'] ." ";
    }
    echo '</div>';
    if($titel[0]['verzendinstructies'] != ''){
       echo'  <div class="col text-center">
              <h4>Verzendinstucties:</h4>
              '.$titel[0]['verzendinstructies'] . '
              </div>';

       }
        echo '</div>';
}
//Haalt de geboden bedragen op
function haalbiedingenop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

function startprijs($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT startprijs FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<div class="col">
              <div class="col text-center">
              <h4>Startprijs:</h4>
              €' . $titel[0]['startprijs'] . ',-
              </div>
         </div>';
}

function timer(){
    $timer_info = haaltijdop($_GET['voorwerpnummer']);
}

function haaltijdop($voorwerp){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($_GET['voorwerpnummer']));
    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
    $eindtijd = $info[0]['looptijdeindeDag']." ".$info[0]['looptijdeindeTijdstip'].' GMT+0200';
    echo "<script> setDeadline('".$eindtijd."'); initializeClock('clockdiv', deadline);</script>";
}

//Haalt op of een voorwerp geblokkeerd is of niet.
function haalblokadeop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT geblokkeerd FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $blokkeer = $sql->fetchAll(PDO::FETCH_NAMED);
    return $blokkeer;
}
//Haalt het rubriekenpad van het voorwerp op.
function haalrubriekenpadop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT rubriekenpad, voorwerpnummer FROM Allerubrieken INNER JOIN VoorwerpInRubriek ON rubrieknummer = rubrieknummerOpLaagsteNiveau WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel= $sql->fetchAll(PDO::FETCH_NAMED);
    $rubriekenpad = $titel[0]['rubriekenpad'];
    return $rubriekenpad;

}


?>
