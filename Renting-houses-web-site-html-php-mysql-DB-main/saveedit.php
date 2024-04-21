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

    if (isset($_POST['edit'])) {
        $cas =$_POST['dispo'];
        $type =$_POST['type'];
        $prix =$_POST['prix'];
        $script =$_POST['description'];
        $py =$_POST['pay'];
        $wlya =$_POST['wilaya'];
        $cmn =$_POST['commune'];
        $num =$_POST['num'];
        $ttr =$_POST['titre']; 
        
        $verifie = array('png', 'jpg', 'jpeg');
        
        
        
        if (!empty($_FILES['images']['name'][0])) { //si ajoute des photos (insertion)

          foreach ($_FILES['images']['tmp_name'] as $key => $value) {
            $nomimg = $_FILES['images']['name'][$key];
            $tmpnom = $_FILES['images']['tmp_name'][$key];
            $typeimgs = strtolower(end(explode('.',$nomimg))); //couper le nom de l'image par '.', aprés j'ai prend dernier élément ,car il contient type d'image. 
            if (in_array($typeimgs, $verifie)) {
                $finalname = 'img/'.$nomimg;
            if (!file_exists($finalname)) {
              move_uploaded_file($tmpnom, $finalname); //enrégistrer l'image dans le fishier 'img'.
            }
                $conect->query("INSERT INTO image (img, idpropriete) VALUES ('$finalname', '$idp')");
            }
         }

        }
    
    
     $modifier = "UPDATE propriete SET
      cas='$cas',type='$type', prix='$prix',
      discription='$script',pay_propriete='$py',
      wilaya_propriete='$wlya',commune_propriete='$cmn',num_propriete='$num',
      titre='$ttr' WHERE idpropriete='$idp' ";
      
      if($conect->query($modifier)){
        header('location: infoannc.php?idpost='.$idp);
      }else{
        echo 'Dzl, erreur de sauvgarde!';
      }

    } 
    
}
}
?>