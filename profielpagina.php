<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'Database_verbinding/database_connectie.php';
$titel = 'Profielpagina';
include_once 'header.php';
include_once 'PHP_bestanden/gegevens_ophalen.php';
if($_GET["bewerken"] == 'false'){
    $inhoudstype = 'readonly';
}
else{
    $inhoudstype = '';
}


echo '
    <link href="assets/css/profielpagina.css" rel="stylesheet">
<form class="gegevenswijzigen" method="get" action="PHP_bestanden/test.php?;">
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
            <input name="Creditcard" class="form-control" type="text" placeholder=" ' . $creditcardnummer .' "' . $inhoudstype .'>
            
    ';
    }

if(($_GET["bewerken"]=='true')){
    echo '
    <a href="PHP_bestanden/test.php"><button type="submit" class="btn btn-primary">Bijwerken</button></a>';
}
else {
	if($verkoper == 'ja  '){
		echo '<a href="profielpagina.php?bewerken=true">Gegevens bijwerken</a>';
	} else{ 
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
                <img src="assets/images/hammer.png" alt="logo">
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <img src="assets/images/hammer.png" alt="logo">
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <img src="assets/images/hammer.png" alt="logo">
                <p>Hier staat de beschrijving van bovenstaande veiling</p>
                <p><a class="btn btn-secondary" href="#" role="button">Zie details &raquo;</a></p>
            </div>
        </div>';
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