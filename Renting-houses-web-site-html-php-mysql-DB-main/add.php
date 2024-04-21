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

<!DOCTYPE html>
<html>
<head>
    <style>
    body {
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
</style>
    <h1>Nouvelle location</h1>
</head>
    
<form action="save.php" method="POST">
    <input type="text" name="titre" required placeholder="Titre du projet (max 50caractère)" class="titre">
    <br> 
    <p>Selectionné type du propriété:</p>
    <select name="type" required>
        <option value="">--type--</option>
        <option value="chambre">Chambre</option>
        <option value="studio">Studio</option>
        <option value="maison">Maison</option>
        <option value="battiment">Bâttiment</option>
        <option value="habitations mobiles">Habitations mobiles</option>
    </select><br> <br>
    <input type="text" name="description" required placeholder="Discription du projet"> <br>
    <br>
    <input type="number" name="prix" required placeholder="Prix par nuit (DA)">
    <p>Localité du propriété:</p>
    <input type="text" name="pay" required placeholder="Pay" class="place">
    <input type="text" name="wilaya" required placeholder="Wilaya" class="place">
    <input type="text" name="commune" required placeholder="Commune" class="place">
    <input type="number" name="num" required placeholder="Numéro" class="place">
    <br><br>
    <p>Disponibilité:</p>
    <select name="dispo" required>
        <option value=""></option>
        <option value="disponible">Disponible</option>
        <option value="non disponible">Non disponible</option>
    </select>
    <br>
    <input type="submit" name="add" value="Sauvgarder"> 
    <a href="owner.php"><button class="annuler">Annuller</button></a>

    <h4>...Apres, vous ajouterez des photos de la propriété</h4>
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

<?php } ?>