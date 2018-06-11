<?php 
session_start();
// maak verbinding met database op localhost
require_once '../databaseverbinding/database_connectie.php';
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';

$gebruiker="";
$pagina= './login.php';
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
//Regel hieronder is voor server!
//$pdo = $conn;

// is er op de knop aanmelden geklikt?
if (isset($_POST['aanmelden'])){
    // zijn de velden gebruiker en wachtwoord ingevuld?
    if(!empty($_POST['gebruikersnaam']) && !empty($_POST['wachtwoord'])){
        $ingevuldegebruikersnaam = $_POST['gebruikersnaam'];
        $check = $pdo->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ? ");
        $check->execute($ingevuldegebruikersnaam);
        $gebruikersnaam = $check->fetchColumn();
        if($ingevuldegebruikersnaam != $gebruikersnaam) {
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
			$geblokkeerd = 'nee';
			$beheerder = 'nee';
			$activatie = 0;

            $data = $conn->prepare("SELECT verkoper FROM Gebruiker WHERE gebruikersnaam = ? ");
            $data->execute(array($gebruiker));
            $resultaat = $data->fetchAll(PDO::FETCH_NAMED);

            if(count($resultaat)>0){
                $error = "Gebruiksnaam bestaat al";
                header("refresh:0; url='../registreren.php?error=$error'");
            }

// versturen van verificatie mail
            $code = genereerRandomString();
            $subject = 'Bedankt voor uw registratie op IConcept';
            $emailtekst =

                '
Dit is een verificatie mail om uw account te activeren op onze website: 
Dit is uw activatiecode: '.$code.'
Deze dient ingevoerd te worden op:
http://iproject39.icasites.nl/check_account.php
            
Met vriendelijke groeten, 
IConcepts

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
                                                    ,vraagnummer, antwoordtekst, verkoper,activatie,mailcode, geblokkeerd, beheerder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?,?,?)";
            $opdracht = $pdo->prepare($sql);
            $opdracht->execute(array($gebruiker, $wachtwoord, $voornaam, $achternaam, $adres, $adresregel2, $postcode,
                                                 $plaatsnaam, $landnaam, $geboortedatum, $email, $geheime_vraag, $antwoord, $verkoper, $activatie,$code, $geblokkeerd, $beheerder));
            header("refresh:0; url='../check_account.php'");
		}
        }
        else{
            $error = 'Deze gebruikersnaam is al ingebruik!';
            header("refresh:0; url: ../registreren.php?error=$error");
        }
    }
	else{
			$error = "Wachtwoorden komen niet overeen";
			header("refresh:0; url='../registreren.php?error=$error'");
        }
}
else{
			header("refresh:0; url='../registreren.php'");
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

function genereerRandomString($length = 15) {
    $karakters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $karakterLength = strlen($karakters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $karakters[rand(0, $karakterLength - 1)];
    }
    return $randomString;
}
	
	
	
?>