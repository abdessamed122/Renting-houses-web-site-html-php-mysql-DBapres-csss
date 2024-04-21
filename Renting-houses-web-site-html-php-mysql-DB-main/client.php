<?php
    session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à cette page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else {
    
include("connexion.php"); //connecté avec base des données.
$email = $_SESSION['email'];

$r = $conect->query("SELECT id_l, pre_l, nom_l FROM locataire WHERE email_l='$email'");
$id = $r->fetch_assoc();
$_SESSION['$id'] = $id['id_l']; //pour garder id.
$noml = $id['nom_l'];
$prel  = $id['pre_l'];
?>

<!doctype html>
<html>

<head>
    <!-- <style>body {
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
}</style> -->
<style>* {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    margin-left: 20px;
    padding: 0;
    background-color:#90caf9 ;
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
    <h1>Page d'accueil</h1>

    <h3><?php echo 'Bienvenue '.$noml.' '.$prel; ?></h3>
    <h3>Bénificier des bons occasions avec nous!</h3>

    <a href="historiq.php" name="cmd">Historique</a>
</head>
<hr>
<body>
<br><br>
	<?php
    $result = $conect->query("SELECT * FROM propriete ");
    if($result->num_rows > 0 ){
        echo '<table> <tr bgcolor="LightGray">';
        $tr = 0;
        while ($annc = $result->fetch_assoc()) {

            $idp = $annc['idpropriete'];
            $img = $conect->query("SELECT * FROM image WHERE idpropriete='$idp' ");
            $imag = $img->fetch_assoc();
            echo '<td><a href="clientannc.php?idpostc='.$idp.'"><img src="'.$imag['img'].'" alt="Post" height ="250px" width="250px"></a>'; //ndirha fi <a>..
            if (strlen($annc['titre']) <= 23 ) { //pour ... aprés titre
            echo '<a href="clientannc.php?idpostc='.$idp.'"><p>'.$annc['titre'].'</p></a>';//ndirah fi <a> + nzidah limit caractére
            }else {
            echo '<a href="clientannc.php?idpostc='.$idp.'"><p>'.substr($annc['titre'],0,23).'...</p></a>';//ndirah fi <a> + nzidah limit caractére
            }
            echo '<p>'.$annc['cas'].'</p>';
            echo '<p>'.$annc['prix'].' da(/nuit)</p>';
            echo '<a href="clientannc.php?idpostc='.$idp.'"><button>Réserver</button></a></td>';
            if ($tr >= 2) {
                $tr = 0;
                echo '</tr>';
            }
         $tr ++;   
        }
            
      
    }else{
        echo "Aucun annonce!";
    }
    ?>
	
</body>
    
</html>

<?php } ?>