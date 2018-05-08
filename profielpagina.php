<?php
if (!isset($_SESSION)) {
    session_start();
}
$titel = 'Profielpagina';
include_once 'header.php';
include_once 'Database_verbinding/database_connectie.php';

$pdo = verbindMetDatabase();

$sql = "select gebruikersnaam, emailadres, voornaam, achternaam, datum, plaatsnaam, postcode, verkoper from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$gebruikersnaam = $rows[0]['gebruikersnaam'];
$emailadres = $rows[0]['emailadres'];
$voornaam = $rows[0]['voornaam'];
$achternaam = $rows[0]['achternaam'];
$datum = $rows[0]['datum'];
$plaatsnaam = $rows[0]['plaatsnaam'];
$postcode = $rows[0]['postcode'];
$verkoper = $rows[0]['verkoper'];
echo '
    <link href="assets/css/profielpagina.css" rel="stylesheet">
<body>
<div class="kolommen">
    <div class="persoons-gegevens">
        <p>Gebruikersnaam:' . $gebruikersnaam . '</p>
        <p>E-mail adres: ' . $emailadres . '</p>
        <p>Voornaam: ' . $voornaam . '</p>
        <p>Achternaam: ' . $achternaam . '</p>
        <p>Geboortedatum: ' . $datum . '</p>
        <p>Woonplaats: ' . $plaatsnaam . '</p>
        <p>Straatnaam: ' . $gebruikersnaam . '</p>
        <p>Postcode: ' . $postcode . '</p>';
        if($verkoper = 'nee'){
            echo '<p>Type account: Koper</p>';
        }else{
            echo '<p>Type account: Verkoper</p>';
        }
            ?>
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