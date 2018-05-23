<?php
include 'php_bestanden/veiling_gegevens.php';
//include 'PHP_bestanden/sessie_bezoeker.php';
$titel = 'Detailpagina';
$voorwerpnummer = $_GET['voorwerpnummer'];
include 'header.php';
?>
<link href="assets/css/detailpagina.css" rel="stylesheet">
<main>
    <div class="container-fluid">
        <div class="row mx-1">
            <div class="col-md-5 bg-light text-center">
                <div class="container">
                <h1><?php haaltitelop($voorwerpnummer) ?></h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php haalafbeeldingenop($voorwerpnummer) ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-5">
                <div class="container bg-light">
                    <?php haalbiedingenop($voorwerpnummer);?>
                </div>
                <?php echo '<form method="post" action="php_bestanden/bod_toevoegen.php?voorwerpnummer=' . $voorwerpnummer . '"'; ?>
                <div class="form-group">
                        <div class="my-md-3 form-group text-center">
                            <input type="text" class="form-control" id="bodbedrag" name="bodbedrag" placeholder="Doe een bod">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="biedenknop" class="btn btn-primary">Bied</button>
                        </div>
                </div>
                </form>
            </div>
            <div class="w-100"></div>
            <div class="col text-center">
                <h1>
                    Beschrijving
                </h1>

            </div>
            <div class="col text-center">
                <h1>
                    Verkoper informatie
                </h1>
            </div>
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