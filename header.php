<?php
if (!isset($_SESSION)) {
    session_start();
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

    <nav class="navbar navbar-light bg-dark justify-content-between">
        <a href="index.php" class="btn btn-primary" role="button">Home</a>
        <form class="form-inline">
            <input class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>


        <?php
        include 'PHP_bestanden/sessie_bezoeker.php';
        if(isset($_SESSION['gebruikers'])) {
            echo '
              <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.$bezoeker[0].'
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                        <a href="profielpagina.php?bewerken=false"><button class="dropdown-item" type="button">Mijn profiel</button></a>
                        <a href="PHP_bestanden/Loguit.php"><button class="dropdown-item" type="button">Loguit</button></a>
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
        ?>
    </nav>
</head>

