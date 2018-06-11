<?php
include '../server_verbinding/mail.php';
include '../server_verbinding/SQLSrvConnect.php';

if (isset($_POST['wachtwoordvergeten'])) {
    if (!empty($_POST['gebruikersnaam']) && !empty($_POST['geheime_vraag']) && !empty($_POST['antwoord'])) {
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $andwoordtekst = $_POST['antwoord'];
        $vraagnummer = $_POST['geheime_vraag'];
        $email = $_POST['email'];
        global $conn;
        $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $checkstate = $conn->prepare("select gebruikersnaam from Gebruiker WHERE gebruikersnaam = ? AND antwoordtekst = ? AND emailadres = ? AND vraagnummer = ?");
        $checkstate->execute(array($gebruikersnaam, $andwoordtekst, $email, $vraagnummer));
        $uitslag = $checkstate->fetchAll(PDO::FETCH_NAMED);
        for ($i = 0; $i < count($uitslag); $i++) {

        }
        if ($i == 1) {
            $token = genereerRandomString();
            $sql = "INSERT INTO WachtwoordVeranderen (geheimetekens, gebruikersnaam, tijd) VALUES (?, ?, ?)";

            $opdracht = $conn->prepare($sql);
            $opdracht->execute(array($token, $gebruikersnaam, $_SERVER["REQUEST_TIME"]));


            $url = "http://iproject39.icasites.nl/wachtwoord_wijzigen.php?token=$token";

            $subject = 'Wachtwoord vergeten?';
            $emailtekst = '
            Op het account: ' . $gebruikersnaam . ' heeft u aangevraagd om uw wachtwoord te wijzigen.
            Hierbij is de de link om uw wachtwoord te wijzigen. LET OP! 
            De link is maar 1x bruikbaar!:
            ' . $url . '
            
            Met vriendelijke groeten,
            IConcepts
            
            Deze mail is automatisch gegenereed.
            
            Heeft u het wijzigen van het wachtwoord niet aangevraagd dan kan het wezen dat uw account gegevens bekend zijn bij derderen.
            Neem in dit geval contact met ons op!';
            $to = $email;
            $from = 'iconcepts39@gmail.com';

            $headers = array();
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/plain; charset=iso-8859-1";
            $headers[] = "From: IConcepts <{$from}>";
            $headers[] = "X-Mailer: PHP/" . phpversion();

            mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f" . $from);
            $error = "U heeft een mail toegestuurd gekregen.";
            header("refresh:0; url='../login.php?error=$error'");
        }
        else{
            $error = "Ingevulde gegevens kloppen niet!";
            header("refresh:0; url='../wachtwoord_vergeten.php?error=$error'");
        }
    }
    else{
        $error = "Niet alle gegevens ingevuld";
        header("refresh:0; url='../wachtwoorden_vergeten.php?error=$error'");
    }
}
?>