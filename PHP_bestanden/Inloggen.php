<?php
include_once '../Database_verbinding/database_connectie.php';

$gebruiker= '';
$pagina= '../index.php';
$paginaFout = '../inloggen.php';

if (isset($_POST['aanmelden'])){

    if(!empty($_POST['Gebruikersnaam']) && !empty($_POST['wachtwoord'])){

        $gebruiker = $_POST['Gebruikersnaam'];
        $wachtwoord =$_POST['wachtwoord'];

        $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = '$gebruiker' AND wachtwoord = '$wachtwoord'";
        $opdracht = $dbh->prepare($sql);
        $opdracht->execute(array($gebruiker, $wachtwoord));

        if (isset( $opdracht->fetch()['inlognaam'])){
            session_start();
            $_SESSION['gebruiker']=$gebruiker;
//            $sqlInsert = "INSERT INTO ingelogde(Naam)
//		  				  VALUES (?)";
            $naam = $gebruiker;
            $opdracht = $dbh->prepare($sql);
            $opdracht->execute (array($gebruiker));
            header("refresh:0; url=$pagina.?Gebruiker=$gebruiker");
        }
        else {
            $fout = "<p>* Gebruikersnaam of wachtwoord klopt niet</p>";
            echo $fout;
        }
    }
}

?>





