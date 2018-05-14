<?php 
session_start();
// maak verbinding met database
require_once '../Database_verbinding/database_connectie.php';
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$title = 'registreren';
$paginatitel = 'registreren';
$gebruiker=$fout="";
$pagina= './login.php';
$pdo = verbindMetDatabase();
//Regel hieronder is voor server!
//$pdo = $conn;
$paginaFout = './DB_registratie.php';

// is er op de knop aanmelden geklikt?
if (isset($_POST['aanmelden'])){

    // zijn de velden gebruiker en wachtwoord ingevuld?
    if(!empty($_POST['gebruikersnaam']) && !empty($_POST['wachtwoord'])){
		if($_POST['wachtwoord'] == $_POST['bevestig_wachtwoord']){
			// de ingevoerde gegevens opslaan in variabelen
			$gebruiker = $_POST['gebruikersnaam'];
			$wachtwoord =$_POST['wachtwoord'];
		    $wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
			$email = $_POST['email'];
			$voornaam = $_POST['voornaam'];
			$achternaam = $_POST['achternaam'];
			$geboortedatum = $_POST['geboortedatum'];
			$adres = $_POST['adres'];
			$postcode = $_POST['postcode'];
			$plaatsnaam = $_POST['plaatsnaam'];
			$geheime_vraag = geheimeVraag();
			$antwoord = $_POST['antwoord'];
			$adresregel2 = $adres;
			$landnaam = 'nederland';
			$verkoper = 'nee';


            $conn = verbindMetDatabase();

    $data = $conn->prepare("SELECT verkoper FROM Gebruiker WHERE gebruikersnaam = '$gebruiker' ");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    for($i = 0; $i < count($resultaat); $i++){

    }
    if($i == 1) {
        $error = "Gebruiksnaam bestaat al";
        header("refresh:0; url='../registreren.php?error=$error'");
    }

//    if(strlen($wachtwoord)<8){
//        $error = "Wachtwoord moet minimaal 8 tekens bevatten";
//        header("refresh:0; url='../registreren.php?error=$error'");
//    }


$subject = 'Bedankt voor uw registratie op IConcept';
$emailtekst = 'Dit is een verificatie mail om uw account te activeren op onze website:
http://iproject39.icasites.nl/login.php
            
Met vriendelijke groeten, IConcepts.
Deze mail is automatisch gegenereed.';
$to = $email;
$from = 'iconcepts39@gmail.com';

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: IConcepts <{$from}>";
$headers[] = "X-Mailer: PHP/".phpversion();

mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f".$from );



$sql = "INSERT INTO Gebruiker(gebruikersnaam, wachtwoord, voornaam, 
										achternaam, adresregel1, adresregel2, postcode, plaatsnaam, landnaam, datum, emailadres
										,vraagnummer, antwoordtekst, verkoper) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$opdracht = $pdo->prepare($sql);
			$opdracht->execute(array($gebruiker, $wachtwoord, $voornaam, $achternaam, $adres, $adresregel2, $postcode,
									 $plaatsnaam, $landnaam, $geboortedatum, $email, $geheime_vraag, $antwoord, $verkoper));
			
			header("refresh:0; url='../login.php'");
		} else{
			$error = "Wachtwoorden komen niet overeen";
			header("refresh:0; url='../registreren.php?error=$error'");
			}
	} else {
			header("refresh:0; url='../registreren.php'");
        }
    }
	
	
	
	
function geheimeVraag(){
	$geheimeVraag = $_POST['geheime_vraag'];
	
	if($geheimeVraag == 'Waar ben je geboren?'){
		return 1;
	} else if($geheimeVraag == 'Wat is je lievelingsdier?'){
		return 2;
	} else {
		return 3;
	}
}
	
	
	
	
	
?>