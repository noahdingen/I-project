<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'databaseverbinding/database_connectie.php';
include_once 'php/beheerder_zoeken.php';
$titel = 'Gebruiker zoeken';
include_once 'header.php';
if($beheerder == 'ja') {

    include_once 'php/zoek_gebruiker.php';


    ?>
    <link href="assets/css/gebruiker_zoeken.css" rel="stylesheet">

    <div class="container">
        <form method="post" class="form-inline">
            <div class="form-group">
                <input id="gebruikersnaam_zoeken" class="form-control mr-sm-2" name="gebruikersnaam_zoeken"
                       placeholder="Gebruiker zoeken"
                    <?php
                    if (isset($_POST['gebruikersnaam_zoeken'])) {
                        echo 'value="' . $_POST['gebruikersnaam_zoeken'] . '"';
                    }
                    ?>
                       type="text" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zoek</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['gebruikersnaam_zoeken'])) {
        haalgebruikersop();
    }
    ?>

    <footer class="container">
        <p>&copy; EenmaalAndermaal 2018</p>
    </footer>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}else{
    echo 'U bent hier niet voor geautoriseerd';
    echo '<p>Door deze <a href="index.php">link</a> gaat u terug naar de homepagina ';
}
?>
