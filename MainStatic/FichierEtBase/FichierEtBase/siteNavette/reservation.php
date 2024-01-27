<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
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
        <form action="./ajout-trajet-v2.php" method="post">
        <div class="row ml-2 mt-2 table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Heure de départ </th>
                        <th>Lieu de départ </th>
                        <th>Lieu d'arrivée </th>
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
        </div>
        <div class="row">
            <p class="mt-2 ml-4">Entrer Votre numéro de téléphone :<input type="text" name="txtIdentificationNum"/></p>
            <p class="mt-2 ml-4"><input type="submit"></p>
        </div>
        </form>
        <br><h5>Nombre de places : </h5>
        <div class="row ml-2">
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL1="SELECT COUNT(*) as nbr_trajetD1 FROM trajet WHERE dateTrajet='2023-12-05'";
                    $resultRequete1=$laConnexion->query($ordreSQL1);
                    $leTupleDate1=$resultRequete1->fetch();
                    $nbrPlaceDate1=20 - $leTupleDate1["nbr_trajetD1"];   
                    echo "<p>05/12/2023 : ".$nbrPlaceDate1."</p>";
                ?>
            </div>
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL2="SELECT COUNT(*) as nbr_trajetD2 FROM trajet WHERE dateTrajet='2023-12-07'";
                    $resultRequete2=$laConnexion->query($ordreSQL2);
                    $leTupleDate2=$resultRequete2->fetch();
                    $nbrPlaceDate2=20 - $leTupleDate2["nbr_trajetD2"];   
                    echo "<p>07/12/2023 : ".$nbrPlaceDate2."</p>";
                ?>
            </div>
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL3="SELECT COUNT(*) as nbr_trajetD3 FROM trajet WHERE dateTrajet='2023-12-12'";
                    $resultRequete3=$laConnexion->query($ordreSQL3);
                    $leTupleDate3=$resultRequete3->fetch();
                    $nbrPlaceDate3=20 - $leTupleDate3["nbr_trajetD3"];   
                    echo "<p>12/12/2023 : ".$nbrPlaceDate3."</p>";
                ?>
            </div>
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL4="SELECT COUNT(*) as nbr_trajetD4 FROM trajet WHERE dateTrajet='2023-12-14'";
                    $resultRequete4=$laConnexion->query($ordreSQL4);
                    $leTupleDate4=$resultRequete4->fetch();
                    $nbrPlaceDate4=20 - $leTupleDate4["nbr_trajetD4"];   
                    echo "<p>14/12/2023 : ".$nbrPlaceDate4."</p>";
                ?>
            </div>
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL5="SELECT COUNT(*) as nbr_trajetD5 FROM trajet WHERE dateTrajet='2023-12-19'";
                    $resultRequete5=$laConnexion->query($ordreSQL5);
                    $leTupleDate5=$resultRequete5->fetch();
                    $nbrPlaceDate5=20 - $leTupleDate5["nbr_trajetD5"];   
                    echo "<p>19/12/2023 : ".$nbrPlaceDate5."</p>";
                ?>
            </div>
            
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php 
                    $ordreSQL6="SELECT COUNT(*) as nbr_trajetD6 FROM trajet WHERE dateTrajet='2023-12-21'";
                    $resultRequete6=$laConnexion->query($ordreSQL6);
                    $leTupleDate6=$resultRequete6->fetch();
                    $nbrPlaceDate6=20 - $leTupleDate6["nbr_trajetD6"];   
                    echo "<p>21/12/2023 : ".$nbrPlaceDate6."</p>";
                ?>
            </div>
        </div>
    </div>        
</body>
</html>
