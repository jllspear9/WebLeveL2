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
        <div class="row table-responsive ml-2">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Depart</th>
                        <th>Arrivée</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include_once("Connexion.php");
                    
                        $mail=$_REQUEST["txtMail"];
                        $mdp=$_REQUEST["mdp"];
                        $ordreSQLMonTrajet="SELECT trajet.numTrajet, utilisateur.prenomUtil, utilisateur.nomUtil, utilisateur.telPortable, trajet.dateTrajet, trajet.lieuDepart, trajet.lieuArrivee, trajet.horaireDepart 
                                            FROM trajet 
                                            JOIN reserver ON trajet.numTrajet=reserver.numTrajet 
                                            JOIN utilisateur ON reserver.numUtil=utilisateur.numUtil
                                            WHERE utilisateur.email='$mail' AND utilisateur.mdpUtil='$mdp'";
                        $resultMonTrajet=$laConnexion->query($ordreSQLMonTrajet);
                        $lesTuples=$resultMonTrajet->fetchall();
                        
                        
                        $ordreSQLVerification = "SELECT * FROM utilisateur WHERE email = :email AND mdpUtil = :mdp";
                        $requete = $laConnexion->prepare($ordreSQLVerification);
                        $requete->bindParam(':email', $mail);
                        $requete->bindParam(':mdp', $mdp);
                        $requete->execute();
                        $utilisateur = $requete->fetch();
                        
                        if($utilisateur){
                            if(empty($lesTuples)){
                                echo "Il n'y a aucun trajet ici";
                            }else{
                                foreach ($lesTuples as $tuple) {
                                    echo "<tr>";
                                    echo "<td>" . $tuple["nomUtil"] . "</td>";
                                    echo "<td>" . $tuple["prenomUtil"] . "</td>";
                                    echo "<td>" . $tuple["telPortable"] . "</td>";
                                    echo "<td>" . $tuple["dateTrajet"] . "</td>";
                                    echo "<td>" . $tuple["lieuDepart"] . "</td>";
                                    echo "<td>" . $tuple["lieuArrivee"] . "</td>";
                                    echo "<td>" . $tuple["horaireDepart"] . "</td>";
                                    echo "<td><a href='./supprimerTrajet.php?numSuppr=".$tuple["numTrajet"]."'>Supprimer</a></td>";
                                    echo "</tr>";
                                }
                            }
                        }else{
                            echo "mot de passe ou mail incorrect";
                            
                        }
                    ?>      
                </tbody>                
            </table>
        </div>            
    </div>                            
</body>
</html>
