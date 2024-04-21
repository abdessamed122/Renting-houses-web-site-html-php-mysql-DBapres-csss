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
    
    if($conect->query("DELETE  FROM image WHERE idpropriete='$idp' ")){

        $delet = "DELETE  FROM propriete WHERE idpropriete='$idp' ";
        if($conect->query($delet)){
            header('location: annonce.php');
        }
    }
}

}
?>