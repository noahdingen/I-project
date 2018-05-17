<?php
//error voor wat er fout is gegaan met het inloggen, al geset of niet?
if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}
$titel = 'Wachtwoord vergeten';
include 'header.php'
?>
<link href="assets/css/login.css" rel="stylesheet">
<div class="container">
    <form class="col-md-3 col-form-label" action="login.php">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
        <p>Wijzig uw wachtwoord</p>
        <div class="form-group">
            <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" placeholder="Herhaal wachtwoord" required>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Verzenden</button>
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