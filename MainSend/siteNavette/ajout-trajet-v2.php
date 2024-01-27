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
       
                    $lieuDep=$_REQUEST["lstLieuDep"];
                    $lieuArr=$_REQUEST["lstLieuArr"];
                    $date=$_REQUEST["lstDate"];
                    $horaire=$_REQUEST["lstHoraireDep"];
                    $identificateur=$_REQUEST["txtIdentificationNum"];        

                    $ordreSQLDep='SELECT nomLieu FROM lieu WHERE numLieu = ?';
                    // préparation de la requete
                    $prepared=$laConnexion()->prepare($ordreSQLDep);                 
                    // associe les données a une variable
                    $rpreparedDEP->bindParam(':prepSQL', $lieuDep); 
                    $rpreparedDEP->execute(["$lieuDep"]); // exec la requete
                    $LieuDepart=$rpreparedDEP->fetchAll(PDO::FETCH_ASSOC); // récupère les données 
                    var_dump($LieuDepart); // affichange simple
                    // $resultDepart=$LieuDepart["nomLieu"];  
                    


                    // $ordreSQLDep="SELECT nomLieu FROM lieu WHERE numLieu=$lieuDep";
                    // $resultDep = $laConnexion->query($ordreSQLDep);
                    // $LieuDepart=$resultDep->fetch();
                    // $resultDepart=$LieuDepart["nomLieu"];
            
                    $ordreSQLArr="SELECT nomLieu FROM lieu WHERE numLieu=$lieuArr";
                    $resultArr=$laConnexion->query($ordreSQLArr);
                    $LieuArrivee=$resultArr->fetch();
                    $resultArrivee=$LieuArrivee["nomLieu"];
                
                    $ordreSQLTraj="INSERT INTO trajet (dateTrajet, lieuDepart, lieuArrivee, horaireDepart)
                                   VALUES ('$date', '$resultDepart', '$resultArrivee', '$horaire')";
            
                    $ordreSQLRecupIdUtil="SELECT numUtil FROM utilisateur WHERE telPortable='$identificateur'";
                    $resultIdUtil=$laConnexion->query($ordreSQLRecupIdUtil);
                    $leTupleIdUtil=$resultIdUtil->fetch();
                    $IdUtil=$leTupleIdUtil["numUtil"];
           
                    // risque de sécurité / nb de trajets
                    // problème codé par les L1 il peut y avoir une insertions correcte
                    // mais une mauvaise réservation donc ça risque d'ajouter plusieurs
                    // voyage pour la même personne avec un autre numéro de téléphone

                    /*
                    on cherche si le trajet existe déja si c'est pas le cas on l'ajoute
                    sinon on ne l'ajoute pas
                    --> modifier le if
                    */
                    $nb=$laConnexion->exec($ordreSQLTraj);
                    if($nb==0){
                        echo "Il y a eu une erreur";
                    }else{
                        $idDernierTrajet = $laConnexion->lastInsertId();
                        echo "<p>votre trajet a bien été ajouté</p>";
                    }
            
                    $ordreSQLReserver="INSERT INTO reserver (numUtil, numTrajet) VALUE ($IdUtil, $idDernierTrajet)";
                    $nb2=$laConnexion->exec($ordreSQLReserver);
                    if($nb2==0){
                        echo "Oups...Il y a eu une erreur";
                    }
                ?>
            </div>
        </div>            
    </div>
</body>
</html>

        
