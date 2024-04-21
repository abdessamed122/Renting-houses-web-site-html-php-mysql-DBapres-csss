<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    $a = 1;
    $_SESSION['$a']=$a;
    header('location: login.php');
}else{

session_destroy();
header('location: login.php');

}
?>