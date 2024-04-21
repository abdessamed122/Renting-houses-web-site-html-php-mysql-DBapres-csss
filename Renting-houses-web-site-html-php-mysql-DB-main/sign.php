<?php

session_start();
include("connexion.php"); //connecté avec base des données.


if (isset($_POST['submit'])) {
    $genre = $_POST['genre'];
    $pre = $_POST['pre'];
    $nom = $_POST['nom'];
    $num = $_POST['num'];
    $email = $_POST['email'];
    $pay = $_POST['pay'];
    $wilaya = $_POST['wilaya'];
    $commune = $_POST['commune'];
    $password = $_POST['mdp'];
    $cpassword = $_POST['mdp_confirmation'];

    if ($genre == "Locataire") {
        
        $result1 = $conect->query("SELECT * FROM locataire WHERE email_l = '$email' ");
        $result2 = $conect->query("SELECT * FROM proprietaires WHERE email_p = '$email' ");

        if (($result1->num_rows  > 0) || ($result2->num_rows > 0)) {
            echo "<span> Email existe déja.  </span>"; //مديتش رقم الهاتف لان ممكن يحل بايمايل مختلف
        } elseif ($password != $cpassword && $password != "") { //mdp == non vide ,et = à confirmation_mdp
            echo "<span> Vérifié votre mot de passe.  </span>";
            
        }else{
            $insert_l = "INSERT INTO locataire (pre_l, nom_l, num_l, email_l, pay_l, wilaya_l, commune_l, mdp_l) 
                   VALUES 
                   ('$pre', '$nom', '$num', '$email', '$pay', '$wilaya', '$commune', '$password')";
        $conect->query($insert_l);
        $_SESSION['msg'] = "Compte crée.";
        header('location: login.php');
    }
}elseif ($genre == "Proprietaire") {
        
    $result1 = $conect->query("SELECT * FROM locataire WHERE email_l = '$email' ");
    $result2 = $conect->query("SELECT * FROM proprietaires WHERE email_p = '$email' ");

    if (($result1->num_rows  > 0) || ($result2->num_rows > 0)) {
        echo "<span> Email existe déja.  </span>";  //مديتش رقم الهاتف لان ممكن يحل بايمايل مختلف
    } elseif ($password != $cpassword && $password != "") { //mdp == non vide ,et = à confirmation_mdp
        echo "<span> Vérifié votre mot de passe.  </span>";
        
    }else{
        $insert = "INSERT INTO proprietaires (pre_p, nom_p, num_p, email_p, pay_p, wilaya_p, commune_p, mdp_p) 
               VALUES 
               ('$pre', '$nom', '$num', '$email', '$pay', '$wilaya', '$commune', '$password')";
    $conect->query($insert);
    $_SESSION['msg'] = "Compte crée.";
    header('location: login.php');
}
}

}

?>


<!DOCTYPE html>
<html>

    <body>
        <form action="" method="POST">
            
            <!-- *==> required -->
            *Votre cas:
            <select name="genre" required >
                <option value="">  </option>
                <option value="Locataire"> Locataire </option>
                <option value="Proprietaire"> Propriétaire </option>
            </select>
            <br>
            <input class="mdf" type="text" name="nom" required placeholder="Votre nom*">
            <br>
            <input class="mdf" type="text" name="pre" required placeholder="Votre prénom*">
            <br>
            <input class="mdf" type="tel" name="num" required placeholder="Votre numéro*">
            <br>
            <input class="mdf" type="email" name="email" required placeholder="Email*">
            <br >
            <input class="mdf" type="text" name="pay" required placeholder="Votre paye*">
            <br >
            <input class="mdf" type="text" name="wilaya" required placeholder="Votre wilaya*">
            <br >
            <input class="mdf" type="text" name="commune" required placeholder="Votre commune*">
            <br >
            <input class="mdf" type="password" name="mdp" required placeholder="Mot de passe*">
            <br>
            <input class="mdf" type="password" name="mdp_confirmation" required placeholder="Confirme Mot de passe*">
            <br> <br>
            <input  type="submit" id="sub" name="submit" value=" Créer un compte ">
            <p><a href="login.php">J'ai un compte</a></p>

        </form>
        <style>

            .copy{font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                display: flex;
                justify-content: end;
                text-align:end;
            }
            </style>
        <p class="copy">&copy;ABDESSAMED_AHMED</p>
    </body>
</html>