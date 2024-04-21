<?php
    session_start();
 if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à cette page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else { 

    if (isset($_GET['postid'])) {
        include("connexion.php"); //connecté avec base des données.
        $email = $_SESSION['email'];
        $id = $_SESSION['$id'];
        
        $idpost = $_GET['postid'];

     $nv = 1; //me aider dans check.php, pour verefier si l'announce inculde une image ou non.
     $_SESSION['$nv'] = $nv;
    
    
    ?>

<!DOCTYPE html>
<html>
    <style></style>
<head>
    <h1>Nouvelle location</h1>
</head>
    
<form action="saveimg.php?postid=<?php echo $idpost; ?>" method="POST" enctype="multipart/form-data">

   <h4>Notice: Obtenez vos photos en une seule fois.</h4>
   <input type="file" name="img[]" multiple required>
    <br><br><input type="submit" name="addimg" value="Sauvgarder"> 

</form>
<a href="check.php?postid=<?php echo $idpost; ?>"><button>Annuller</button></a>

<body>
</body>

</html>

    <?php }else {
        echo '<script>alert("Respectez vous les étapes SVP!");</script>'; //modiffiha zid session kima "connectez vous d'abord,svp!"
        header('location: owner.php');
    }
}
//enctype="multipart/form-data" ==> car on a type "file" dans la form.

 ?>