<?php
include_once 'databaseverbinding/database_connectie.php';

if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['zoeken'])) {
    $zoek = $_GET['zoeken'];
}
else {
    $zoek = '';
}

if(isset($_SESSION['gebruikers'])) {
    $pdo = verbindMetDatabase();

    $sql = "select verkoper, beheerder from Gebruiker where gebruikersnaam =?";
    $query = $pdo->prepare($sql);
    $query->execute([$_SESSION['gebruikers']]);

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $verkoper = $rows[0]['verkoper'];
    $beheerder = $rows[0]['beheerder'];
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $titel; ?></title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/header.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-light bg-dark justify-content-between">
        <a href="index.php" class="btn btn-primary" role="button">Home</a>

        <form class="form-inline" action="index.php" method="get">
            <input class="form-control mr-sm-4" type="search" name="zoeken" placeholder="Zoeken naar veilingen" aria-label="Search" required>
            <button class="btn btn-primary" type="submit">Zoeken</button>
        </form>


        <?php
        include 'php/sessie_bezoeker.php';
        if(isset($_SESSION['gebruikers'])) {
            echo '
             <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.$bezoeker[0]. '
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                        <a href="profielpagina.php?bewerken=false" class="dropdown-item" role="button">Mijn profiel</a>';
            if ($verkoper == 'ja  ') {
                echo '<a href="rubriek_veiling_toevoegen.php  " class="dropdown-item" role="button">Plaats veiling</a>';
            }
            if ($beheerder == 'ja') {
                echo '<a href="gebruiker_zoeken.php" class="dropdown-item" role="button">Gebruiker zoeken</a>';
            }
             echo '<a href="php/loguit.php" class="dropdown-item" role="button">Loguit</a>
                  </div>
             </div>';
        }
        else {
            echo '
        <div>
            <a href="registreren.php" class="btn btn-primary" role="button">Registreren</a>
            <a href="login.php" class="btn btn-primary" role="button">Login</a>
        </div>';
        }


        $pdo = verbindMetDatabase();
        $data = $pdo->prepare("SELECT * FROM Voorwerp WHERE titel LIKE'%".$zoek."%'");
        $data->execute();
        $resultaat = $data->fetchAll(PDO::FETCH_NAMED);

        ?>
    </nav>
</header>

