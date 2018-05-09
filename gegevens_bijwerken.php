<?php
include_once 'header.php';
include_once 'Database_verbinding/database_connectie.php';

if(isset($_GET["inhoudstype=true"])){
    header("location: profielpagina.php");
}else {
    header("location: profielpagina.php?inhoudstype=true");
}
?>
