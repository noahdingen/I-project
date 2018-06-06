<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'databaseverbinding/database_connectie.php';
//$_GET['wissel'] =false;
$titel = 'Profielpagina';
include_once 'header.php';
include_once 'php/gegevens_ophalen.php';
include_once 'php/beheerder_zoeken.php';
include_once 'php/veilingenbekijken.php';
if($_GET["bewerken"] == 'false'){
    $inhoudstype = 'readonly';
} else{
    $inhoudstype = '';
}

echo '
    <script type="application/javascript" src="./assets/js/timerJava.js"></script>
    <link href="assets/css/profielpagina.css" rel="stylesheet">

<form class="gegevenswijzigen" method="post" action="php/gegevens_bijwerken.php?gebruikersnaam=' . $gebruikersnaam .  ' ">

<div class="kolommen">
    <div class="persoons-gegevens">
    <label>Gebruikersnaam</label>
    <input name="gebruikersnaam" class="form-control" type="text" placeholder=" ' . $gebruikersnaam . '" ' . $inhoudstype . '>
    <label>E-mail</label>
    <input name="emailadres" class="form-control" type="text" placeholder=" ' . $emailadres . '" ' . $inhoudstype .'>
    <label>Voornaam</label>
    <input name="voornaam" class="form-control" type="text" placeholder=" ' . $voornaam . '" ' . $inhoudstype .'>
    <label>Achternaam</label>
    <input name="achternaam" class="form-control" type="text" placeholder=" ' . $achternaam . '" ' . $inhoudstype .'>
    <label>Geboortedatum</label>
    <input name="datum" class="form-control" type="text" placeholder=" ' . $datum_nieuw . '" ' . $inhoudstype .'>
    <label>Woonplaats</label>
    <input name="plaatsnaam" class="form-control" type="text" placeholder=" ' . $plaatsnaam . '" ' . $inhoudstype .'>
    <label>Straatnaam</label>
    <input name="adresregel1" class="form-control" type="text" placeholder=" ' . $adres . '" ' . $inhoudstype .'>
    <label>Postcode</label>
    <input name="postcode" class="form-control" type="text" placeholder=" ' . $postcode .'" ' . $inhoudstype .'>
    <label>Verkoper</label>
    <input name="verkoper" class="form-control" type="text" placeholder=" ' . $verkoper .'" ' . $inhoudstype .'>';
    if($verkoper == 'ja  '){
    echo '
            <label>Bank</label>
            <input name="bank" class="form-control" type="text" placeholder=" ' . $banknaam . '" ' . $inhoudstype .'>
            <label>Rekeningnummer</label>
            <input name="rekeningnummer" class="form-control" type="text" placeholder=" ' . $rekingnummer .' "' . $inhoudstype .'>
            <label>Controle optie</label>
            <input name="controle" class="form-control" type="text" placeholder=" ' . $controle_optie .' "' . $inhoudstype .'>
            <label>Creditcard</label>
            <input name="creditcard" class="form-control" type="text" placeholder=" ' . $creditcardnummer .' "' . $inhoudstype .'>
            
    ';
    }

if(($_GET["bewerken"]=='true')){
    echo '
    <div class="linkjes">
        <a href="php/gegevens_bijwerken.php"><button type="submit" name="oude_gebruikersnaam" class="btn btn-primary">Bijwerken</button></a>
    </div>';

}
else {
	if($verkoper == 'ja  ' || $beheerder == 'ja'){
		echo '
    <div class="linkjes">
        <a href="profielpagina.php?bewerken=true">Gegevens bijwerken</a>
    </div>';
	}else{
		echo '
        <div class="linkjes">
            <p>
            <a href="verkoper.php">Upgraden naar verkoper</a>
            </p>
            <a href="profielpagina.php?bewerken=true">Gegevens bijwerken</a>
        </div>'; }

}
?>
</div>
    <div class="persoonlijke-veilingen">
<?php

    if (isset($_GET['wissel']) && $_GET['wissel'] == true) {
        echo '
            <h1>Mijn geboden veilingen</h1> 
            ';

        if($verkoper == 'ja  ') {
            echo '<div class="linkjes">
            <a href="profielpagina.php?bewerken=false">Bekijk mijn geboden veilingen</a>
            </div>';
        }
            haalgebodenveilingenop($gebruikersnaam);
        
        echo '
            </div></div>
            ';
    } elseif($verkoper == 'ja  ') {
        echo '
            <h1>Mijn lopende veilingen</h1> 
            <div class="linkjes">
            <a href="profielpagina.php?wissel=false&bewerken=false">Bekijk mijn geboden veilingen</a>
            </div>
            ';
        haalmijnveilingenop($gebruikersnaam);
    }
?>
        </div>
    </div>
</div>
</form>

<footer class="container">
    <p>&copy; EenmaalAndermaal 2018</p>
</footer>

<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>