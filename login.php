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
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/signin.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
<?php include 'header.php' ?>
<form class="form-signin">

    <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Hier inloggen</h1>
    <label for="Gebruikersnaam" class="sr-only">Gebruikersnaam</label>
    <input type="text" id="Gebruikersnaam" class="form-control" placeholder="Gebruikersnaam" required autofocus>
    <label for="inputPassword" class="sr-only">Wachtwoord</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Onthoud mij
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Inloggen</button>
    <p class="mt-5 mb-3 text-muted">&copy; EenmaalAndermaal 2018</p>
</form>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
