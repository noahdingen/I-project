<?php
$sql = "select verkoper, beheerder from Gebruiker where gebruikersnaam =?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['gebruikers']]);

//Zorgt voor de database connectie (uit datase_connectie.php)
$conn = verbindMetDatabase();

//Zoekt een ingevoerde gebruiker op
function haalgebruikersop(){
    $conn = verbindMetDatabase();
    $sql_gebruikersnaam = '%' . $_POST['gebruikersnaam_zoeken'] . '%';
    $sql = "SELECT gebruikersnaam, emailadres, geblokkeerd FROM Gebruiker WHERE gebruikersnaam LIKE ?";
    $data = $conn->prepare($sql);
    $data->execute(array($sql_gebruikersnaam));
    $rijen = $data->fetchAll(PDO::FETCH_NAMED);
    $aantal = count($rijen);
    if(!empty($rijen)) {
        //zet de gevonden gebruikers in een tabel
        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Gebruikersnaam</th>
                  <th scope="col">Email adres</th>
                  <th scope="col">Geblokkeerd</th>
                  <th scope="col">Details</th>
                </tr>
              </thead>
                <tbody>';
        for ($i = 0; $i < $aantal; $i++) {
            $hoeveelheid = $i+1;
            echo '<tr>';
            echo '<th scope="row">' . $hoeveelheid . '</th>';
            echo '<td>' . $rijen[$i]['gebruikersnaam'] . '</td>';
            echo '<td>' . $rijen[$i]['emailadres'] . '</td>';
            echo '<td>' . $rijen[$i]['geblokkeerd'] . '</td>';
            echo '<td>
                    <div class="link">
                        <a href="detailpagina_gebruiker.php?gebruikersnaam=' . $rijen[$i]['gebruikersnaam'] . '" >Zie details</a>
                    </div>
                  </td>
                  ';
            echo '</tr>';
        }
        echo '      </tbody>
          </table>';
    }else{
        echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                          <th scope="col">Er zijn geen gebruikers gevonden met de naam: ' . $_POST['gebruikersnaam_zoeken'] . '</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                    </tr>
                </thead>
            </table>';
    }
}
?>