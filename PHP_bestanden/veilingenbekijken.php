<?php
include_once '../Database_verbinding/database_connectie.php';

$conn = verbindMetDatabase();

$data = $conn->prepare("SELECT * FROM Voorwerp");
$data->execute();
$resultaat = $data->fetchAll(PDO::FETCH_NAMED);
echo "<div>";
for($i = 0; $i < count($resultaat); $i++){
//    echo "<a href='veilingenbekijken.php?id=" . $resultaat[$i]['voorwerpnummer'] . "'>";
    echo "<h1>"  . $resultaat[$i]['titel'] . $resultaat[$i]['titel'] ."</h1>";



}

echo "</div>";
?>