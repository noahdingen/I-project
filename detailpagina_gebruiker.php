<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'databaseverbinding/database_connectie.php';
include_once 'php/beheerder_zoeken.php';
if($beheerder) {
    $titel = 'Profielpagina';
    include_once 'header.php';
    include_once 'php/gegevens_ophalen.php';
    $inhoudstype = 'readonly';

    if ($_SESSION['gebruikers'] == $_GET['gebruikersnaam']) {
       echo ' <link href="assets/css/detailpagina_gebruiker.css" rel="stylesheet">';
        echo '<H1>U kunt niet uzelf blokkeren of via deze manier uw gegevens zien.</H1>';
        echo '<p>Wilt U toch uw gegevens zien, klik dan op <a href="profielpagina.php?bewerken=false">profielpagina</a>.';
        echo '        <footer class="container">
            <p>&copy; EenmaalAndermaal 2018</p>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script>window.jQuery || document.write(\'<script src="assets/js/jquery-slim.min.js"><\/script>\')</script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        </body>
        </html>';
    } else {
        ?>
        <?php
        echo '
    <link href="assets/css/detailpagina_gebruiker.css" rel="stylesheet">
    <div class="text-center">
        <H1>Dit zijn de gegevens van ' . $_GET['gebruikersnaam'] . '</H1>';
        if ($geblokkeerd == 'nee') {
            echo '
        <p>Als u de gebruiker wilt blokkeren, kan dit met de blokkeer knop onderin deze pagina.</p>
        ';
        } else {
            echo '
        <p>Als u de gebruiker wilt deblokkeren, kan dit met de deblokkeer knop onderin deze pagina.</p>
        ';
        }
        echo '
        <p>Er wordt dan een e-mail verzonden naar ' . $_GET['gebruikersnaam'] . ' om hem/haar te informeren.</p>
    </div>
<form class="gegevenswijzigen" method="post" action="php/gebruiker_blokkeren.php">

<div class="kolommen">
    <div class="persoons-gegevens">
    <label>Gebruikersnaam</label>
    <input name="gebruikersnaam" class="form-control" type="text" value="' . $gebruikersnaam . '" ' . $inhoudstype . '>
    <label>E-mail</label>
    <input name="emailadres" class="form-control" type="text" value="' . $emailadres . '" ' . $inhoudstype . '>
    <label>Voornaam</label>
    <input name="voornaam" class="form-control" type="text" value="' . $voornaam . '" ' . $inhoudstype . '>
    <label>Achternaam</label>
    <input name="achternaam" class="form-control" type="text" value="' . $achternaam . '" ' . $inhoudstype . '>
    <label>Geboortedatum</label>
    <input name="datum" class="form-control" type="text" value="' . $datum_nieuw . '" ' . $inhoudstype . '>
    <label>Woonplaats</label>
    <input name="plaatsnaam" class="form-control" type="text" value="' . $plaatsnaam . '" ' . $inhoudstype . '>
    <label>Straatnaam</label>
    <input name="adresregel1" class="form-control" type="text" value="' . $adres . '" ' . $inhoudstype . '>
    <label>Postcode</label>
    <input name="postcode" class="form-control" type="text" value="' . $postcode . '" ' . $inhoudstype . '>
    <label>Verkoper</label>
    <input name="verkoper" class="form-control" type="text" value="' . $verkoper . '" ' . $inhoudstype . '>';

        if ($verkoper == 'ja  ') {
            echo '
            <label>Bank</label>
            <input name="bank" class="form-control" type="text" value="' . $banknaam . '" ' . $inhoudstype . '>
            <label>Rekeningnummer</label>
            <input name="rekeningnummer" class="form-control" type="text" value="' . $rekingnummer . '" ' . $inhoudstype . '>
            <label>Controle optie</label>
            <input name="controle" class="form-control" type="text" value="' . $controle_optie . '" ' . $inhoudstype . '>
            <label>Creditcard</label>
            <input name="creditcard" class="form-control" type="text" value="' . $creditcardnummer . '" ' . $inhoudstype . '>
            
    ';
        }
        echo '<input name="geblokkeerd" class="form-control" type="hidden" value="' . $geblokkeerd . '">';

        if ($geblokkeerd == 'nee') {
            echo '
    <button type="submit" class="btn btn-primary">Blokkeren</button>
    ';
        } else {
            echo '
    <button type="submit" class="btn btn-primary">Deblokkeren</button>
    ';
        }
        ?>

        </div>
        </div>

        </form>

        <footer class="container">
            <p>&copy; EenmaalAndermaal 2018</p>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }
}
else{
        echo 'U bent hier niet voor geautoriseerd';
        echo '<p>Door deze <a href="index.php">link</a> gaat u terug naar de homepagina ';
    }

?>
