<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registreren</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/registreren.css" rel="stylesheet">
</head>

<body>
<?php include 'header.php' ?>
<main role="main">
    <div class="container">
        <h1 class="display-3">Registreren</h1>
    <form class="col-form-label-lg" action="iProject/DB_registratie.php" method="post">
        <div class="form-group">
            <label for="inputAddress">Gebruikersnaam</label>
            <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" placeholder="Gebruikersnaam" required autofocus>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Wachtwoord</label>
                <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Herhaal Wachtwoord</label>
                <input type="password" class="form-control" name="bevestig_wachtwoord" id="wachtwoord" placeholder="Bevestig Wachtwoord" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">E-mailadres</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-mailadres" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Voornaam</label>
                <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Achternaam</label>
                <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Geboortedatum</label>
            <input type="date" class="form-control" name="geboortedatum" id="geboortedatum" placeholder="Geboortedatum" required>
        </div>
        <div class="form-group">
            <label for="inputAddress">Adres</label>
            <input type="text" class="form-control" name="adres" id="adres" placeholder="Adres" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" required>
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Plaatsnaam</label>
                <input type="text" class="form-control" name="plaatsnaam" id="plaatsnaam" required>
            </div>
        </div>
        <div class="form-row">
            <label for="geheime vraag">Geheime vraag</label>
            <select class="form-control form-control-lg" name="geheime vraag" required>
                <option value="1">Waar ben je geboren?</option>
                <option value="2">Wat is je lievelingsdier?</option>
                <option value="3">Wie is jouw superheld?</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputAddress">Geheim antwoord</label>
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
