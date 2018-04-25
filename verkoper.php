<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 24-4-2018
 * Time: 15:45
 */
include_once('header.php');
include_once('Database_verbinding/database_connectie.php');
?>
    <title>Verkoper</title>

 <link href="assets/css/signin.css" rel="stylesheet">
    <!-- Custom styles for this template -->

<body class="text-center">
            <form action="mailto:dirk47a@gmail.com" method="post" class="form-signin" enctype="text/plain">
            <h1 class="h3 mb-3 font-weight-normal">Verkoper worden?</h1>
            <div class="form-group">
                <select id="test">
                    <option value="">Kies uw bank</option>
                    <option value="Rabobank">Rabobank</option>
                    <option value="ING">ING</option>
                    <option value="ABN Ambro">ABN Ambro</option>
                    <option value="">Ik heb geen bank</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="bankrekeningnummer" id="bankrekeningnummer" class="form-control input-sm" placeholder="bankrekeningnummer">
            </div>
            <div class="form-group">
                <select>
                    <option value="">Kies uw controleoptie</option>
                    <option value="Creditcard">Creditcard</option>
                    <option value="Post">Post</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="rekeningnummer" id="rekeningnummer" class="form-control input-sm" placeholder="rekeningnummer">
            </div>
            <input type="submit" value="Upgrade naar verkoper" class="btn btn-info btn-block">
            <input type="reset" value="Gegevens verwijderen" class="btn btn-info btn-block">