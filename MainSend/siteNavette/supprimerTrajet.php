<?php

include_once("Connexion.php");

$leNumASuppr = $_REQUEST['numSuppr'];

try {
    // Début de la transaction la méthode beginTransaction() permet de commencer une transaction dans une base de données
    $laConnexion->beginTransaction();

    // Préparation de la requête pour la suppression des réservations associées au trajet
    $ordresqlRes = "DELETE FROM reserver WHERE numTrajet = :leNumASuppr";
    $requeteRes = $laConnexion->prepare($ordresqlRes);
    $requeteRes->bindValue(':leNumASuppr', $leNumASuppr, PDO::PARAM_INT);
    $requeteRes->execute();

    // Préparation de la requête pour la suppression du trajet
    $ordresqlTraj = "DELETE FROM trajet WHERE numTrajet = :leNumASuppr";
    $requeteTraj = $laConnexion->prepare($ordresqlTraj);
    $requeteTraj->bindValue(':leNumASuppr', $leNumASuppr, PDO::PARAM_INT);
    $requeteTraj->execute();

    // Validation de la transaction
    $laConnexion->commit();

    echo "<h1>Suppression réussie</h1>";
    ?><a href="./index.htm">Revenir à l'accueil</a><?php
} catch (PDOException $e) {
    // En cas d'erreur, annulation de la transaction
    $laConnexion->rollBack();
    echo "<h1>Echec de la suppression</h1>";
    echo $e->getMessage();
}
?>
