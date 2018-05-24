<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../databaseverbinding/database_connectie.php';
function haaldetailsop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $voorwerp = $conn->prepare("select titel, beschrijving, looptijd, verkoper from Voorwerp where voorwerpnummer = ?");
    $voorwerp->execute(array($voorwerpnummer));
    $resultaat_voorwerp = $voorwerp->fetchAll(PDO::FETCH_NAMED);
    $titel = $resultaat_voorwerp[0]['titel'];
    $beschrijving = $resultaat_voorwerp[0]['beschrijving'];
    $looptijd = $resultaat_voorwerp[0]['looptijd'];
    $verkoper = $resultaat_voorwerp[0]['verkoper'];

    $bestand = $conn->prepare("select filenaam from Bestand where voorwerpnummer = ?");
    $bestand->execute(array($voorwerpnummer));
    $resultaat_bestand = $bestand->fetchAll(PDO::FETCH_NAMED);
    $afbeelding = $resultaat_bestand[0]['filenaam'];

    $bod = $conn->prepare("select bodbedrag, gebruikersnaam, bodTijdstip from Bod where voorwerpnummer = ?");
    $bod->execute(array($voorwerpnummer));
    $bodbedrag = $resultaat_bod[0]['bodbedrag'];
    $koper = $resultaat_bod[0]['gebruikersnaam'];
    $bod_tijdstip = $resultaat_bod[0]['bodTijdstip'];

    $voorwerp_informatie = array('titel' => $titel, 'beschrijving' => $beschrijving, 'looptijd' => $looptijd, 'afbeelding' => $afbeelding,
        'bodbedrag' => $bodbedrag, 'koper' => $koper, 'bodtijdstip' => $bod_tijdstip, 'verkoper' => $verkoper);


    if($resultaten = $bod -> fetch()){
        do{
            echo '<div class="col text-center">'.
                $voorwerp_informatie['koper'].'
                        </div>
                        <div class="col text-center">
                            &euro;'. $voorwerp_informatie['bodbedrag'].'
                        </div>
                        <div class="col text-center">
                             '.$voorwerp_informatie['bodtijdstip'].'
                        </div>';
        } while($resultaten = $bod -> fetch());
    }
    else{
        echo"<p>Nog niks geboden </p>";
    }

    return $voorwerp_informatie;
}

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
    <div class="carousel-item ' . $afbeeling . '">
        <img src="' . $value['filenaam'] . '" alt="' . $slides[$key] . ' slide" height=500px width="500px">
    </div>
    ';
    }
}

function haaltitelop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT titel FROM Voorwerp WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $titel = $sql->fetchAll(PDO::FETCH_NAMED);
    echo $titel[0]['titel'];
}

function haalbiedingenop($voorwerpnummer){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("SELECT bodbedrag, gebruikersnaam, bodDag, bodTijdstip FROM Bod WHERE voorwerpnummer = ?");
    $sql->execute(array($voorwerpnummer));
    $bodgegevens = $sql->fetchAll(PDO::FETCH_NAMED);
    echo '<h1>
            ' . $bodgegevens[0]['bodDag'] . ' 
       </h1>';
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
?>
