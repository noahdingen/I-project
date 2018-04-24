<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/signin.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
<?php include 'header.php' ?>
<div class="registreren">
<form class="form-signin">

    <h1 class="h3 mb-3 font-weight-normal">Gebruiker wel of niet Aanmaken</h1>
    <form role="form">

        <div class="form-group">
            <input type="text" name="gebruikersnaam" id="gebruikersnaam" class="form-control input-sm" placeholder="gebruikersnaam">
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="password" name="Wachtwoord" id="Wachtwoord" class="form-control input-sm" placeholder="Wachtwoord">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="password" name="Bevestig_Wachtwoord" id="Bevestig_Wachtwoord" class="form-control input-sm" placeholder="Bevestig Wachtwoord">
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
        </div>


        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="Voornaam" id="Voornaam" class="form-control input-sm" placeholder="Voornaam">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="Achternaam" id="Achternaam" class="form-control input-sm" placeholder="Achternaam">
                </div>
            </div>
        </div>


        <div class="form-group">
            <input type="date" name="Geboortedatum" id="Geboortedatum" class="form-control input-sm" placeholder="Geboortedatum">
        </div>

        <div class="form-group">
            <input type="text" name="adres" id="adres" class="form-control input-sm" placeholder="Adres">
        </div>



        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="postcode" id="postcode" class="form-control input-sm" placeholder="Postcode">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <input type="text" name="plaatsnaam" id="plaatsnaam" class="form-control input-sm" placeholder="Plaatsnaam">
                </div>
            </div>
        </div>

        <div class="form-group">
            <select>
                <option value="volvo">Geheime vraag</option>
                <option value="saab">Waar ben je geboren?</option>
                <option value="mercedes">Wat is je lievelingsdier?</option>
                <option value="audi">Wie is jou superheld?</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="antwoord" id="antwoord" class="form-control input-sm" placeholder="Antwoord">
        </div>
        <input type="checkbox" name="vehicle" value="Car">Ik ga akkoord met de algemene voorwaarden

        <input type="submit" value="Registreren" class="btn btn-info btn-block">

        <p class="mt-5 mb-3 text-muted">&copy; EenmaalAndermaal 2018</p>
    </form>
</div>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
