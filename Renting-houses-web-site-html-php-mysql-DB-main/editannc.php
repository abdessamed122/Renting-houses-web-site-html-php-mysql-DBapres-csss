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

<!DOCTYPE html>
<html>
<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
    margin-left: 20px;
    margin-right: 20px;
    padding: 0;
    background-color:#84A7A1 ;
}
    h1 {
        text-align: center;
    }
    h5 {
        text-align: center;
        color: red;
    }
    form {
        width: 50%;
        margin: 0 auto;
    }
    table {
        width: 100%;
    }
    input[type="text"], input[type="number"], select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    a {
        text-decoration: none;
        color: #000;
    }
    .edit,button {
            margin-right: 10px;
            padding: 5px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            background-color:#1585c0;

            cursor: pointer;
        }
       .edit, button:hover{
background-color:#1585c0;
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
</style>
<head>
    <style></style>
    <title>Edit announce</title>
    <h1>Editeur</h1>
<h5>Alerte: Si un fichier défferent des type recomendée, l'image va modifera pas.</h5>

</head>
    
<?php
    
    echo '<form action="saveedit.php?idpost='.$idp.'" method="POST" enctype="multipart/form-data">
    <table><hr>';

    echo '<h4>Ajoute des photos:(png, jpg ou jpeg)</h4> 
    <input type="file" name="images[]" multiple>';//si besoin d'ajouter des photos
?>
    <br><br>
    <input type="text" name="titre" required placeholder="Titre du projet (max 50caractère)" class="titre" value="<?php echo $infopost['titre'];?>">
    <br>
    <p>type du propriété:</p>
    <select name="type" required>
        <option value="<?php echo $infopost['type'];?>"><?php echo $infopost['type'].' (selectinné)';?></option>
        <option value="chambre">Chambre</option>
        <option value="studio">Studio</option>
        <option value="maison">Maison</option>
        <option value="battiment">Bâttiment</option>
        <option value="habitations mobiles">Habitations mobiles</option>
    </select><br> <br>
    <input type="text" name="description" required placeholder="Discription du projet" value="<?php echo $infopost['discription'];?>"> <br>
    <br>
    <input type="number" name="prix" required placeholder="Prix par nuit (DA)" value="<?php echo $infopost['prix'];?>">
    <p>Localité du propriété:</p>
    <input type="text" name="pay" required placeholder="Pay" class="place" value="<?php echo $infopost['pay_propriete'];?>">
    <input type="text" name="wilaya" required placeholder="Wilaya" class="place" value="<?php echo $infopost['wilaya_propriete'];?>">
    <input type="text" name="commune" required placeholder="Commune" class="place" value="<?php echo $infopost['commune_propriete'];?>">
    <input type="number" name="num" required placeholder="Numéro" class="place" value="<?php echo $infopost['num_propriete'];?>">
    <br><br>
    <p>Disponibilité:</p>
    <select name="dispo" required>
        <option value="<?php echo $infopost['cas'];?>"><?php echo $infopost['cas'].' Selectionné';?></option>
        <option value="disponible">Disponible</option>
        <option value="non disponible">Non disponible</option>
    </select>
    <br><br>
    <input class="edit" name="edit" value="Sauvgarder">
<a href="infoannc.php?idpost=<?php echo $idp;?>"><button>Annuller</button></a>
</table>

</form>

<style>
.place{
    margin-left: 5px;
    margin-right: 5px;
    width: 100px;
}
.titre{
    width: 250px;
    height: 25px;
}
</style>

<body>
</body>

</html>

<?php
}else {
    echo '<h2>Dzl, erreur d\'afficher l\'annonce</h2>';
}

}
}
?>