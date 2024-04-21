<?php
include("connexion.php"); //connecté avec base des données.
$idannc = 18;
$sqlimg = $conect->query("SELECT * FROM propriete WHERE idpropriete='$idannc' LIMIT 10 ");
$r = $sqlimg->fetch_assoc();
echo substr($r['titre'],0,10) ,'...';

/*$nbr = 0;
$sqlimg = $conect->query("SELECT * FROM image WHERE idpropriete='$idannc' ");
echo '<table> <tr>';
    $tr = 1;
    while($img = $sqlimg->fetch_assoc()){
        echo '<img src="'.$img['img'].'" alt="Post"  height ="200px" width="200px">
        <input type="hidden" name="conteur" value="'.($nbr = $nbr+1).'"> ';
    if ($tr == 3) {//limiter les colonne du tableau
    $tr = 1;
    echo '</tr>';
    }
    $tr = $tr + 1;
    }
    $a = 0;
    while ($a <= $nbr) {
        echo '<br>'.$a.'<br>';
        $a = $a + 1;
    }*/

?>

