<?php
function weergeefrubriekenboom(){
    echo '
    <div id="accordion">
            ' . haalhoofdrubriekenop() . '
    </div>
    ';
}

function haalsubrubriekenop($i, $resultaat){
    $subrubrieken = '';
    for($j=0; $j<count($resultaat); $j++){
        if($resultaat[$j]["rubriek"]==$i)
        $subrubrieken = $subrubrieken . '<div class="container"><button type="submit" name="rubrieknummer" value="' . $resultaat[$j]["rubrieknummer"] . '" class="btn btn-primary">' . $resultaat[$j]["rubrieknaam"] . '</button> ' . haalsubrubriekenop($resultaat[$j]["rubrieknummer"], $resultaat) . '</div>';
    }
    return $subrubrieken;
}

function haalhoofdrubriekenop(){
    $resultaat = haalallerubriekenop();
    for($i=0; $i<count($resultaat); $i++){
        if($resultaat[$i]["rubriek"]==-1){
            echo '
            <div class="card">
                <div class="card-header" id="heading' . $i . '">
                    <h5 class="mb-0">
                    <button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapse' . $i . '">
                            ' . $resultaat[$i]["rubrieknaam"] . '
                    </button>
                    </h5>
                </div>
                <form method="get" action="">
                <div id="collapse' . $i . '" class="collapse" aria-labelledby="heading' . $i . '" data-parent="#accordion">
                    ' . haalsubrubriekenop($resultaat[$i]["rubrieknummer"], $resultaat) . '
               </div>
               </form>
               </div>';
        }
    }
}

function haalallerubriekenop(){
    $conn = verbindMetDatabase();
    $data = $conn->prepare("SELECT * FROM Rubriek order by rubrieknaam asc");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    return $resultaat;
}

