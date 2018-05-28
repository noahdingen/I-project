<?php
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET["token"])||isset($_GET["error"])) {
    $token = $_GET["token"];
    if(isset($_GET["error"])) {
        $error = $_GET["error"];
    }
    else{
        $error = '';
    }

    $data = $conn->prepare("SELECT gebruikersnaam FROM WachtwoordVeranderen WHERE geheimetekens = '$token'");
    $data->execute();
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
    $gebruikersnaam = $resultaat[0]['gebruikersnaam'];
    echo $gebruikersnaam;
    for ($i = 0; $i < count($resultaat); $i++) {

    }
    if ($i == 0 && !isset($_GET["error"])) {
        $error = "Geen toegang mogelijk!";
        echo $error;
        header("refresh:5; url='login.php'");
    }
    else {

    $titel = 'Wachtwoord vergeten';
    include 'header.php'
        ?>
        <link href="assets/css/login.css" rel="stylesheet">
        <div class="container">
            <form class="col-md-3 col-form-label" action='php_bestanden/wijzigen_ww.php' method="post">
                <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="logo" width="72"
                     height="72">
                <p>Wijzig uw wachtwoord</p>
                <?php echo $error; ?>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="gebruiker" value=<?php echo $gebruikersnaam ?>>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="wachtwoord" id="wachtwoord" required pattern=".{8,200}" placeholder="Wachtwoord">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="bevestig_wachtwoord" id="bevestig_wachtwoord" required pattern=".{8,200}" placeholder="Herhaal wachtwoord">
                </div>
                <div class="container">
                    <button type="submit" name="wijzigen" class="btn btn-primary">Wijzigen</button>
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
        <?php
    }
}
?>