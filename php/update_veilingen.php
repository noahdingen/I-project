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
	if(!empty($info[0]['bodbedrag'])){
	echo 'Voorwerp: '.$info[0]['titel'].'<br> De winnaar is: '.$info[0]['gebruikersnaam'].'<br> Het te betalen bedrag: €'
		 .$info[0]['bodbedrag'].'<br> Verkoper: '.$info[0]['verkoper'].'<br><br>';
		 $i = $i + 1;
	} else{
		echo 'Voorwerp: '.$veilingen[$i]['titel'].'<br> Verkoper: '.$veilingen[$i]['verkoper'].'<br> Er is geen bod gedaan op dit product <br><br>';
		$i = $i + 1;
	}	
}
?>