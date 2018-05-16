<?php
if (!isset($_SESSION)) {
    session_start();
}
$titel = 'Profielpagina';


include_once 'Database_verbinding/database_connectie.php';
include_once 'header.php';
$pdo = verbindMetDatabase();

$sql = "select gebruikersnaam, emailadres, voornaam, achternaam, datum, plaatsnaam, adresregel1, postcode, verkoper from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql_2 = "select banknaam, rekeningnummer, controleoptienaam, creditcardnummer from Verkoper where gebruikersnaam =?";
$query_2 = $pdo->prepare($sql_2);
$query_2->execute([$_SESSION['gebruikers']]);

$rows_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);

$gebruikersnaam = $rows[0]['gebruikersnaam'];
$emailadres = $rows[0]['emailadres'];
$voornaam = $rows[0]['voornaam'];
$achternaam = $rows[0]['achternaam'];
$datum = $rows[0]['datum'];
$plaatsnaam = $rows[0]['plaatsnaam'];
$adres = $rows[0]['adresregel1'];
$postcode = $rows[0]['postcode'];
$verkoper = $rows[0]['verkoper'];
if($verkoper == 'ja  ') {
    $banknaam = $rows_2[0]['banknaam'];
    $rekingnummer = $rows_2[0]['rekeningnummer'];
    $controle_optie = $rows_2[0]['controleoptienaam'];
    $creditcardnummer = $rows_2[0]['creditcardnummer'];
}

if($_GET["bewerken"] == 'false'){
    $inhoudstype = 'readonly';
}
else{
    $inhoudstype = '';
}


echo '
    <link href="assets/css/profielpagina.css" rel="stylesheet">
<body>
<form class="gegevenswijzigen" method="get" action="PHP_bestanden/gegevens_bijwerken.php">
<div class="kolommen">
    <div class="persoons-gegevens">
    <label>Gebruikersnaam</label>
    <input name="Gebruikersnaam" class="form-control" type="text" placeholder=" ' . $gebruikersnaam . '" ' . $inhoudstype . '>
    <label>E-mail</label>
    <input name="E-mail" class="form-control" type="text" placeholder=" ' . $emailadres . '" ' . $inhoudstype .'>
    <label>Voornaam</label>
    <input name="Voornaam" class="form-control" type="text" placeholder=" ' . $voornaam . '" ' . $inhoudstype .'>
    <label>Achternaam</label>
    <input name="Achternaam" class="form-control" type="text" placeholder=" ' . $achternaam . '" ' . $inhoudstype .'>
    <label>Geboortedatum</label>
    <input name="Geboortedatum" class="form-control" type="text" placeholder=" ' . $datum . '" ' . $inhoudstype .'>
    <label>Woonplaats</label>
    <input name="Woonplaats" class="form-control" type="text" placeholder=" ' . $plaatsnaam . '" ' . $inhoudstype .'>
    <label>Straatnaam</label>
    <input name="Straatnaam" class="form-control" type="text" placeholder=" ' . $adres . '" ' . $inhoudstype .'>
    <label>Postcode</label>
    <input name="Postcode" class="form-control" type="text" placeholder=" ' . $postcode .'" ' . $inhoudstype .'>
    <label>Verkoper</label>
    <input name="Verkoper" class="form-control" type="text" placeholder=" ' . $verkoper .'" ' . $inhoudstype .'>';
    if($verkoper == 'ja  '){
    echo '
            <label>Bank</label>
            <input name="Bank" class="form-control" type="text" placeholder=" ' . $banknaam . '" ' . $inhoudstype .'>
            <label>Rekeningnummer</label>
            <input name="Rekeningnummer" class="form-control" type="text" placeholder=" ' . $rekingnummer .' "' . $inhoudstype .'>
            <label>Controle optie</label>
            <input name="Controle" class="form-control" type="text" placeholder=" ' . $controle_optie .' "' . $inhoudstype .'>
            <label>Creditcard</label>
            <input name="Creditcard" class="form-control" type="text" placeholder=" ' . $creditcardnummer .' "' . $inhoudstype .'>';
    }

if(($_GET["bewerken"]=='true')){
    echo '
    <a href="PHP_bestanden/gegevens_bijwerken.php"><button type="submit" class="btn btn-primary">Bijwerken</button></a>';
}
else {
	if($verkoper == 'ja  '){
		echo '<a href="profielpagina.php?bewerken=true">Gegevens bijwerken</a>';
	} else{ 
		echo '
		<p>
		<a href="verkoper.php">Upgraden naar verkoper</a>
		</p>
		<a href="profielpagina.php?bewerken=true">Gegevens bijwerken</a>'; }
		
}

?>
    </div>
</form>
    <div class="persoonlijke-veilingen">
<?php
if($verkoper == 'ja  '){
    echo '
        <h1>Mijn lopende veilingen</h1>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <img src="assets/images/hammer.png" >
                    <p>Hier staat de beschrijving van bovenstaande veiling</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <img src="assets/images/hammer.png" >
                    <p>Hier staat de beschrijving van bovenstaande veiling</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <img src="assets/images/hammer.png" >
                    <p>Hier staat de beschrijving van bovenstaande veiling</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
                </div>
            </div>';
        }
        else{
        echo'
            <h1>Mijn geboden veilingen</h1>
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <img src="assets/images/hammer.png" >
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <img src="assets/images/hammer.png" >
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <img src="assets/images/hammer.png" >
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
        </div>';
        }
        ?>
        </div>
    </div>
</div>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>