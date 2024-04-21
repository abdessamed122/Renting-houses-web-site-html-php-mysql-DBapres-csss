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
    <style>* {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    margin-left: 20px;
    padding: 0;
    background-color:#84A7A1 ;
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
    display: block;
    width: 300px;
    height: 400px;
    border: 1px solid #ccc;
    margin: 10px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

main a:hover {
    color: #666;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

main img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

main p {
    margin: 5px 0;
}
div{
    background-color: #1585c0;
    margin-top: 0;
    margin-left: 0px;
    border-radius: 15px;
}
h1,h2{
    padding-left: 5px;
}
button{
    border-radius: 10px;
    width: 150px;
    height: 30px;
    border: none;
    color: white;

}
button:hover{
background-color:#1585c0;
}

.table{
    background-color: aqua;

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
button{
    background-color: #12356a;
}
td{
    margin: 50px;
    border-radius: 20px;
    /* width: 300px; */
    padding: 10px;
    margin-bottom: 50px;
    background-color:#1993d2b5; 
}
img{
    border-radius: 20px;
    padding: 50 50 50 50;
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
    <a href="owner.php"><button>Accueil</button></a>
    <a href="add.php"><button>Nouvelle annonce</button></a>

<div>
    <h1>Tableau de bord</h1>
    <h2>Les annonces</h2>
    
</div>
</head>
<hr>
<body>
<br><br>
<br><br>
<?php

$sql = "SELECT * FROM propriete WHERE idproprietaire='$id' ";
if ($i = $conect->query($sql)) {
    if ($i->num_rows > 0) {
        echo '<table> <tr bgcolor="LightGray">';
        $j = 1; //counteur pour table <tr>
        while ($annc = $i->fetch_assoc()) {
            echo '<td>';
            $idannc = $annc['idpropriete'];
            $sqlimg = $conect->query("SELECT * FROM image WHERE idpropriete='$idannc' ");
            
            if ($sqlimg->num_rows > 0) {//ramner l'image d'annonce
                $img = $sqlimg->fetch_assoc();
                echo '<a href="infoannc.php?idpost='.$idannc.'"><img src="'.$img['img'].'" alt="Post" height ="250px" width="250px"></a>'; //ndirha fi <a>..
                if (strlen($annc['titre']) <= 23 ) { //pour (...) aprés titre
                    echo '<a href="infoannc.php?idpost='.$idannc.'"><p>'.$annc['titre'].'</p></a>';//ndirah fi <a> + nzidah limit caractére
                }else {
                    echo '<a href="infoannc.php?idpost='.$idannc.'"><p>'.substr($annc['titre'],0,23).'...</p></a>';//ndirah fi <a> + nzidah limit caractére
                }
                echo '<p>'.$annc['prix'].'da(/nuit)</p>';
                $countsql = $conect->query("SELECT COUNT(*) FROM command WHERE idpropriete='$idannc' ");//nbr des commands
                $count = $countsql->fetch_assoc();
                echo '<h6>'.$count['COUNT(*)'].' Cmnd(s)</h6>'; 
                ?>
                <a href="editannc.php?idpost=<?php echo $idannc; ?>"><button>Modifier</button></a>
                <a href="deletannc.php?idpost=<?php echo $idannc; ?>"><button>Supprimer</button></a>

                <?php
                //button modifier , button supprumé(nzid confimation du suprission)
            }
            echo '</td>';
            
            if ($j >= 3) { //pour limiter nbr des colonne.
                echo '</tr>';
                $j = 1;
            }
            $j++;

        }
        echo '</table>';//fin table aprés ramner touts les annonce

    } else {
        echo '<h4>Aucun annonce!</h4>';
    }
    
}else {
    echo '<h4>Dzl, erreur d\'affichage!</h4>';
}

?>

</body>
</html>

<?php
}
?>