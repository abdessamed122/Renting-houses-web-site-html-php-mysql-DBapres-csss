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

if (isset($_GET['idimg']) && $_FILES['new_img']['name'] !='') {
    $idp = $_GET['idpost'];
    $idimg = $_GET['idimg'];

    $nom = $_FILES['new_img']['name'];
    $verifie = array('png', 'jpg', 'jpeg');
    $type = strtolower(end(explode('.',$nom)));

    if (in_array($type,$verifie)) {
        $tmp_nom = $_FILES['new_img']['tmp_name'];
        $fin_nom = 'img/'.$nom;
        move_uploaded_file($tmp_nom,$fin_nom);
        $sql = "UPDATE `image` SET img='$fin_nom' WHERE idimg= '$idimg'";
        if ($conect->query($sql)) {
            header('location: infoannc.php?idpost='.$idp);
        }else {
            echo 'erreur de sauvgarde!';
        }
    }else {
       header('location: infoannc.php?idpost='.$idp);
    }
    
}

}

?>