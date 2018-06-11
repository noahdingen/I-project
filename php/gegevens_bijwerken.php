<?php
include_once '../databaseverbinding/database_connectie.php';
//include_once 'db_registratie.php';
if (!isset($_SESSION)) {
    session_start();
}
$mailing = false;
echo $mailing;
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$oude_gebruikersnaam = $_GET['gebruikersnaam'];
$nieuwe_gebruikersnaam = $_POST['gebruikersnaam'];
$email = $_POST['emailadres'];
$geboortedatum = $_POST['geboortedatum'];
foreach ($_POST as $key => $value){
    if($value != '') {
        // Past gebruikersnaam aan als deze word ngevuld
        "UPDATE Gebruiker SET $key = '$value' WHERE gebruikersnaam = '$oude_gebruikersnaam'";
        if($key==='gebruikersnaam' && $nieuwe_gebruikersnaam!==''){
            $check = $pdo->prepare("SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = ? ");
            $check->execute(array($value));
            $gebruikersnaam = $check->fetchColumn();
            if($value != $gebruikersnaam) {
                $data = $pdo->prepare("UPDATE Gebruiker SET $key = ? WHERE gebruikersnaam = '$oude_gebruikersnaam'");
                $_SESSION['gebruikers'] = $nieuwe_gebruikersnaam;
                $data->execute(array($value));
            }
            else{
                $error = 'Deze gebruikersnaam is al ingebruik!';
                header("location: ../profielpagina.php?bewerken=true&error=$error");
            }
        }
        if($key=='emailadres' && $email != ''){
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = ? WHERE gebruikersnaam = '$oude_gebruikersnaam'");
            $data->execute($value);
            $data = $pdo->prepare("UPDATE Gebruiker SET activatie = 0 WHERE gebruikersnaam = '$oude_gebruikersnaam'");
            function genereerRandomString($length = 15) {
                $karakters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $karakterLength = strlen($karakters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $karakters[rand(0, $karakterLength - 1)];
                }
                return $randomString;
            }
            $code = genereerRandomString();
            $subject = 'Email veranderd op IConcept';
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
            $mailing = true;
            $codechange = $pdo->prepare("UPDATE Gebruiker SET mailcode = '$code' WHERE gebruikersnaam = '$oude_gebruikersnaam'");
        }
        // Geen nieuwe gebruikersnaam opgegeven
        else if($nieuwe_gebruikersnaam===''){
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = ? WHERE gebruikersnaam = '$oude_gebruikersnaam'");
        }
        //Als er meerdere gegevens worden ingevuld
        else{
            $data = $pdo->prepare("UPDATE Gebruiker SET $key = ? WHERE gebruikersnaam = '$nieuwe_gebruikersnaam'");
        }
        $data->execute(array($value));
    }
}

if($mailing == true){
    $codechange->execute();
    session_unset();
    header("location: ../index.php");
}
elseif ($error != ''){
    header("refresh 0; location: ../profielpagina.php?bewerken=true&error=$error");
}
else {
    header("location: ../profielpagina.php?bewerken=false");
}