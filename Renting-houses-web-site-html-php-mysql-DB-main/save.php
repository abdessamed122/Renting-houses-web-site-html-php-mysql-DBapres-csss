<?php
    session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à cette page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else {
    
    if (isset($_POST['add'])) {
        include("connexion.php"); //connecté avec base des données.
        
     $email = $_SESSION['email'];
     $id = $_SESSION['$id'];

     $cas = $_POST['dispo'];
     $type = $_POST['type'];
     $prix = $_POST['prix'];
     $desc = $_POST['description'];
     $pay = $_POST['pay'];
     $wilaya = $_POST['wilaya'];
     $commune = $_POST['commune'];
     $num = $_POST['num'];
     $titre = $_POST['titre'];

     $insert = "INSERT INTO propriete (cas,	type, prix,	discription, pay_propriete,	wilaya_propriete, commune_propriete, num_propriete,	idproprietaire,	titre) 
               VALUES
               ('$cas', '$type', '$prix', '$desc', '$pay', '$wilaya', '$commune', '$num', '$id', '$titre')";
     $conect->query($insert);
     
     
      if ($conect->query($insert) === TRUE) {
        $idpost = $conect->insert_id; //pour garder id du dernier post,==> besoin en inserer les images.
        header('location: img.php?postid='.$idpost);
    }
     
     

    }
}
?>