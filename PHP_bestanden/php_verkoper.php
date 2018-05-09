<?php

if (!isset($_SESSION['gebruikers'])) {

    echo "<H1 class=\"text-center\">U bent niet ingelogd, <br> U wordt zo doorgestuurd!</H1></form>";
    header("Refresh: 2; URL=login.php");
}
else if(isset($_SESSION['gebruikers'])){

    $conn = verbindMetDatabase();
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
