<?php

function haalplaatjeop($i){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->query("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    echo '<figure>
                    <img src="'. $resultaat[$i]['hoofdplaatje'].'" alt="veilingitem">
               </figure>';

}


function haaltitelop($i){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    if(strlen ($resultaat[$i]['titel']) >21) {
        $veiling = substr($resultaat[$i]['titel'], 0, 20);
        echo "<h3>" . $veiling . "...</h3>";
    }else{
        echo "<h3>" . $resultaat[$i]['titel']. "</h3>";
    }

}

function haalprijsop($i){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    echo "<p>€" . $resultaat[$i]['startprijs'] .",-</p>";

}

function haallooptijdop($i){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    echo "<p>De looptijd is " . $resultaat[$i]['looptijd'] ." dagen</p>";

}

function haalinformatieop(){
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = $conn->prepare("SELECT TOP 6 * FROM Voorwerp");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);

    for($i = 0; $i < 6; $i++){
        echo '<div class="col-md-4">';
        echo haaltitelop($i);
        echo  haalplaatjeop($i);
        echo haallooptijdop($i);
        echo haalprijsop($i);
        echo '<p><a class="btn btn-secondary" href="../detailpagina.php?voorwerpnummer=' . $resultaat[$i]["voorwerpnummer"]. '" role="button">Zie details &raquo;</a></p>
        </div>';
    }
}
