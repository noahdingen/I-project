<?php
    include_once 'header.php';
    include_once 'Database_verbinding/database_connectie.php';
    include_once 'PHP_bestanden/Inloggen.php';
?>
    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="assets/css/signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->

<body class="text-center">

<form class="form-signin" action="PHP_bestanden/Inloggen.php" method="post">
    <?php echo $error; ?>
    <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Hier inloggen</h1>
    <div class="gebruikersnaam">
        <label for="Gebruikersnaam" class="sr-only">Gebruikersnaam</label>
        <input type="text" id="Gebruikersnaam" name="gebruikersnaam" class="form-control" placeholder="Gebruikersnaam" required autofocus>
    </div>
    <label for="inputPassword" class="sr-only">Wachtwoord</label>
    <input type="password" id="inputPassword" name="wachtwoord" class="form-control" placeholder="wachtwoord" required>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Onthoud mij
        </label>
    </div>

    <input type="submit" class="btn btn-lg btn-primary btn-block" name="aanmelden" value="Aanmelden">
    <p class="mt-5 mb-3 text-muted">&copy; EenmaalAndermaal 2018</p>
</form>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>





