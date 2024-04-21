<?php
    session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à cette page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else {
    
include("connexion.php"); //connecté avec base des données.
$email = $_SESSION['email'];

$r = $conect->query("SELECT idproprietaire, pre_p, nom_p FROM proprietaires WHERE email_p='$email'");
$id = $r->fetch_assoc();
$_SESSION['$id'] = $id['idproprietaire']; //pour garder id.
$nomp = $id['nom_p'];
$prep  = $id['pre_p'];
?>

<!doctype html>
<html>

<head>
    <style>body {
  font-family: Arial, sans-serif;
            margin: 0;
    margin-left: 20px;
    margin-right: 20px;
    padding: 0;
    background-color:#84A7A1 ;
}

header {
    background-color: #f1f1f1;
    padding: 20px;
    text-align: center;
}

header a {
    text-decoration: none;
    color: #333;
    margin-right: 10px;
}

h1 {
    margin-top: 0;
}

h5 {
    color: red;
    margin-bottom: 20px;
}

main {
    padding: 20px;
}

button {
   background-color: #1585c0;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 150px;
}

button:hover {
    background-color: #ccc;
}

a[name="cmd"], a[name="anc"] {
    background-color: #1585c0;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    text-decoration: none;
}

a[name="cmd"]:hover, a[name="anc"]:hover {
    background-color: #ccc;
}

hr {
    border: none;
    border-top: 1px solid #ccc;
    margin: 20px 0;
}</style>
	<title>à louer</title>
    <a href="sortir.php"><button>Déconnecter</button></a>
<a href="cmd.php" name="cmd">Mes commandes</a>
<a href="annonce.php" name="anc">Mes annonce</a>
    <h1>Tableau de bord</h1>
<h5>Alerte: Si un post est enregistré sans image(s), il sera automatiquement supprimé.</h5>


<br><br>
 <a href="add.php"><button>Nouvelle annonce</button></a>
</head>
<hr>
<body>
 
	<?php
    $result = $conect->query("SELECT * FROM propriete WHERE idproprietaire = '$id[idproprietaire]' ");
    if($result->num_rows > 0 ){

      if (isset($_SESSION['$nv'])) {//1=>existe poste sans img, else{touts les postes sont inclus avec des img}.
        $nv = $_SESSION['$nv'];
        if ($nv == 1) {
            header('location: check.php');
        }
      }
        echo '<h2>Bienvenue '.$nomp.' '.$prep.'</h2>';
        $total = 0;
        $prix_T = 0;
        while ($ligne = $result->fetch_assoc()) { //pour les statistique.
            $sta = $conect->query("SELECT COUNT(*) FROM command WHERE idpropriete='$ligne[idpropriete]' ");
            $cnt = $sta->fetch_assoc();
            $total  = $total + $cnt['COUNT(*)']; //compteur de cmd
            $prix_T = ($cnt['COUNT(*)'])*($ligne['prix']);
        }
        echo '<hr>';
        echo '<p>Totale des réservations: '.$total.'</p>';
        echo '<hr>';
        echo '<p>Prix total des réservation: '.$prix_T.' DA</p>';
       //  $conect->query("SELECT SUM() FROM command WHERE idpropriete='$ligne[idpropriete]' ");
        //echo '<p>Proprité qu\'à max des réservation: '.$total.'</p>';

    }
    ?>

	
</body>
    
</html>

<?php } ?>