<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 25-4-2018
 * Time: 13:46
 */
require_once('../Database_verbinding/database_connectie.php');

$_SESSION['user'] = $_POST['username'];
$bank = $_POST['banknaam'];
$banknummer = $_POST['bankrekeningnummer'];
$controle = $_POST['controleoptienaam'];
$creditnummer = $_POST['creditcardnummer'];
