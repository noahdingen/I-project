<?php
include_once 'header.php';
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['gebruikers']) || $gebruiker != $_SESSION['gebruikers']){
		header("location: ./index.php");
}
include_once 'databaseverbinding/database_connectie.php';
//$_GET['wissel'] =false;
$titel = 'Profielpagina';
include_once 'php/gegevens_ophalen.php';
include_once 'php/beheerder_zoeken.php';
include_once 'php/veilingenbekijken.php';
if($_GET["bewerken"] == 'false'){
    $inhoudstype = 'readonly';
    $datum = 'text';
} else{
    $inhoudstype = '';
    $datum = 'date';
}
if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
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
    <input name="emailadres" class="form-control" type="text" placeholder=" ' . $emailadres . '" ' . $inhoudstype .'>';
if(($_GET["bewerken"]=='true')){
    echo '  <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Meer info
                </button>
                <div class="dropdown-menu dropdown-menu">
                <p class="dropdown-item" >In het geval dat het emailadress wordt gewijzigd.
                       <br>Dient u het account opnieuw te activeren.
                       <br>Ook wordt u direct uitgelogd te berscherming van uw account.
                       <br>De andere ingevulde gegevens worden nog wel aangepast.</p>
            </div>
    </div><br>';
}
echo'
    
    <label>Voornaam</label>
    <input name="voornaam" class="form-control" type="text" placeholder=" ' . $voornaam . '" ' . $inhoudstype .'>
    <label>Achternaam</label>
    <input name="achternaam" class="form-control" type="text" placeholder=" ' . $achternaam . '" ' . $inhoudstype .'>
    <label>Geboortedatum</label>
    <input name="datum" class="form-control" type="'.$datum.'" placeholder=" ' . $datum_nieuw . '" ' . $inhoudstype .'>
    <label>Woonplaats</label>
    <input name="plaatsnaam" class="form-control" type="text" placeholder=" ' . $plaatsnaam . '" ' . $inhoudstype .'>
    <label>Straatnaam</label>
    <input name="adresregel1" class="form-control" type="text" placeholder=" ' . $adres . '" ' . $inhoudstype .'>
    <label>Postcode</label>
    <input name="postcode" class="form-control" type="text" maxlength="6" placeholder=" ' . $postcode .'" ' . $inhoudstype .'>';
    if($verkoper == 'ja  '){
    echo '
            <label>Bank</label>
            <input name="bank" class="form-control" type="text" placeholder=" ' . $banknaam . '" ' . $inhoudstype .' readonly>
            <label>Rekeningnummer</label>
            <input name="rekeningnummer" class="form-control" type="text" placeholder=" ' . $rekingnummer .' "' . $inhoudstype .' readonly>
            <label>Controle optie</label>
            <input name="controle" class="form-control" type="text" placeholder=" ' . $controle_optie .' "' . $inhoudstype .' readonly>
            <label>Creditcard</label>
            <input name="creditcard" class="form-control" type="text" placeholder=" ' . $creditcardnummer .' "' . $inhoudstype .' readonly>
            
    ';
    }

if(($_GET["bewerken"]=='true')){
    echo '<h4>'.$error.'</h4>
    <div class="linkjes">
        <a href="php/gegevens_bijwerken.php"><button type="submit" name="oude_gebruikersnaam" class="btn btn-primary">Bijwerken</button></a>
    </div>';

}
else {
	if($verkoper == 'ja' || $beheerder == 'ja'){
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

        if($verkoper == 'ja') {
            echo '<div class="linkjes">
            <a href="profielpagina.php?bewerken=false">Bekijk mijn lopende veilingen</a>
            </div>';
        }
            haalgebodenveilingenop($gebruikersnaam);

        echo '
            </div></div>
            ';
    } elseif($verkoper == 'ja') {
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