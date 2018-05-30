<?php
function weergeefrubriekenboom(){
    echo '
    <div id="accordion">
            ' . haalhoofdrubriekenop() . '
    </div>
    ';
}

function haalsubrubriekenop($i){
    $subrubrieken = '';
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT * FROM Rubriek WHERE rubriek = ?");
    $data->execute(array($i));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($j=0; $j<count($resultaat); $j++){
        $subrubrieken = $subrubrieken . '<div class="container"><button class="btn btn-primary">' . $resultaat[$j]["rubrieknaam"] . '</button> ' . haalsubrubriekenop($resultaat[$j]["rubrieknummer"]) . '</div>';
    }
    return $subrubrieken;
}

function haalhoofdrubriekenop(){
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT * FROM Rubriek WHERE rubriek = -1");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i=0; $i<count($resultaat); $i++){
        echo '
            <div class="card">
                <div class="card-header" id="heading' . $i . '">
                    <h5 class="mb-0">
                    <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapse' . $i . '">
                            ' . $resultaat[$i]["rubrieknaam"] . '
                    </button>
                    </h5>
                </div>
                <div id="collapse' . $i . '" class="collapse" aria-labelledby="heading' . $i . '" data-parent="#accordion">
                    ' . haalsubrubriekenop($resultaat[$i]["rubrieknummer"]) . '
               </div>
               </div>';
    }

}

