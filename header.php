<?php
include_once 'databaseverbinding/database_connectie.php';
include_once 'php/beheerder_zoeken.php';
include_once 'php/rubriekenboom.php';
$rubrieken = haalallerubriekenop();

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
    global $conn;
    $conn = new PDO("sqlsrv:Server=mssql.iproject.icasites.nl; Database=iproject39; ConnectionPooling = 0", "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn;

    $sql = "select verkoper, beheerder from Gebruiker where gebruikersnaam =?";
    $query = $pdo->prepare($sql);
    $query->execute([$_SESSION['gebruikers']]);

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    $verkoper = $rows[0]['verkoper'];
    $beheerder = $rows[0]['beheerder'];
}

if(!isset($beheerder)){
    $beheerder = 'nee';
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
    <link rel="shortcut icon" href="assets/images/hammer.png" type="image/x-icon"/>
	<link href="assets/css/sidebar.css" rel="stylesheet">
	<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
</head>
<body>
<header>

    <nav class="navbar navbar-light bg-dark justify-content-between">
	<div>
	<?php $pagina = $_SERVER['REQUEST_URI'];
		if (strpos($_SERVER['REQUEST_URI'], "php/index.php") !== false){
			echo '<div id="mySidenav" class="sidenav">
				  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
				  weergeefrubriekenboom($rubrieken);			  
			echo  '</div>
				 <button onclick="openNav()" class="btn btn-primary">Rubrieken » </button>';			}		
		?>
			
        <a href="index.php" class="btn btn-primary" role="button">Home</a>
		</div>

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

	
		date_default_timezone_set("Europe/Amsterdam");
		$huidige_tijd = date('H:i:s');
		$huidige_dag =  date('Y-m-d');
        $pdo = verbindMetDatabase();

if($beheerder == 'nee') {
    $data = $pdo->prepare("SELECT * FROM Voorwerp WHERE geblokkeerd = 'nee' AND titel LIKE'%" . $zoek . "%' AND ((looptijdeindeDag = ? AND looptijdeindeTijdstip > ?) OR looptijdeindeDag > ?)");
    $data->execute(array($huidige_dag, $huidige_tijd, $huidige_dag));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
}elseif($beheerder == 'ja'){
    $data = $pdo->prepare("SELECT * FROM Voorwerp WHERE titel LIKE'%" . $zoek . "%' AND ((looptijdeindeDag = ? AND looptijdeindeTijdstip > ?) OR looptijdeindeDag > ?)");
    $data->execute(array($huidige_dag, $huidige_tijd, $huidige_dag));
    $resultaat = $data->fetchAll(PDO::FETCH_NAMED);
}
?>
    </nav>
</header>

