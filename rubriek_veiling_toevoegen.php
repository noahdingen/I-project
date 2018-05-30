<?php
include_once 'databaseverbinding/database_connectie.php';
include_once 'php/rubriek_zoeken.php';
$titel = 'Veiling toevoegen';
include 'header.php';
?>

<link href="assets/css/veiling_toevoegen.css" rel="stylesheet">
<main>
    <div class="container">
        <h1 class="display-3">Veiling aanmaken</h1>
        <form class="col-form-label-lg" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="rubriek">Wat wil je precies verkopen? Type een steekwoord in om je rubriek te kiezen.</label>
                <input type="text" class="form-control" name="rubriek" id="rubriek" placeholder="Zoeken"
                       <?php
                       if(isset($_POST['rubriek'])) {
                         echo 'value="' . $_POST['rubriek'] . '"';
                        }
                        ?>
                       required>
            </div>
            <input type="submit" name="Zoeken" class="btn btn-primary">
        </form>
        <form class="col-form-label-lg" action="veiling_toevoegen.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="rubriek_keuze">Kies je rubriek</label>
                <select class="form-control form-control-md" id="rubriek_keuze" name="rubriek_keuze" required>
                    <?php
                    if(isset($_POST['rubriek'])) {
                        haalrubriekenop();
                    }else{
                        echo '<option value="">...</option>';
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="Verzenden" class="btn btn-primary">
        </form>
    </div>
</main>

<footer class="container text-center">
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

