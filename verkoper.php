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
    <body class="text-center">
    <form action="PHP_bestanden/verkoperworden.php" method="post" class="form-signin" >


    <title>Verkoper</title>
            <h1 class="h3 mb-3 font-weight-normal">Verkoper worden?</h1>
     <div class="form-group">
                <select Name='banknaam'>
                    <option value="">Kies uw bank</option>
                    <option value="Rabobank">Rabobank</option>
                    <option value="ING">ING</option>
                    <option value="ABN Ambro">ABN Ambro</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="bankrekeningnummer" id="bankrekeningnummer" class="form-control input-sm" placeholder="bankrekeningnummer">
            </div>
            <div class="form-group">
                <select Name='controleoptienaam'>
                    <option value="">Kies uw controleoptie</option>
                    <option value="Creditcard">Creditcard</option>
                    <option value="Post">Post</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="rekeningnummer" id="rekeningnummer" class="form-control input-sm" placeholder="rekeningnummer">
            </div>
            <?php echo $error;?>
            <input type="submit" value="Upgrade naar verkoper" class="btn btn-info btn-block">
    <input type="reset" value="Gegevens verwijderen" class="btn btn-info btn-block"></form>
