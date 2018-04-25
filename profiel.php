<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 24-4-2018
 * Time: 15:45
 */
require_once('header.php');
?>
    <title>Verkoper</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/signin.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
<?php include 'header.php' ?>
<div class="registreren">
    <form class="form-signin">

        <h1 class="h3 mb-3 font-weight-normal">Verkoper worden?</h1>
        <form role="form">

            <div class="form-group">
                <input type="text" name="gebruikersnaam" id="gebruikersnaam" class="form-control input-sm" placeholder="gebruikersnaam">
            </div>
            <div class="form-group">
                <select>
                    <option value="volvo">Kies uw bank</option>
                    <option value="saab">Rabobank</option>
                    <option value="mercedes">ING</option>
                    <option value="audi">ABN Ambro</option>
                    <option
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="bankrekeningnummer" id="bankrekeningnummer" class="form-control input-sm" placeholder="bankrekeningnummer">
            </div>
            <div class="form-group">
                <input type="text" name="bankrekeningnummer" id="bankrekeningnummer" class="form-control input-sm" placeholder="bankrekeningnummer">
            </div>
            <input type="submit" value="Registreren" class="btn btn-info btn-block">