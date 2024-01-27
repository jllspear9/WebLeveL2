<!DOCTYPE html>
<html>
<head>
    <title>Chauffeur</title>
    <meta charset="utf-8" />
    <link href="./style/style.css" rel="stylesheet" type="text/css"/>
    <link href="./style/bootstrap.min.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div class="container-fluid">
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

            <?php
                include_once("Connexion.php");
                $mail = $_REQUEST["txtMail"];
                $mdp = $_REQUEST["txtmdp"];
                
                $ordreSQLVerification = "SELECT * FROM utilisateur WHERE email = :email AND mdpUtil = :mdp";
                $requete = $laConnexion->prepare($ordreSQLVerification);
                $requete->bindParam(':email', $mail);
                $requete->bindParam(':mdp', $mdp);
                $requete->execute();
                $utilisateur = $requete->fetch();

                if ($utilisateur) {
                    $typeUtil = $utilisateur["typeUtil"];
                    if ($typeUtil == 2) {?>
            
        <form action='chauffeur-trajets.php' action='post'> 
        <div class="row ml-2 mt-2 table-responsive">
            <h3>Choisissez un trajet</h3>
            <div class="col">
                <table class="table table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Heure de départ </th>
                            <th>Lieu de départ </th>
                            <th>Lieu d'arrivée</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           <?php
                                include_once("Connexion.php");
                                    
                                $ordreSQLHor="SELECT horaireDep FROM horaire";
                                $resultatRequeteHor=$laConnexion->query($ordreSQLHor);
                                $lesTuplesHor=$resultatRequeteHor->fetchall();
                                  
                                $ordreSQLLieu="SELECT nomLieu FROM lieu";
                                $resultatRequeteLieu=$laConnexion->query($ordreSQLLieu);
                                $lesTuplesLieu=$resultatRequeteLieu->fetchall();
                                    
                                $ordreSQLDate="SELECT date FROM calendrier";
                                $resultatRequeteDate=$laConnexion->query($ordreSQLDate);
                                $lesTuplesDate=$resultatRequeteDate->fetchall();
                                    
                                $valueLieuDep=1;
                                $valueLieuArr=1;
                            ?>
                           <td>
                               <select name="lstHoraireDep">
                                   <?php
                                        foreach ($lesTuplesHor as $leTupleHor){
                                            echo "<option value='".$leTupleHor["horaireDep"]."'>".$leTupleHor["horaireDep"]."</option>";
                                        }
                                    ?>
                               </select>
                           </td>
                           
                           <td>
                                <select name="lstLieuDep">
                                    <?php
                                        foreach ($lesTuplesLieu as $leTupleLieu){
                                          echo "<option value='".$valueLieuDep."'>".$leTupleLieu["nomLieu"]."</option>";
                                          $valueLieuDep=$valueLieuDep+1;
                                        }
                                    ?>
                                </select>
                           </td>  

                            <td>
                                <select name="lstLieuArr">
                                    <?php
                                        foreach ($lesTuplesLieu as $leTupleLieu){
                                            echo "<option value='".$valueLieuArr."'>".$leTupleLieu["nomLieu"]."</option>";
                                            $valueLieuArr=$valueLieuArr+1;
                                        }
                                    ?>
                                </select>
                            </td>
                           
                            <td>
                                <select name="lstDate">
                                    <?php
                                        foreach ($lesTuplesDate as $leTupleDate){
                                            echo "<option value='".$leTupleDate["date"]."'>".$leTupleDate["date"]."</option>";
                                        }
                                    ?>
                                </select>
                            </td>   
                        </tr>
                    </tbody>
                </table>
                
                <input type='submit' value='Envoyer'/>
            </div>
            
                
        </form>
            <?php
                    exit();
                    }else{
                        echo "Vous n'êtes pas un chauffeur.";
                    }
                }else{
                    echo "Mot de passe incorrect";
                }
            ?>
        </div>
    </div>
</body>
</html>
