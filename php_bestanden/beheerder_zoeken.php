<?php
$gebruiker = $_SESSION['gebruikers'];
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo = $conn;
$sql = "select beheerder from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute(array($gebruiker));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
$beheerder = $rows[0]['beheerder'];
if($beheerder == 'ja'){
    $vraag = true;
}else{
    $vraag = false;
}

?>