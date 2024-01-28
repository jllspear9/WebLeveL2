<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>horaires de la navette</title>
    <link href="./style/style.css" rel="stylesheet" type="text/css"/>
    <link href="./style/bootstrap.min.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div class="conteiner-fluid">
        <div class="row" id="navbar">
            <div class="col-xs-12 col-md-4 col-lg-2 mt-2">
                <a href='./index.htm' class="mt-2"><img src="./images/logoUPPA-RepFr.png" alt="Logo UPPA" class="logo ml-4"/></a>
            </div>
                
            <div class="col-xs-12 col-md-4 col-lg-2">
                <a href="./CreerCompte.html" class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Créer un compte</a>
            </div>
                    
            <div class="col-xs-12 col-md-4 col-lg-2">
                <a href="./identification.php" class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Mon trajet</a>
            </div>
                
            <div class="col-xs-12 col-md-4 col-lg-2">
                <a href='./reservation.php' class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Réservation</a>
            </div>            
                
            <div class="col-xs-12 col-md-4 col-lg-2">
                <a href='./identificationChauffeur.php' class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Chauffeur</a>
            </div>
                
            <div class="col-xs-12 col-md-4 col-lg-2">
                <a href='https://www.univ-pau.fr/fr/index.html#accesDirects' class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Site de l'UPPA</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                   include_once("Connexion.php");

                   $lieuDep = $_REQUEST["lstLieuDep"];
                   $lieuArr = $_REQUEST["lstLieuArr"];
                   $date = $_REQUEST["lstDate"];
                   $horaire = $_REQUEST["lstHoraireDep"];
                   $identificateur = $_REQUEST["txtIdentificationNum"];
                   
                   try {
                       $laConnexion->beginTransaction();
                   // Préparation de la requête pour récupérer le nom du lieu de départ
                   $ordreSQLDep = "SELECT nomLieu FROM lieu WHERE numLieu = :lieuDep";
                   $requeteDep = $laConnexion->prepare($ordreSQLDep);
                   $requeteDep->bindValue(':lieuDep', $lieuDep, PDO::PARAM_INT);
                   $requeteDep->execute();
                   $resultDep = $requeteDep->fetch();
                   $resultDepart = $resultDep["nomLieu"];
                   
                   // Préparation de la requête pour récupérer le nom du lieu d'arrivée
                   $ordreSQLArr = "SELECT nomLieu FROM lieu WHERE numLieu = :lieuArr";
                   $requeteArr = $laConnexion->prepare($ordreSQLArr);
                   $requeteArr->bindValue(':lieuArr', $lieuArr, PDO::PARAM_INT);
                   $requeteArr->execute();
                   $resultArr = $requeteArr->fetch();
                   $resultArrivee = $resultArr["nomLieu"];
                   
                   // Préparation de la requête pour insérer un trajet
                   $ordreSQLTraj = "INSERT INTO trajet (dateTrajet, lieuDepart, lieuArrivee, horaireDepart)
                                   VALUES (:date, :resultDepart, :resultArrivee, :horaire)";
                   $requeteTraj = $laConnexion->prepare($ordreSQLTraj);
                   $requeteTraj->bindValue(':date', $date, PDO::PARAM_STR);
                   $requeteTraj->bindValue(':resultDepart', $resultDepart, PDO::PARAM_STR);
                   $requeteTraj->bindValue(':resultArrivee', $resultArrivee, PDO::PARAM_STR);
                   $requeteTraj->bindValue(':horaire', $horaire, PDO::PARAM_STR);
                   $requeteTraj->execute();
                   
                   // Récupération de l'id du dernier trajet
                   $idDernierTrajet = $laConnexion->lastInsertId();
                   echo "<p>Votre trajet a bien été ajouté</p>";
                   
                   // Préparation de la requête pour récupérer l'id de l'utilisateur
                   $ordreSQLRecupIdUtil = "SELECT numUtil FROM utilisateur WHERE telPortable = :identificateur";
                   $requeteIdUtil = $laConnexion->prepare($ordreSQLRecupIdUtil);
                   $requeteIdUtil->bindValue(':identificateur', $identificateur, PDO::PARAM_STR);
                   $requeteIdUtil->execute();
                   $leTupleIdUtil = $requeteIdUtil->fetch();
                   $IdUtil = $leTupleIdUtil["numUtil"];
                   
                   // Préparation de la requête pour réserver le trajet
                   $ordreSQLReserver = "INSERT INTO reserver (numUtil, numTrajet) VALUES (:IdUtil, :idDernierTrajet)";
                   $requeteReserver = $laConnexion->prepare($ordreSQLReserver);
                   $requeteReserver->bindValue(':IdUtil', $IdUtil, PDO::PARAM_INT);
                   $requeteReserver->bindValue(':idDernierTrajet', $idDernierTrajet, PDO::PARAM_INT);
                   $requeteReserver->execute();
          
              
                       $laConnexion->commit();

                       echo "<p>Votre trajet et votre réservation ont bien été enregistrés</p>";
                   } catch (PDOException $e) {
                       $laConnexion->rollBack();
                       echo "Oups... Il y a eu une erreur : " . $e->getMessage();
                   }
                ?>
            </div>
        </div>            
    </div>
</body>
</html>

        
