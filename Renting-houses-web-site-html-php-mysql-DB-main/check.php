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

if (isset($_GET['postid'])) {
    $idp = $_GET['postid'];
    $conect->query("DELETE FROM propriete WHERE idpropriete = '$idp' ");
    header('location: owner.php');

}else{
    if (isset($_SESSION['$nv'] )) {
        $nv = 0;
        $_SESSION['$nv'] = $nv;
    }

$r = $conect->query("SELECT * FROM propriete WHERE idproprietaire='$id' ");
 
while ($t = $r->fetch_assoc()) {
    $idpost = $t['idpropriete'];
    $F = $conect->query("SELECT * FROM image WHERE idpropriete='$idpost' ");
    if ($F->num_rows > 0) { //existe images
        
    }else { //n'existe aucun image.
        $conect->query("DELETE FROM propriete WHERE idpropriete = '$idpost' ");
    }

 }
 header('location: owner.php');
}

}

?>