<?php

include_once("Connexion.php");

$leNumASuppr = $_REQUEST['numSuppr'];

$ordresqlTraj = "DELETE FROM trajet WHERE numTrajet = $leNumASuppr";
$ordresqlRes="DELETE FROM reserver WHERE numTrajet=$leNumASuppr";

$nb2 = $laConnexion->exec($ordresqlRes);

$nb1 = $laConnexion->exec($ordresqlTraj);
if($nb1==0 or $nb2==0){
    echo"<h1>Echec de la suppression</h1>";
    echo $ordresqlTraj;
    echo $ordresqlRes;
}else{
    echo"<h1>Suppression réussie</h1>";
    ?><a href="./index.htm">Revenir à l'acceuil</a>
    <?php
}
?>