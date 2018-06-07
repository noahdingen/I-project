<?php
include_once '../databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}
$pdo = verbindMetDatabase();
$voorwerpnummer = $_GET['voorwerpnummer'];

//status veilingen ophalen uit database
$blokkeer = $pdo->prepare("select geblokkeerd, titel, veilingGesloten from Voorwerp where voorwerpnummer =?");
$blokkeer->execute(array($voorwerpnummer));
$rijen = $blokkeer->fetchAll(PDO::FETCH_ASSOC);

//email verkoper ophalen van de veiling
$email_verkoper_2 = $pdo->prepare("select Voorwerp.voorwerpnummer, Voorwerp.verkoper, Gebruiker.gebruikersnaam, Gebruiker.emailadres from Voorwerp inner join Gebruiker on Gebruiker.gebruikersnaam = Voorwerp.verkoper where voorwerpnummer =?");
$email_verkoper_2->execute(array($voorwerpnummer));
$email_verkoper = $email_verkoper_2->fetchAll(PDO::FETCH_ASSOC);

//email bieder ophalen van de veiling
$email_bieder_2 = $pdo->prepare("select top 1 Bod.voorwerpnummer, Bod.gebruikersnaam, Gebruiker.emailadres from Bod inner join Gebruiker on Bod.gebruikersnaam = Gebruiker.gebruikersnaam where voorwerpnummer = ? order by bodbedrag desc");
$email_bieder_2->execute(array($voorwerpnummer));
$email_bieder = $email_bieder_2->fetchAll(PDO::FETCH_ASSOC);

//als de veiling is gesloten gaat hij terug naar de detailpagina met een foutmelding
if($rijen[0]['veilingGesloten'] == 'ja'){
    header("location: ../detailpagina.php?voorwerpnummer=".$voorwerpnummer."&error=Deze veiling is gesloten, U kunt hem niet blokkeren&status=verlopen");
}else {
    if ($rijen[0]['geblokkeerd'] == 'nee') {
        $data = $pdo->prepare("UPDATE Voorwerp SET geblokkeerd = 'ja' WHERE geblokkeerd = 'nee' AND voorwerpnummer = '$voorwerpnummer'");
        $data->execute();
        $count = $data->rowCount();

        //mailtje sturen dat veiling is geblokkeerd naar hoogste bieder
        $email_hoogstebieder = $email_bieder[0]['emailadres'];
        $subject = 'Er is een veiling geblokkeerd';
        $emailtekst = 'Dit is een mail om u te informeren dat er een veiling is geblokkeerd op de site:
            http://iproject39.icasites.nl
            
            Het gaat hier om de veiling: ' . $rijen[0]['titel'] . '
            U was de hoogste bieder op het moment van de blokkade.
            Uw bod blijft nu staan.
            Mocht de veiling weer worden gedeblokkeerd, heeft u de hoogste bod, maar mogen andere mensen weer bieden.
            Als de veiling afloopt terwijl hij geblokkeerd is, heeft u de veiling gewonnen. 
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
        $to = $email_hoogstebieder;
        $from = 'iconcepts39@gmail.com';

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: IConcepts <{$from}>";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f" . $from);

        //mailtje sturen dat veiling is geblokkeerd naar hoogste bieder
        $email = $email_verkoper[0]['emailadres'];
        $onderwerp = 'Er is een veiling geblokkeerd';
        $tekst = 'Dit is een mail om u te informeren dat er een veiling is geblokkeerd op de site:
            http://iproject39.icasites.nl
            
            Een veiling is geblokkeerd en u was de aanbieder.
            Het gaat hier om de veiling: ' . $rijen[0]['titel'] . '
            Het hoogste bod blijft staan.
            Mocht de veiling weer worden gedeblokkeerd, kan er weer op worden geboden.
            Degene die op het moment van blokkade het hoogste bod had, heeft de veiling gewonnen mits de veiling afloopt terwijl deze is geblokkeerd.
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
        $naar = $email;
        $van = 'iconcepts39@gmail.com';

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: IConcepts <{$from}>";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        mail($naar, $onderwerp, $tekst, implode("\r\n", $headers), "-f" . $van);

        header("location: ../detailpagina.php?voorwerpnummer=" . $voorwerpnummer . "&error=Deze veiling is geblokkeerd");
    } elseif ($rijen[0]['geblokkeerd'] == 'ja') {
        $data = $pdo->prepare("UPDATE Voorwerp SET geblokkeerd = 'nee' WHERE geblokkeerd = 'ja' AND voorwerpnummer = '$voorwerpnummer'");
        $data->execute();
        $count = $data->rowCount();

        //mailtje sturen dat veiling is gedeblokkeerd naar hoogste bieder
        $email_hoogstebieder = $email_bieder[0]['emailadres'];
        $subject = 'Er is een veiling gedeblokkeerd';
        $emailtekst = 'Dit is een mail om u te informeren dat er een veiling is gedeblokkeerd op de site:
            http://iproject39.icasites.nl
            
            Het gaat hier om de veiling: ' . $rijen[0]['titel'] . '
            U was de hoogste bieder op het moment van de blokkade.
            Uw bod blijft staan.
            De veiling is nu weer gedeblokkeerd, dus kunt u overboden worden.
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
        $to = $email_hoogstebieder;
        $from = 'iconcepts39@gmail.com';

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: IConcepts <{$from}>";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f" . $from);

        //mailtje sturen dat veiling is geblokkeerd naar hoogste bieder
        $email = $email_verkoper[0]['emailadres'];
        $onderwerp = 'Er is een veiling gedeblokkeerd';
        $tekst = 'Dit is een mail om u te informeren dat er een veiling is gedeblokkeerd op de site:
            http://iproject39.icasites.nl
            
            Een veiling is gedeblokkeerd en u was de aanbieder.
            Het gaat hier om de veiling: ' . $rijen[0]['titel'] . '
            Er mag weer geboden worden op de veiling.
            Wilt u meer informatie, neem contact op met IConcepts.
            
            Met vriendelijke groeten, IConcepts.
            
            U kunt niet op deze mail reageren';
        $naar = $email;
        $van = 'iconcepts39@gmail.com';

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: IConcepts <{$from}>";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        mail($naar, $onderwerp, $tekst, implode("\r\n", $headers), "-f" . $van);

        header("location: ../detailpagina.php?voorwerpnummer=" . $voorwerpnummer . "");
    }
}
?>


