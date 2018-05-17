<?php
//error voor wat er fout is gegaan met het inloggen, al geset of niet?
if(isset($_GET['error'])){
    $error = $_GET['error'];
}else{
    $error = '';
}
$titel = 'Wachtwoord vergeten';
include 'header.php'
?>
<link href="assets/css/login.css" rel="stylesheet">
<div class="container">
    <form class="col-md-3 col-form-label" action="wachtwoord.php">
        <img class="mb-4" src="https://icon-icons.com/icons2/474/PNG/512/auction-hammer_46873.png" alt="" width="72" height="72">
        <p>Als U de geheime vraag correct beantwoordt, ontvangt U een e-mail met verdere instructies voor het veranderen van uw wachtwoord.</p>
        <div class="form-group">
            <input id="gebruikersnaam" class="form-control" name="gebruikersnaam" type="text" placeholder="Gebruikersnaam" required>
        </div>
        <div class="form-group">
            <label for="geheime_vraag">Geheime vraag</label>
            <select class="form-control form-control-lg" id="geheime_vraag" name="geheime_vraag" required>
                <option value="">...</option>
                <option value="1">Waar ben je geboren?</option>
                <option value="2">Wat is je lievelingsdier?</option>
                <option value="3">Wie is jouw superheld?</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="antwoord" id="antwoord" placeholder="Antwoord" required>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Verzenden</button>
        </div>
    </form>
</div>
