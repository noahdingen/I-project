<?php
if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}

$titel = 'Account activatie';
include 'header.php';
if(isset($_SESSION['gebruikers'])){
		header("location: ./index.php");
}
?>

<link href="assets/css/login.css" rel="stylesheet">

<h3 class="text-center">Account is succesvol geregistreerd.</h3>
<div class="container">
    <form action="php/check.php" method="post" class="col-md-3 col-form-label">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
        <div class="form-group">
            <H4>Account activatie</H4>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Meer info
                </button>
            <div class="dropdown-menu dropdown-menu">
               <p class="dropdown-item" > U account dient geactiveerd te worden.
                       <br>De activatie code heeft u ontvangen per mail.
                       <br>In het geval dat u de mail niet kan vinden check u spamfolder!
                       <br>In het onderstaande formulier dient u in te vullen:
                       <br>- Gebruikersnaam en de verstuurde activatiecode voor het account.</p>
            </div><br>
        </div>
        <div class="form-group">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input id="gebruikersnaam" class="form-control" name="gebruikersnaam" type="text" placeholder="Gebruikersnaam">
            <label for="mailcode">Activatie code</label>
            <input id="mailcode" class="form-control" name="mailcode" type="password" placeholder="Activatie code">
        </div>
        <?php echo $error;?>
        <div>
            <button type="submit" class="btn btn-primary">Activeren</button>
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
