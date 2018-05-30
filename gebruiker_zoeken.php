<?php
include_once 'databaseverbinding/database_connectie.php';
$titel = 'Gebruiker zoeken';
include 'header.php';
include_once 'php/zoek_gebruiker.php';


?>
    <link href="assets/css/gebruiker_zoeken.css" rel="stylesheet">

      <div class="container">
          <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <input id="gebruikersnaam_zoeken" class="form-control mr-sm-2" name="gebruikersnaam_zoeken"
                           placeholder="Gebruiker zoeken"
                            <?php
                            if(isset($_POST['gebruikersnaam_zoeken'])) {
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
if(isset($_POST['gebruikersnaam_zoeken'])){
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
