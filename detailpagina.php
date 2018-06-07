<?php
include 'php/veiling_gegevens.php';
$titel = 'Detailpagina';
$voorwerpnummer = $_GET['voorwerpnummer'];
include_once 'php/beheerder_zoeken.php';
include_once 'php/rubriekenboom.php';

if(!isset($_GET['error'])){
    $_GET['error'] = '';
}

include 'header.php';
?>
<link href="assets/css/detailpagina.css" rel="stylesheet">
<link href="assets/css/timer.css" rel="stylesheet">
<script src="./assets/js/timerJava.js"></script>
<main>

    <div class="container-fluid">
	
        <div class="row justify-content-between">
		
            <div class="col-md-5 mx-3 my-4 bg-light text-center">

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

            <div class="col-md-5 my-4">	
                <div class="bg-light">
					<div class="timer" id="clockdiv">
					<?php
                    if(haalblokadeop($voorwerpnummer)[0]['geblokkeerd'] == 'ja'){
                        echo '<div class="form-group">Deze veiling is geblokkeerd.</div>';
                    }elseif($_GET['error']!=''){
                        echo '<div class="form-group"> ' . $_GET['error'] . '</div>';
                        header("Refresh: 5; location: detailpagina.php?voorwerpnummer=".$voorwerpnummer."");
                    }else {
                        timer();
                    }?>
					</div>
                    <?php haalbiedingenop($voorwerpnummer);?>
                </div>
                <?php echo '<form method="post" action="php/bod_toevoegen.php?voorwerpnummer=' . $voorwerpnummer . '">'; ?>
                <div class="form-group">

						<?php
                        if(!$item) {
                            if (isset($_GET['veilingstatus']) && $_GET['veilingstatus'] == 0) {
                                echo ' ';
                            } else {
                                echo '
                        <div class="my-md-3 form-group text-center">
                            <input type="text" class="form-control" id="bodbedrag" name="bodbedrag" placeholder="Doe een bod">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="biedenknop" class="btn btn-primary">Bied</button>
                        </div>
                        </form>';
                            }
                        }else{
                            if (isset($_GET['veilingstatus']) && $_GET['veilingstatus'] == 0) {
                                echo ' ';
                            } else {
                                echo '
                        <div class="my-md-3 form-group text-center">
                            <input type="text" class="form-control" id="bodbedrag" name="bodbedrag" placeholder="Deze veiling is geblokkeerd" readonly>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="biedenknop" class="btn btn-primary">Bied</button>
                        </div>
                        </form>';
                            }
                        }?>
                    <?php
                        echo '<br>';
                    if($beheerder == 'ja') {
                    echo '
                    <form method="post" action="php/blokkeerveiling.php?voorwerpnummer=' . $voorwerpnummer . '">

                    ';
                    if($item == false) {
                        echo '<label>Met deze knop kunt u de veiling blokkeren.</label>
                    <input type="hidden" id="voorwerpnummer" name="voorwerpnummer"><br>

                        <button type="submit" name="blokkeerknop" class="btn btn-primary">Blokkeer</button>';
                    }else{
                        echo '
                    <p>Met deze knop kunt u de veiling deblokkeren.</p>
                 <label>Als de veiling is gedeblokkeerd, komt de timer weer terug.</label>
                    <input type="hidden" id="voorwerpnummer" name="voorwerpnummer"><br>

                        <button type="submit" name="blokkeerknop" class="btn btn-primary">Deblokkeer</button>';
                    }echo'     
                </form>';
                    } ?>
                </div>


                <div class="col-md-5 my-4">
            <h1>
                Beschrijving
            </h1>
            <div class="bg-light text-center">
            <?php haalbeschrijvingop($voorwerpnummer); ?>
            </div>
        </div>
        <div class="col-md-5 my-4">
            <h1>
                Verkoper informatie
            </h1>
            <div class="bg-light text-center">
                <?php haalverkoperop($voorwerpnummer); ?>
            </div>

                <h1>
                    Product informatie
                </h1>
                <div class="bg-light text-center">
                    <?php haalvoorwerpdetailsop($voorwerpnummer,haalallerubriekenop()); ?>
                </div>


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