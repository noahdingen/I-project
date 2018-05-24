<?php
if(isset($_POST['rubriek'])) {
    include '../databaseverbinding/database_connectie.php';
    $conn = verbindMetDatabase();

    $resultaat = $_POST['rubriek'];
    $rubriek = "%" . $resultaat . "%";

    $sql_rubriek = "select * from Categorieen where Name like ?";
    $db_rubrieken = $conn->prepare($sql_rubriek);
    $db_rubrieken->execute(array($rubriek));
    $rows = $db_rubrieken->fetchAll(PDO::FETCH_ASSOC);
    $aantal = count($rows);

   header("location: ../rubriek_veiling_toevoegen.php");
}



function haalrubriekenop()
{
    global $rows;
    foreach($aantallen as $aantal) {
        echo '<option value = "' . $rows[0]['Name'] . '" >' . $rows[0]['Name'] . '</option >';
    }
}
?>




