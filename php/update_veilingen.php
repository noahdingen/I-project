<?php
include_once '../databaseverbinding/database_connectie.php';
$conn = verbindMetDatabase();

$sql = "update voorwerp set veilingGesloten = 'ja' 
		where veilingGesloten = 'nee' and looptijdeindeDag = convert(date, getdate()) and
		looptijdeindeTijdstip <= convert(time,getdate())";

$data = $conn->prepare($sql);
$data->execute();


$sql = "SELECT voorwerpnummer, titel, verkoper FROM voorwerp WHERE veilingGesloten = 'ja'";
$data = $conn->prepare($sql);
$data->execute();
$veilingen = $data->fetchAll(PDO::FETCH_ASSOC);
$i = 0;
foreach($veilingen AS $info_veiling){
	$voorwerp = $info_veiling['voorwerpnummer'];
	$sql_bericht = "SELECT b.bodbedrag, b.gebruikersnaam, v.verkoper, v.titel
					FROM Bod b 
					INNER JOIN voorwerp v ON b.voorwerpnummer = v.voorwerpnummer
					WHERE b.voorwerpnummer = ? and b.bodbedrag = (SELECT max(bodbedrag) from bod where voorwerpnummer = ?)";

	$data = $conn->prepare($sql_bericht);
	$data->execute(array($voorwerp, $voorwerp));
	$info = $data->fetchAll(PDO::FETCH_ASSOC);
	
	
	 $subject = 'Bedankt voor uw registratie op IConcept';
            $emailtekst = if(!empty($info[0]['bodbedrag'])){
						'Voorwerp: '.$info[0]['titel'].'
						De winnaar is: '.$info[0]['gebruikersnaam'].'Het te betalen bedrag: €'
						   	 .$info[0]['bodbedrag'].'<br> Verkoper: '.$info[0]['verkoper'].'
							 ';
							 $i = $i + 1;
							} else{
								'Voorwerp: '.$veilingen[$i]['titel'].'Verkoper: '.$veilingen[$i]['verkoper'].'Er is geen bod gedaan op dit product
								
								';
								$i = $i + 1;
							}	
}
echo '<pre>';
var_dump($emailtekst);
echo '</pre>';
         //  ' Met vriendelijke groeten, IConcepts.
          //  Deze mail is automatisch gegenereed.';
			//$email = 'reno.rovers@gmail.com';
          //  $to = $email;
          //  $from = 'iconcepts39@gmail.com';
//
           // $headers   = array();
          // $headers[] = "MIME-Version: 1.0";
          //  $headers[] = "Content-type: text/plain; charset=iso-8859-1";
          //  $headers[] = "From: IConcepts <{$from}>";
         //   $headers[] = "X-Mailer: PHP/".phpversion();

           // mail($to, $subject, $emailtekst, implode("\r\n", $headers), "-f".$from );
?>


