<?php
// log een persoon uit
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION = array();
session_destroy();

header("location: ../index.php");
?>