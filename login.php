<?php
//error voor wat er fout is gegaan met het inloggen, al geset of niet?
if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}
$titel = 'Login';
include 'header.php'
?>

<link href="assets/css/login.css" rel="stylesheet">
<div class="container">
    <form action="php/inloggen.php" method="post" class="col-md-3 col-form-label">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="logo" width="72" height="72">
        <div class="form-group">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input id="gebruikersnaam" class="form-control" name="gebruikersnaam" type="text">
        </div>
        <div class="form-group">
            <label for="wachtwoord">Wachtwoord</label>
            <input id="wachtwoord" class="form-control" name="wachtwoord" type="password">
        </div>
        <?php echo $error;?>
        <div class="container">
            <a href="wachtwoord_vergeten.php" class="btn btn-primary" role="button">Wachtwoord vergeten?</a>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Inloggen</button>
        </div>
    </form>
</div>
<footer class="container">
    <p>&copy; EenmaalAndermaal 2018</p>
</footer>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
