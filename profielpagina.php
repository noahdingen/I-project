<?php
if (!isset($_SESSION)) {
    session_start();
}
$titel = 'Profielpagina';


include_once 'Database_verbinding/database_connectie.php';
include_once 'header.php';
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
if(isset($_GET["inhoudstype"])){
    $inhoudstype = '';
} else {
    $inhoudstype = 'readonly';
}

echo '
    <link href="assets/css/profielpagina.css" rel="stylesheet">
<body>
<form class="gegevenswijzigen" method="post" action="gegevens_bijwerken.php">
<div class="kolommen">
    <div class="persoons-gegevens">
    <label>Gebruikersnaam</label>
    <input class="form-control" type="text" placeholder=" ' . $gebruikersnaam . '" ' . $inhoudstype . '>
    <label>E-mail</label>
    <input class="form-control" type="text" placeholder=" ' . $emailadres . '" ' . $inhoudstype .'>
    <label>Voornaam</label>
    <input class="form-control" type="text" placeholder=" ' . $voornaam . '" ' . $inhoudstype .'>
    <label>Achternaam</label>
    <input class="form-control" type="text" placeholder=" ' . $achternaam . '" ' . $inhoudstype .'>
    <label>Geboortedatum</label>
    <input class="form-control" type="text" placeholder=" ' . $datum . '" ' . $inhoudstype .'>
    <label>Woonplaats</label>
    <input class="form-control" type="text" placeholder=" ' . $plaatsnaam . '" ' . $inhoudstype .'>
    <label>Straatnaam</label>
    <input class="form-control" type="text" placeholder=" ' . $gebruikersnaam . '" ' . $inhoudstype .'>
    <label>Postcode</label>
    <input class="form-control" type="text" placeholder=" ' . $postcode .'" ' . $inhoudstype .'>
    <label>Verkoper</label>
    <input class="form-control" type="text" placeholder=" ' . $verkoper .'" ' . $inhoudstype .'>';

if(isset($_GET["inhoudstype"])){
    echo '
    <a href="gegevens_bijwerken.php"><button type="submit" class="btn btn-primary">Bijwerken</button></a>';
} else {
   echo '
        <p>
        <a href="verkoper.php">Upgraden naar verkoper</a>
        </p>
        <a href="gegevens_bijwerken.php">Gegevens bijwerken</a>';
}
?>
    </div>
</form>
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