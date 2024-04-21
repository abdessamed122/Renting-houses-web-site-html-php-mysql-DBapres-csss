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

if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo '<script>alert("'.$_SESSION['msg'].'");</script>';
    unset($_SESSION['msg']);
}

if (isset($_GET['idpostc'])) {
    $idp = $_GET['idpostc'];

    $select = "SELECT * FROM propriete WHERE idpropriete='$idp' ";
    if ($post = $conect->query($select)) {
        $infopost = $post->fetch_assoc();

?>

<!doctype html>
<html>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    margin-left: 20px;
    padding: 0;
    background-color: #84A7A1;
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
.annuler{
    color: black;
    border: 1px;
    border-radius: 5px;
    padding: 5px 10px;
    margin-top: 10px;
    cursor: pointer;
}
.annuler:hover{
    background-color: #00000024;


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
 input{
    color: black;
    border: 1px;
    border-radius: 5px;
    padding: 5px 10px;
    margin-top: 10px;
    cursor: pointer;
}
 input:hover{
    background-color: #00000024;


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
}


.place {
    margin-left: 5px;
    margin-right: 5px;
    width: 100px;
}

.titre {
    width: 250px;
    height: 25px;
}
img{
    border-radius: 20px;
}
</style>
    
    <head>
     
        <title>à louer</title>
        
        <a href="sortir.php"><button>Déconnecter</button></a>
        
        <h1><?php echo $infopost['titre']; ?></h1>
        
        <a href="client.php"><button>Accueil</button></a>
</head>
<hr>
<body>
  
 <table>
     <p>Pour louer saisir votre coordonnées ici:</p>    
     <form action="savecmd.php?idpostc=<?php echo $idp; ?>" method="post">
        
     <label>Date arrivée*</label><input type="date" name="date" placeholder="">
     <br><input type="number" name="tel_1" required placeholder="Votre numéro*">
     <br><input type="number" name="tel_2" placeholder="deuxiéme numéro">
     <br><input type="number" name="duree" placeholder="durée de location(/jour)">
     <br><input type="submit" name = "location" value="Réserver">
     
    </form>
</table>
        <br><br>

    <?php 
    $sqlimg = $conect->query("SELECT * FROM image WHERE idpropriete='$idp' ");
    echo '<table> <tr>';
    $tr = 1;
    while($img = $sqlimg->fetch_assoc()){
        echo '<td><img src="'.$img['img'].'" alt="Post"  height ="400px" width="400px"></td>'; 
    if ($tr >= 3) {//limiter les colonne du tableau
    $tr = 1;
    echo '</tr>';
    }
    $tr++;
}
echo '<table>';
echo '<p>Disponibilité: '.$infopost['cas'].'</p>';
echo '<hr>';
echo '<p>prix: '.$infopost['prix'].' da(/nuit)</p>';
    echo '<p>Type du proprieté: '.$infopost['type'].'</p>';
    echo '<p>Discription: '.$infopost['discription'].'</p>';
    //localisation
    echo '<h4>Localité:</h4>';
    echo '<table><tr>';
    echo '<td>'.$infopost['pay_propriete'].'</td>';
    echo '<td> ,'.$infopost['wilaya_propriete'].'</td>';
    echo '<td> ,'.$infopost['commune_propriete'].'</td>';
    echo '<td> ,N°:'.$infopost['num_propriete'].'</td></tr>';
    echo '</table>';
 ?>
 
</body>
</html>

<?php
}else {
    echo '<h2>Dzl, erreur d\'afficher l\'annonce</h2>';
}

}
}
?>