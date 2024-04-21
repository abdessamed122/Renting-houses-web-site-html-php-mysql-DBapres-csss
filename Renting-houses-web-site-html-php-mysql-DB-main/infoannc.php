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

if (isset($_GET['idpost'])) {
    $idp = $_GET['idpost'];
    $select = "SELECT * FROM propriete WHERE idpropriete='$idp' ";
    if ($post = $conect->query($select)) {
        $infopost = $post->fetch_assoc();

        ?>

<!doctype html>
<html>
<style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 10px;
        }
        h1 {
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        form {
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
            text-align: center;
            margin-top: 50px;
        }
    </style>
    <head>
        <title>à louer</title>
    <a href="owner.php"><button>Accueil</button></a>

    <a href="sortir.php"><button>Déconnecter</button></a>


    <h1><?php echo $infopost['titre']; ?></h1>
</head>
<hr>
<body>
    <br><br>
    <?php 
    
    $sqlimg = $conect->query("SELECT * FROM image WHERE idpropriete='$idp' ");
    echo '<table> <tr>';
    $tr = 1;
    while($img = $sqlimg->fetch_assoc()){
        echo '<td><img src="'.$img['img'].'" alt="Post"  height ="400px" width="400px">

        <br><form action="editimg.php?idpost='.$idp.'&&idimg='.$img['idimg'].'" method="POST" enctype="multipart/form-data">
        <p>|importe ici pour remplacer cette photo:(png, jpg ou jpeg)|</p>
        <input type="file" name="new_img">
        <input type="submit" name="img_edit" value="Modifier img">
        <a href="deletimg.php?idimg='.$img['idimg'].'&&idpost='.$idp.'">Supprimer img</a></td>'; 
        if ($tr >= 3) {//limiter les colonne du tableau
            $tr = 1;
            echo '</tr>';
        }
        $tr++;
    }
    echo '</form>';
echo '<table>';
echo '<hr>';
    echo '<p>prix: '.$infopost['prix'].' da(/nuit)</p>';
    echo '<p>Type du proprieté: '.$infopost['type'].'</p>';
    echo '<p>Discription: '.$infopost['discription'].'</p>';
    echo '<p>Disponibilité: '.$infopost['cas'].'</p>';
    echo '<h4>Localité:</h4>';
    echo '<p>Pay du proprieté: '.$infopost['pay_propriete'].'</p>';
    echo '<p>Wilaya du proprieté: '.$infopost['wilaya_propriete'].'</p>';
    echo '<p>Commune du proprieté: '.$infopost['commune_propriete'].'</p>';
    echo '<p>N° du proprieté: '.$infopost['num_propriete'].'</p>';
    echo '</table>';


 ?>
</body>
<footer> 
    <a href="editannc.php?idpost=<?php echo $idp; ?>"><button>Modifier</button></a>
</footer>
</html>

<?php
}else {
    echo '<h2>Dzl, erreur d\'afficher l\'annonce</h2>';
}

}
}
?>