<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>liste trajet pour chauffeur</title>
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
            
        <div class='row ml-4'>
            <?php
                include_once("./Connexion.php");
                $horaireDep=$_REQUEST["lstHoraireDep"];
                $lieuDep=$_REQUEST["lstLieuDep"];
                $lieuArr=$_REQUEST["lstLieuArr"];
                $date=$_REQUEST["lstDate"];
                
                $ordreSQLRecupTrajArr="SELECT nomLieu FROM lieu
                                       WHERE numLieu=$lieuArr";
                $resultRequeteTrajArr=$laConnexion->query("$ordreSQLRecupTrajArr");
                $leTupleTrajArr=$resultRequeteTrajArr->fetch();
                $lieuArr=$leTupleTrajArr["nomLieu"];
                        
                $ordreSQLRecupTrajDep="SELECT nomLieu FROM lieu
                                        WHERE numLieu=$lieuDep";
                $resultRequeteTrajDep=$laConnexion->query("$ordreSQLRecupTrajDep");
                $leTupleTrajDep=$resultRequeteTrajDep->fetch();
                $lieuDep=$leTupleTrajDep["nomLieu"];
            ?>
                <div class='col-lg-3'>
                    <?php echo "<p>Départ : ".$lieuDep."</p>";?>
                </div>
        
                <div class='col-lg-3'>
                    <?php echo "<p>Arrivé : ".$lieuArr."</p>";?>
                </div>
                
                <div class='col-lg-3'>
                    <?php echo "<p>Date : ".$date."</p>";?>
                </div>
            
                <div class='col-lg-3'>
                    <?php echo "<p>Horaire de départ : ".$horaireDep."</p>";?>
                </div>
                        
                <?php
                    $ordreSQL="SELECT trajet.dateTrajet, trajet.horaireDepart, trajet.lieuDepart, trajet.lieuArrivee, utilisateur.nomUtil, utilisateur.prenomUtil
                               FROM trajet
                               JOIN reserver ON trajet.numTrajet=reserver.numTrajet
                               JOIN utilisateur ON reserver.numUtil=utilisateur.numUtil
                               WHERE trajet.dateTrajet='$date' 
                               AND trajet.horaireDepart='$horaireDep'
                               AND trajet.lieuDepart='$lieuDep'
                               AND trajet.lieuArrivee='$lieuArr'";
                    $resultRequete=$laConnexion->query("$ordreSQL");
                    $lesTuples=$resultRequete->fetchall();        
                ?>
        </div>
            
        <div class='row ml-4 table-responsive'>
            <table class="table table-hover table-sm">
                <thead class='thead-light'>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                </thead>
                <tbody>            
                    <?php
                        if(empty($lesTuples)){
                            echo "<p>Il y a personne sur ce trajet</p>";
                            exit();
                        }else{
                            foreach($lesTuples as $leTuple){
                                echo "<tr>";
                                echo "<td>".$leTuple["nomUtil"]."</td>";
                                echo "<td>".$leTuple["prenomUtil"]."</td>";
                                echo "</tr>";
                            }
                        }
                                
                    ?>
                </tbody>
            </table>     
        </div>
    </div>
</body>
</html>
