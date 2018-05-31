<?php
include_once '../databaseverbinding/database_connectie.php';

$gebruiker = $_POST['gebruikersnaam'];
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$geblokkeerd = $_POST['geblokkeerd'];
$email = $_POST['emailadres'];
if($geblokkeerd == 'nee'){
    $data = $pdo->prepare("UPDATE Gebruiker SET geblokkeerd = 'ja' WHERE gebruikersnaam = '$gebruiker'");
    $data->execute();
    //mailtje sturen dat gebruiker is geblokkeerd
    $subject = 'u bent helaas geblokkeerd';
    $emailtekst = 'Dit is een mail om u te informeren dat u bent geblokkeerd op de site:
            http://iproject39.icasites.nl
            
            U kunt niet meer inloggen, totdat uw account weer wordt gedeblokkeerd.
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
    $to = $email;
    $from = 'iconcepts39@gmail.com';

    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=iso-8859-1";
    $headers[] = "From: IConcepts <{$from}>";
    $headers[] = "X-Mailer: PHP/".phpversion();

    mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f".$from );
}
if($geblokkeerd == 'ja'){
    $data = $pdo->prepare("UPDATE Gebruiker SET geblokkeerd = 'nee' WHERE gebruikersnaam = '$gebruiker'");
    $data->execute();
    //mailtje sturen dat gebruiker is gedeblokkeerd
    $subject = 'u bent gedeblokkeerd';
    $emailtekst = 'Dit is een mail om u te informeren dat u bent gedeblokkeerd op de site:
            http://iproject39.icasites.nl
            
            U kunt weer inloggen.
            Uw gegevens blijven onveranderd.
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
    $to = $email;
    $from = 'iconcepts39@gmail.com';

    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=iso-8859-1";
    $headers[] = "From: IConcepts <{$from}>";
    $headers[] = "X-Mailer: PHP/".phpversion();

    mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f".$from );
}

header("location: ../gebruiker_zoeken.php");