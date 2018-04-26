<?php 
session_start();
// maak verbinding met database
require_once 'database_connectie.php';

$title = 'registreren';
$paginatitel = 'registreren';
$gebruiker=$fout="";
$pagina= './login.php';
$pdo = verbindMetDatabase();
//$paginaFout = './DB_registratie.php';

// is er op de knop aanmelden geklikt?
if (isset($_POST['aanmelden'])){
    // zijn de velden gebruiker en wachtwoord ingevuld?
    if(!empty($_POST['gebruikersnaam']) && !empty($_POST['Wachtwoord'])){
		if($_POST['Wachtwoord'] == $_POST['Bevestig_Wachtwoord']){
			// de ingevoerde gegevens opslaan in variabelen
			$gebruiker = $_POST['gebruikersnaam'];
			$wachtwoord =$_POST['Wachtwoord'];
		    $wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
			$email = $_POST['email'];
			$voornaam = $_POST['Voornaam'];
			$achternaam = $_POST['Achternaam'];
			$geboortedatum = $_POST['Geboortedatum']; 
			$adres = $_POST['adres'];
			$postcode = $_POST['postcode'];
			$plaatsnaam = $_POST['plaatsnaam'];
			$geheime_vraag = geheimeVraag();
			$antwoord = $_POST['antwoord'];
			$adresregel2 = $adres;
			$landnaam = 'nederland';
			$verkoper = 'nee';
		   // voer query uit in de database voor tabel gebruikers
		   $sql = "INSERT INTO Gebruiker(gebruikersnaam, wachtwoord, voornaam, 
										achternaam, adresregel1, adresregel2, postcode, plaatsnaam, landnaam, datum, emailadres
										,vraagnummer, antwoordtekst, verkoper) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$opdracht = $pdo->prepare($sql);
			$opdracht->execute(array($gebruiker, $wachtwoord, $voornaam, $achternaam, $adres, $adresregel2, $postcode,
									 $plaatsnaam, $landnaam, $geboortedatum, $email, $geheime_vraag, $antwoord, $verkoper));
			
			header("refresh:0; url='./login.php'");
		} else{
			$error = "*Wachtwoorden komen niet overeen";
			header("refresh:0; url='./Registreren.php?error=$error'");
			}
	} else {
			header("refresh:0; url='./Registreren.php'");
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