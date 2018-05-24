<?php
include_once 'databaseverbinding/database_connectie.php';
//include 'php_bestanden/sessie_bezoeker.php';
$titel = 'Homepagina';
include 'header.php';
// regel hieronder uit commentariëren voor server
//include_once 'Database_verbinding/database_connectie.php';
include_once 'php/veilingenbekijken.php';
//include_once 'Server_verbinding/SQLSrvConnect.php';
?>
<link href="assets/css/index.css" rel="stylesheet">
<main>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Geachte <?php echo $bezoeker[0]. $bezoeker[1];?></h1>
            <p>Wij van iConcepts willen U producten aanbieden waar U zelf kunt bepalen wat de prijs is.</p>

        </div>
    </div>
    <div class="container">

        <h1 class="display-4">Nieuwste veilingen</h1>
        <div class="row">
            <?php
            haalinformatieop();
            ?>


        </div>

    </div>

</main>

<footer class="container text-center">
    <p>&copy; EenmaalAndermaal 2018</p>
</footer>