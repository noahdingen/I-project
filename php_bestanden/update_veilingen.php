<?php
/*
OM DE DATABASE TE UPDATEN!!

UPDATE voorwerp
SET looptijdeindeDag = convert(date, getdate()), looptijdeindeTijdstip = dateadd(ss, 10, convert(time, getdate())), veilingGesloten = 'nee'
where titel = ''
*/

include_once '../databaseverbinding/database_connectie.php';
global $conn;
$conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "update voorwerp set veilingGesloten = 'ja' 
		where veilingGesloten = 'nee' and looptijdeindeDag = convert(date, getdate()) and
		looptijdeindeTijdstip <= convert(time,getdate())";

$data = $conn->prepare($sql);
$data->execute();
?>