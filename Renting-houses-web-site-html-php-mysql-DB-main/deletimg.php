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


if (isset($_GET['idpost']) && isset($_GET['idimg'])) {
    $idp = $_GET['idpost'];
    $idimg = $_GET['idimg'];

    $count = $conect->query("SELECT COUNT(*) FROM image WHERE idpropriete='$idp' ");
    $cnt = $count->fetch_assoc();

    if ($cnt['COUNT(*)'] >= 2) {
        $sqlnom = $conect->query("SELECT * FROM image WHERE idimg='$idimg' ");
        $nom = $sqlnom->fetch_assoc();
        unlink('img/'.$nom['img']);

    $conect->query("DELETE FROM image WHERE idimg='$idimg' ");

    header('location: infoannc.php?idpost='.$idp);
}else {
    header('location: infoannc.php?idpost='.$idp);
}

}
}
?>