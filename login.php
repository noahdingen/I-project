<?php

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
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="../assets/css/signin.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
<?php include 'header.php' ?>

    <div class="photo">
    <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="200" height="200">
    </div>

<div class="container">
    <form class="col-form-label-lg">
        <div class="form-group">
            <label for="inputAddress">Gebruikersnaam</label>
            <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" placeholder="Gebruikersnaam">
        </div>
        <div class="form-group">
            <label for="inputAddress">Wachtwoord</label>
            <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
        </div>

        <button type="submit" class="btn btn-primary">Inloggen</button>
    </form>
</div>
<!--<form class="col-form-label-lg">-->
<!--    <div class="form-group">-->
<!--        <label for="inputAddress">Gebruikersnaam</label>-->
<!--        <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" placeholder="Gebruikersnaam">-->
<!--    </div>-->
<!--        <div class="form-group">-->
<!--            <label for="wachtwoord">Password</label>-->
<!--            <input type="password" class="form-control" id="wachtwoord" placeholder="wachtwoord">-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary">Inloggen</button>-->
<!--    </form>-->
<!--    <label for="Gebruikersnaam" class="sr-only">Gebruikersnaam</label>-->
<!--    <input type="text" id="Gebruikersnaam" class="form-control" placeholder="Gebruikersnaam" required autofocus>-->
<!--    <label for="inputPassword" class="sr-only">Wachtwoord</label>-->
<!--    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>-->
<!---->
<!--    <button class="btn btn-lg btn-primary btn-block" type="submit">Inloggen</button>-->
    <p class="mt-5 mb-3 text-muted">&copy; EenmaalAndermaal 2018</p>

<?php
if (isset($_SESSION['errors'])) {
    $error = $_SESSION['errors'];
    echo "$error <br>";
    session_unset($_SESSION['errors']);
}
else if (isset($_SESSION['succes'])){
    $succes = $_SESSION['succes'];
    session_unset($_SESSION['succes']);
    echo $succes;
}
?>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
