<!DOCTYPE html>
<html>
<head>
	<title>Calcul RFM</title>
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
                <a href='https://www.univ-pau.fr/fr/index.html#accesDirects' class="btn btn-secondary rounded-pill px-3 mt-2" role="button">Site de l'UPPA</a>
            </div>
        </div>
    
        <div class="row-fluid">
            <h3> Création de votre compte </h3>
        </div>
            
        <?php
            include_once("Connexion.php");
        
            $id=$_REQUEST["txtId"];
            $mdp=$_REQUEST["txtMDP"];
            $nom=$_REQUEST["txtNom"];
            $prenom=$_REQUEST["txtPrenom"];
            $tel=$_REQUEST["txtTel"];
            $email=$_REQUEST["txtMail"];
            $typeUtil=$_REQUEST["typeUtil"];
            
            $ordreSQL="INSERT INTO utilisateur (loginUtil, mdpUtil, nomUtil, prenomUtil, telPortable, email, typeUtil) 
                       VALUES('$id', '$mdp', '$nom', '$prenom', '$tel', '$email', $typeUtil)";
            $nb=$laConnexion->exec($ordreSQL);
                
            if($nb==0){
                echo "Oups, Il y a eu une erreur". $laConnexion->errorInfo()[2];
            }else{
                echo "Votre compte a bien été ajouté !";
            }
        ?>        
    </div>
</body>
</html>