<?php


$gebruiker= '';
$pagina= '../index.php';
$paginaFout = '../login.php';
$error = '';

if (isset($_POST['aanmelden'])){
    include_once '../Database_verbinding/database_connectie.php';
    if(!empty($_POST['gebruikersnaam']) && !empty($_POST['wachtwoord'])){
        $gebruiker = $_POST['gebruikersnaam'];
        $wachtwoord =$_POST['wachtwoord'];

        $sql = "SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ? AND wachtwoord = ?";
        $opdracht = $dbh->prepare($sql);
        $opdracht->execute(array($gebruiker, $wachtwoord));

        if (isset( $opdracht->fetch()['gebruikersnaam'])){
            session_start();
            $_SESSION['gebruikersnaam']=$gebruiker;
            header("refresh:0; url=$pagina.?Gebruiker=$gebruiker");
        }
        else {
            $error = "Wachtwoord en/of gebruikersnaam is verkeerd";
            header("refresh: 3; Location: ../login.php");
            echo $error;
        }
    }
}

if (isset($_SESSION['errors'])) {
    header("Location: ../login.php");
}

?>





