<?php
include_once 'databaseverbinding/database_connectie.php';
include_once 'header.php';
if (!isset($_SESSION)) {
    session_start();
    $titel = 'Verkoper';
}
    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }else{
        $error = '';
    }

if($beheerder == 'ja'){
    header("location: ./index.php");
}
if (!isset($_SESSION['gebruikers'])) {
    header("location: ./index.php");
}
else if(isset($_SESSION['gebruikers'])){

global $conn;
$conn =  new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$Gebruiker = $_SESSION['gebruikers'];

$data = $conn->prepare("SELECT verkoper FROM Gebruiker WHERE gebruikersnaam = ? AND verkoper = 'wel'");
$data->execute(array($Gebruiker));
$resultaat = $data->fetchAll(PDO::FETCH_NAMED);
for($i = 0; $i < count($resultaat); $i++){

}

$test = 'wel';
if($i == 1){
    header("location: ./index.php");
}
else {

//Regel hieronder is voor server!
//require_once '../Server_verbinding/SQLSrvConnect.php';
?>
    <link href="assets/css/login.css" rel="stylesheet">
<div class="container">
    <form action="php/verkoperworden.php" method="post" class="col-md-4 col-form-label">
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
            <label for="IBAN-Nummer">IBAN-Nummer</label>
            <input id="IBAN-Nummer" class="form-control" name="IBAN-Nummer" type="text" required>
        </div>
        <div class="form-group">
            <label for="creditcardnummer">Creditcardnummer (controle)</label>
            <input id="creditcardnummer" class="form-control" name="creditcardnummer" type="number" min="0" required>
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
<?php }} ?>