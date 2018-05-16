<?php
if (!isset($_SESSION)) {
    session_start();
    $titel = 'Verkoper';

    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }else{
        $error = '';
    }
}
include_once 'Database_verbinding/database_connectie.php';
include_once 'header.php';
include_once 'PHP_bestanden/php_verkoper.php'
//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';
?>
    <link href="assets/css/login.css" rel="stylesheet">
<div class="container">
    <form action="PHP_bestanden/verkoperworden.php" method="post" class="col-md-4 col-form-label">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
        <div class="form-group">
            <select Name='banknaam' required>
                <option value="">Kies uw bank</option>
                <option value="Rabobank">Rabobank</option>
                <option value="ING">ING</option>
                <option value="ABN Ambro">ABN Ambro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bankrekeningnummer">Bankrekeningnummer</label>
            <input id="bankrekeningnummer" class="form-control" name="bankrekeningnummer" type="text" required>
        </div>
        <div class="form-group">
            <label for="creditcardnummer">Creditcardnummer (controle)</label>
            <input id="creditcardnummer" class="form-control" name="creditcardnummer" type="text" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Verzenden</button>
        </div>
        <?php echo $error;?>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
