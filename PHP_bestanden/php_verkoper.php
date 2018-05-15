<?php

if (!isset($_SESSION['gebruikers'])) {

    echo "<H1 class=\"text-center\">U bent niet ingelogd, <br> U wordt zo doorgestuurd!</H1></form>";
    header("Refresh: 2; URL=login.php");
}
else if(isset($_SESSION['gebruikers'])){

    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Gebruiker = $_SESSION['gebruikers'];

    $data = $conn->prepare("SELECT verkoper FROM Gebruiker WHERE gebruikersnaam = '$Gebruiker'AND verkoper = 'wel'");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){

    }

    $test = 'wel';
    if($i == 1){
        echo 'U bent al verkoper!';
        header("Refresh: 2; URL=profielpagina.php");
    }
    else {

    }}
        ?>
