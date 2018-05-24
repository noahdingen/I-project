<?php
$titel = 'Registreren';
include 'header.php';

if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = 'Gebruikersnaam';
}

?>

<link href="assets/css/registreren.css" rel="stylesheet">
<main>
    <div class="container">
        <h1 class="display-3">Registreren</h1>
    <form class="col-form-label-lg" action="php/db_registratie.php" method="post">
        <div class="form-group">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" placeholder="<?php echo $error;?>" required autofocus>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord" required pattern=".{8,25}" title="Wachtwoord moet tussen de 8 en 25 karakters bevatten">
            </div>
            <div class="form-group col-md-6">
                <label for="wachtwoord">Herhaal Wachtwoord</label>
                <input type="password" class="form-control" name="bevestig_wachtwoord" id="wachtwoord_bevestigen" placeholder="Bevestig Wachtwoord" required>

            </div>
        </div>
        <div class="form-group">
            <label for="email">E-mailadres</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mailadres" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="voornaam">Voornaam</label>
                <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam" required>
            </div>
            <div class="form-group col-md-6">
                <label for="achternaam">Achternaam</label>
                <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam" required>
            </div>
        </div>
        <div class="form-group">
            <label for="geboortedatum">Geboortedatum</label>
            <input type="date" class="form-control" name="geboortedatum" id="geboortedatum" required>
        </div>
        <div class="form-group">
            <label for="adres">Adres</label>
            <input type="text" class="form-control" name="adres" id="adres" placeholder="Adres" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" maxlength="6" placeholder="Postcode" required>
            </div>

            <div class="form-group col-md-6">
                <label for="plaatsnaam">Plaatsnaam</label>
                <input type="text" class="form-control" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required>
            </div>
        </div>
        <div class="form-row">
            <label for="geheime_vraag">Geheime vraag</label>
            <select class="form-control form-control-lg" id="geheime_vraag" name="geheime vraag" required>
                <option value="">...</option>
                <option value="1">Waar ben je geboren?</option>
                <option value="2">Wat is je lievelingsdier?</option>
                <option value="3">Wie is jouw superheld?</option>
            </select>
        </div>
        <div class="form-group">
            <label for="antwoord">Geheim antwoord</label>
            <input type="text" class="form-control" name="antwoord" id="antwoord" placeholder="Antwoord" required>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="voorwaarden" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck">
                    Ik ga akkoord met de algemene voorwaarden
                </label>
            </div>
        </div>
        <input type="submit" name="aanmelden" class="btn btn-primary">
    </form>
    </div>
</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
