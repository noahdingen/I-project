<?php include 'header.php' ?>

<html>
<head>
    <title>Dit is mijn eerste homepage</title>

    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/profielpagina.css" rel="stylesheet">

</head>
<body>

<div class="kolommen">

<div class="persoons-gegevens">
<p>Gebruikersnaam: </p>
<p>E-mail adres: </p>
<p>Voornaam: </p>
<p>Achternaam: </p>
<p>Geboortedatum: </p>
<p>Woonplaats: </p>
<p>Straatnaam: </p>
<p>Postcode: </p>
<p>Type account: </p>
    <p>
    <a href="verkoper.php">Upgraden naar verkoper</a>
    </p>
    <a href="verkoper.php">Gegevens bijwerken</a>
</div>

    <div class="persoonlijke-veilingen">
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
            </div>

        </div>
    </div>

</div>

<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>