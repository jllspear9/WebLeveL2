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
                    // données des formulaires liste déroulante (ne nécessite pas de prépapration sql)
                    $lieuDep=$_REQUEST["lstLieuDep"];
                    $lieuArr=$_REQUEST["lstLieuArr"];
                    $date=$_REQUEST["lstDate"];
                    $horaire=$_REQUEST["lstHoraireDep"];      
                    //informations texte utilisateur (nécessite des requetes préparées)
                    $userAddr=$_REQUEST["txtuseraddr"];
                    $userpwd=$_REQUEST["txtpwd"];

                    // vérification si le compte est présent avec une préparation
                    $rSQL = "SELECT numUtil FROM utilisateur WHERE email = :SQLmail AND mdpUtil = :SQLpwd";
                    $requete = $laConnexion->prepare($rSQL);
                    $requete->bindParam(':SQLmail', $userAddr);
                    $requete->bindParam(':SQLpwd', $userpwd);                    
                    $requete->execute();
                    $stmt = $requete->fetch();
                    $resultNum=$stmt["numUtil"]; // l'id doit pas être null

                    if($resultNum != NULL){
                        // on vérifie si les données n'ont pas déja étés saisie 
                        // préparation déja faite
                        // on doit passer par la table reserver pour recupérer le numéro du trajet 
                        // 'numTrajet' a cause des contraintes d'intégrités puis on cherche dans la table
                        // trajet

                        // attention il faut rajouter des select si on rajoute des tables
                        // attention il faut rajouter beaucoup de lignes si on 
                        // rajoute une heure d'arrivée a la table trajet
                        $verifUnique="SELECT dateTrajet, lieuDepart, lieuArrivee, horaireDepart, horaireArrivee FROM utilisateur 
                        INNER JOIN reserver ON utilisateur.numUtil = reserver.numUtil 
                        INNER JOIN trajet ON reserver.numTrajet = reserver.numTrajet
                        WHERE utilisateur.numUtil=$resultNum AND (trajet.horaireDepart = $horaire)";
                        
                        $rowVerifUnique=$laConnexion->query($verifUnique);


                        echo "rowverifunique = $rowVerifUnique<br>rsql $resultNum";
                        if ($rowVerifUnique==0){
                            $ordreSQLTraj="INSERT INTO trajet (dateTrajet, lieuDepart, lieuArrivee, horaireDepart)
                                    VALUES ('$date', '$lieuDep', '$lieuArr', '$horaire')"; 
                            $nb=$laConnexion->exec($ordreSQLTraj);
                            if($nb==0){
                                echo "Il y a eu une erreur dans l'insertions des données";
                            }else{
                                $idDernierTrajet = $laConnexion->lastInsertId();
                                echo "<p>votre trajet a bien été ajouté</p>";
                            }        
                            $ordreSQLReserver="INSERT INTO reserver (numUtil, numTrajet) VALUE ($resultNum, $idDernierTrajet)";
                            $laConnexion->exec($ordreSQLReserver);  
                        } else { // explicit
                            echo "<p>vous ne pouvez pas choisir deux trajets au même moment</p>";
                       
                        }
                    } else {
                        echo "<p>le compte en question n'existe pas</p>";
                    }                        




                ?>
                <script>
                    console.log(<?php echo $rowVerifUnique ?>)
                </script>
            </div>       
        </div>            
    </div>
</body>
</html>

        
