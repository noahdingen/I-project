<?php
include_once 'databaseverbinding/database_connectie.php';
//include 'php/sessie_bezoeker.php';
$titel = 'Homepagina';
include 'header.php';
// regel hieronder uit commentariëren voor server
//include_once 'Database_verbinding/database_connectie.php';
include_once 'php/veilingenbekijken.php';
//include_once 'Server_verbinding/SQLSrvConnect.php';
?>
<link href="assets/css/index.css" rel="stylesheet">
<script type="application/javascript" src="./assets/js/timerJava.js"></script>
<main>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Geachte <?php echo $bezoeker[0]. ' ' . $bezoeker[1];?></h1>
            <p>Wij van iConcepts willen U producten aanbieden waar U zelf kunt bepalen wat de prijs is.</p>
        </div>
    </div>
    <div class="container">
        <h1 class="display-4">Nieuwste veilingen</h1>
        <div class="row">
              <?php
              if($zoek != ''){
                  if(!empty($resultaat)){
                      haalinformatieop($resultaat);
                  }
                  else echo "Niks gevonden sorry volgende keer beter";
              }
              else haalhompeginaop();
              ?>
        </div>
    </div>
</main>

<footer class="container text-center">
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
