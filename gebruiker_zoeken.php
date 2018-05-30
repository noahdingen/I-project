<?php
include_once 'databaseverbinding/database_connectie.php';
include 'header.php';
include_once 'zoek_gebruiker.php';

$titel = 'Gebruiker zoeken';


if(isset($_GET['gebruikers'])){
    $gebruikers = $_GET['gebruikers'];
}else{
    $gebruikers = '';
}

if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}


echo $error;
if(empty($gebruikers)){

    echo '
    <link href="assets/css/login.css" rel="stylesheet">

      <div class="container">
    <form action="zoek_gebruiker.php" method="post" class="col-md-3 col-form-label">
        <div class="form-group">
            <label for="gebruikersnaam">Gebruiker zoeken</label>
            <input id="gebruikersnaam_zoeken" class="form-control" name="gebruikersnaam_zoeken" type="text" required>
        </div>
        <?php echo $error;?>
        <div class="container">
            <button type="submit" class="btn btn-primary">Zoek</button>
        </div>
    </form>
</div>';
}
else {

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