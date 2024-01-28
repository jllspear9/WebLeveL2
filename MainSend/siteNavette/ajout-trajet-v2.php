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
                    $numTel=$_REQUEST["txtIdentificationNum"];        
                    //informations texte utilisateur (nécessite des requetes préparées)
                    $userAddr=$_REQUEST["txtuseraddr"];
                    $userpwd=$_REQUEST["txtpwd"];

                    // vérification si compte présent avec préparation
                    $rSQL = "SELECT numUtil FROM utilisateur WHERE email = :SQLmail AND pwdUtil = :SQLpwd";
                    $requete = $laConnexion->prepare($rSQL);
                    $requete->bindParam(':SQLmail', $userAddr);
                    $requete->bindParam(':SQLpwd', $userpwd);                    
                    $requete->execute();
                    $stmt = $requete->fetch();
                    $resultNom=$stmt["prenomUtil"]; // le prenom doit pas être null
                    if($resultNom != NULL){
                        // on vérifie si les données n'ont pas déja étés saisie


                        $ordreSQLTraj="INSERT INTO trajet (dateTrajet, lieuDepart, lieuArrivee, horaireDepart)
                                VALUES ('$date', '$lieuDep', '$lieuArr', '$horaire')"; 
                        $nb=$laConnexion->exec($ordreSQLTraj);
                        if($nb==0){
                            echo "Il y a eu une erreur dans l'insertions des données";
                        }else{
                            $idDernierTrajet = $laConnexion->lastInsertId();
                            echo "<p>votre trajet a bien été ajouté</p>";
                        }
                        // on récupère l'id de la personne en utilisant ses coordonées
                        $ordreSQLRecupIdUtil="SELECT numUtil FROM utilisateur WHERE telPortable='$numTel'";
                        $resultIdUtil=$laConnexion->query($ordreSQLRecupIdUtil);
                        $leTupleIdUtil=$resultIdUtil->fetch();
                        $IdUtil=$leTupleIdUtil["numUtil"];          

                        $ordreSQLReserver="INSERT INTO reserver (numUtil, numTrajet) VALUE ($IdUtil, $idDernierTrajet)";
                        $nb2=$laConnexion->exec($ordreSQLReserver);
                        if($nb2==0){
                            echo "les coordonnées saisies n'existent pas vous devriez créer un compte";
                        }                        


                    } else {
                        echo "<p>le compte en question n'existe pas</p>";
                    }                        

           


                ?>
            </div>
        </div>            
    </div>
</body>
</html>

        
