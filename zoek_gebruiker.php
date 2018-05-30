<?php
include_once 'databaseverbinding/database_connectie.php';
gebruikers_ophalen();
    function gebruikers_ophalen()
    {

        $conn = verbindMetDatabase();
        if(isset($_POST['gebruikersnaam_zoeken'])) {
            $resultaat = $_POST['gebruikersnaam_zoeken'];
        }
        else{
            $resultaat ='helemaal nul';
        }

        $conn = verbindMetDatabase();
        $data = $conn->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam LIKE'%" . $resultaat . "%'");
        $data->execute();
        $rijen = $data->fetchAll(PDO::FETCH_NAMED);
        $aantal = count($rijen);
        if (!empty($rijen)) {
            for ($i = 0; $i < $aantal; $i++) {
                echo $rijen[$i]['gebruikersnaam'];
                echo '<br>';
            }
            header("location:gebruiker_zoeken.php?gebruikers=$resultaat");
        } else {

            header("location: gebruiker_zoeken.php?error=Geen gebruikers gevonden");
        }
    }

header("location:gebruiker_zoeken.php?gebruikers=$resultaat");