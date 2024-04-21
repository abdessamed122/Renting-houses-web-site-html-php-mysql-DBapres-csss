<?php
    session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à cette page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else {
    
include("connexion.php"); //connecté avec base des données.
$email = $_SESSION['email'];
$id = $_SESSION['$id'];

?>

<!doctype html>
<html>
    
    <head>
        <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

header {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

header h1 {
    margin: 0;
}

header a {
    color: #fff;
    text-decoration: none;
}

main {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 20px;
}

main a {
    text-decoration: none;
    color: #333;
}

main a:hover {
    color: #666;
}

main img {
    margin-bottom: 10px;
}

main p {
    margin: 5px 0;
}

main button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 5px 10px;
    margin-top: 10px;
    cursor: pointer;
}

main button:hover {
    background-color: #666;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}</style>
        <title>à louer</title>
        
        <a href="sortir.php"><button>Déconnecter</button></a>
        
        <h1>Historique de location</h1>
        
        <a href="client.php"><button>Accueil</button></a>
</head>
<hr>
<body>
  
<?php
$sql = $conect->query("SELECT * FROM command WHERE id_l='$id' ");
while ($cmd = $sql->fetch_assoc()) {
    $idannc = $cmd['idpropriete'];
    $annc = $conect->query("SELECT * FROM propriete WHERE idpropriete='$idannc' ");//besoin au lien d'annonce
    $post = $annc->fetch_assoc();

    echo '<table><tr bgcolor="LightGray"><td>
        <p>Id commande: '.$cmd['idcmd'].'</p>
        <p>Prix: '.$post['prix'].' DA(/nuit)</p>
        <p>Date arrivée: '.$cmd['date_depart'].'</p>
        <p>Numéro de téléphone: '.$cmd['tel1'].' - '.$cmd['tel2'].'</p>';
        if (strlen($post['titre']) <= 23) {
            echo '<p>Lien d\'annonce: <a href="clientannc.php?idpostc='.$post['idpropriete'].'">'.$post['titre'].'</a></p>';
        }else {
            echo '<p>Lien d\'annonce: <a href="clientannc.php?idpostc='.$post['idpropriete'].'">'.substr($post['titre'], 0, 23).'...</a></p>';
        }
        echo '</td></tr></table><hr>';
        
}

 ?>
</body>
</html>

<?php
}
?>