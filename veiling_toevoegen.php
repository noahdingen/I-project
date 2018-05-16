<?php
$titel = 'Veiling_Toevoegen';
include 'header.php';
?>

<link href="assets/css/veiling_toevoegen.css" rel="stylesheet">
<main>
    <div class="container">
        <h1 class="display-3">Veiling aanmaken</h1>
        <form class="col-form-label-lg" action="PHP_bestanden/db_registratie.php" method="post">
            <div class="form-group">
                <label for="titel">Titel</label>
                <input type="text" class="form-control" name="titel" id="titel" placeholder="Titel" required autofocus maxlength="60">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <input type="text" class="form-control" name="beschrijving" id="beschrijving" placeholder="Beschrijving" required autofocus maxlength="255">
            </div>
            <div class="form-group">
                <label for="rubriek">Wat wil je precies verkopen? Type een steekwoord in om je rubriek te kiezen.</label>
                <input type="text" class="form-control" name="rubriek" id="rubriek" placeholder="Zoeken" required>
            </div>
            <div class="form-row">
                <label for="rubriek_keuze">Kies je rubriek</label>
                <select class="form-control form-control-md" id="rubriek_keuze" name="rubriek_keuze" required>
                    <option value="">...</option>
                    <option value="1">Hoofdrubriek</option>
                    <option value="2">Hoofdrubriek</option>
                    <option value="3">Hoofdrubriek</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="startprijs">Startprijs</label>
                    <input type="number" class="form-control" name="startprijs" id="startprijs" placeholder="Startprijs" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="looptijd_dag">Looptijd (dag)</label>
                    <select class="form-control form-control-md" id="looptijd_dag" name="looptijd_dag" required>
                        <option value="">Looptijd (dag)</option>
                        <option value="1">3 dagen</option>
                        <option value="2">5 dagen</option>
                        <option value="3">7 dagen</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="betalingswijze">Betalingswijze</label>
                    <input type="text" class="form-control" name="betalingswijze" id="betalingswijze" placeholder="Betalingswijze" required maxlength="10">
                </div>

            </div>



            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="afbeelding">Afbeelding</label>
                    <input type="file" class="form-control" name="afbeelding" id="afbeelding" placeholder="Afbeelding" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="afbeelding2">Afbeelding (optioneel)</label>
                    <input type="file" class="form-control" name="afbeelding2" id="afbeelding2" placeholder="Afbeelding" required>
                </div>


                <div class="form-group col-md-4">
                    <label for="afbeelding3">Afbeelding (optineel)</label>
                    <input type="file" class="form-control" name="afbeelding3" id="afbeelding3" placeholder="Afbeelding" required>
                </div>


            </div>


            <div class="form-group">
                <label for="betalingsinstructies">Betalingsinstructies</label>
                <input type="text" class="form-control" name="betalingsinstructies" id="betalingsinstructies" placeholder="Betalingsinstructies" required>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="verzendkosten">Verzendkosten</label>
                    <input type="text" class="form-control" name="verzendkosten" id="verzendkosten" placeholder="Verzendkosten" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="land">Land</label>
                    <select class="form-control form-control-md" id="land" name="land" required>
                        <option value="">Land</option>
                        <option value="1">Nederland</option>
                        <option value="2">Uit de database</option>
                        <option value="3">Uit de database</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="plaatsnaam">Plaatsnaam</label>
                    <input type="text" class="form-control" name="plaatsnaam" id="plaatsnaam" placeholder="Plaatsnaam" required maxlength="28">
                </div>
            </div>

            <div class="form-group">
                <label for="verzendinstructies">Verzendinstructies</label>
                <input type="text" class="form-control" name="verzendinstructies" id="verzendinstructies" placeholder="Verzendinstructies" required maxlength="27">
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
