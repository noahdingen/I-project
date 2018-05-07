<?php
 if(isset($_GET['error'])){$error = $_GET['error'];}
    else{ $error = '';}
if (!isset($_SESSION)) {
    session_start();
    $_SESSION['gebruiker'] = false;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
<?php include 'header.php'?>
<div class="container">
    <form action="PHP_bestanden/Inloggen.php" method="post" class="col-form-label-lg">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
        <div class="form-group">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input id="gebruikersnaam" class="form-control" name="gebruikersnaam" type="text">
        </div>
        <div class="form-group">
            <label for="wachtwoord">Wachtwoord</label>
            <input id="wachtwoord" class="form-control" name="wachtwoord" type="password">
        </div>
            <?php echo $error;?>
            <a href="">Wachtwoord vergeten?</a>
            <button type="submit" class="btn btn-primary">Inloggen</button>
    </form>
</div>

<p class="mt-5 mb-3 text-muted">&copy; EenmaalAndermaal 2018</p>

<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
