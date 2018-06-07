<?php
include_once 'php/rubriek_zoeken.php';
include_once 'databaseverbinding/database_connectie.php';
$titel = 'Veiling toevoegen';
include 'header.php';

if(!isset($_SESSION['gebruikers']) || $gebruiker != $_SESSION['gebruikers'] || $verkoper == 'nee'){
		header("location: ./index.php");
}
?>

<link href="assets/css/veiling_toevoegen.css" rel="stylesheet">
<main>
    <div class="container">
        <h1 class="display-3">Veiling aanmaken</h1>
        <form class="col-form-label-lg" action="php/veiling_toevoegen_in_database.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titel">Titel</label>
                <input type="text" class="form-control" name="titel" id="titel" placeholder="Titel" pattern=".{60}" title="De titel mag niet meer dan 60 tekens zijn." required autofocus>
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <input type="text" class="form-control" name="beschrijving" id="beschrijving" placeholder="Beschrijving" pattern=".{255}" title="De beschrijving mag niet meer dan 255 tekens zijn." required>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="rubriek" id="rubriek" value="<?php haalrubrieknummerop()?>">
            </div>
            <div class="form-group">
                <label for="rubriek_onzin">Dit is uw gekozen rubriek.</label>
                <input type="text" class="form-control" name="rubriek_onzin" id="rubriek_onzin"  value="<?php haalrubrieknaamop()?>" readonly>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="startprijs">Startprijs</label>
                    <input type="number" class="form-control" name="startprijs" id="startprijs" placeholder="Startprijs" min="1" max="10000000" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="looptijd_dag">Looptijd (dag)</label>
                    <select class="form-control form-control-md" id="looptijd_dag" name="looptijd_dag" required>
                        <option value="">Looptijd (dag)</option>
                        <option value="3">3 dagen</option>
                        <option value="5">5 dagen</option>
                        <option value="7">7 dagen</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="betalingswijze">Betalingswijze</label>
                    <select class="form-control" name="betalingswijze" id="betalingswijze" required>
                        <option value="">...</option>
                        <option value="iDeal">iDEAL</option>
                        <option value="creditcard">Creditcard</option>
                        <option value="paypal">PayPal</option>
                        <option value="afterpay">Afterpay</option>
                        <option value="contant">Contant</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="afbeelding_1">Afbeelding één</label>
                    <input type="file" class="form-control" name="afbeelding_1" id="afbeelding_1"  accept="image/*" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="afbeelding_2">Afbeelding twee</label>
                    <input type="file" class="form-control" name="afbeelding_2" id="afbeelding_2" accept="image/* ">
                </div>
                <div class="form-group col-md-4">
                    <label for="afbeelding_3">Afbeelding drie</label>
                    <input type="file" class="form-control" name="afbeelding_3" id="afbeelding_3" accept="image/* ">
                </div>
            </div>


            <div class="form-group">
                <label for="betalingsinstructies">Betalingsinstructies</label>
                <input type="text" class="form-control" name="betalingsinstructies" id="betalingsinstructies" placeholder="Betalingsinstructies" pattern=".{255}" title="De betalingsinstructies mag niet meer dan 255 tekens zijn.">
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="verzendoptie">Verzendopties</label>
                    <select class="form-control" name="verzendoptie" id="verzendoptie" required>
                        <option value="">...</option>
                        <option value="verzenden">Verzenden</option>
                        <option value="ophalen">Ophalen</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="land">Land</label>
                    <select class="form-control form-control-md" id="land" name="land" required>
                        <option value="">Land</option>
                        <?php include 'php/landen.php' ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="plaatsnaam">Plaatsnaam</label>
                    <input type="text" class="form-control" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" pattern=".{28}" title="De plaatsnaam mag niet meer dan 28 tekens zijn." required>
                </div>
            </div>

            <div class="form-group">
                <label for="verzendinstructies">Verzendinstructies</label>
                <input type="text" class="form-control" name="verzendinstructies" id="verzendinstructies" placeholder="verzendinstructies" pattern=".{255}" title="De verzendinstructies mag niet meer dan 255 tekens zijn.">
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
