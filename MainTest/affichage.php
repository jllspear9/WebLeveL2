<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title class="upperline">testLevel2 - display</title>
</head>
<body>
    <header>affichange des utilisateurs</header>    
    <?php
    // local uwamp server
    // récupération des inputs du formulaire html
    $name=$_POST["txtname"];
    $surname=$_POST["txtsurname"];
    $age=$_POST["numage"]; // ettention si c'est du texte ça plante
    $password=$_POST["txtpassword"];
    $address=$_POST["txtaddress"];
    // PDO connexion
    // page particulière car elle sert a la foi a insérer les données dans la base de données
    // du fichier connexion et aussi afficher les données présente dans la base MySQL
    // dans un site ça ne sera jamais comme ça sauf pour les connexions des développeurs ou admin sys
    include_once("./connexion.php");
    ///////////// on doit vérifier d'abord que les données ne sont pas déja présentes///////////////
    $ordreSQL="INSERT INTO user (nom, prenom, age, password0, address0) 
    VALUES('$name', '$surname', '$age', '$password', '$address')";
    $nb=$laConnexion->exec($ordreSQL);
    // vérifications des insertions des données
    if($nb==0){
        echo "Oups, Il y a eu une erreur<br>". $laConnexion->errorInfo()[2];
    }else{
        echo "Votre compte a bien été ajouté !<br>";
    }
    try{
        // récupération des données de la table 
        $requete="SELECT * FROM user";
        $resultRequest=$laConnexion->query($requete);
        $tableau=$resultRequest->fetchAll();
        // sécurité sur le nb max d'interations
        $maxIterations=$laConnexion->query("SELECT COUNT(nom) FROM user")->fetch();
        echo "le nombre de lignes est : $maxIterations";
        // affichange des données de la table 
    } catch (Exception $err){
        echo $err->getMessage();
    }
    ?>
    <table class="table">
        <tr> <!-- première ligne (rappel) -->
            <th>index</th> <!-- supplément -->
            <th>nom</th>
            <th>prenom</th>
            <th>age</th>
            <th>mot de passe</th>
            <th>adresse</th>
        </tr>
        <!-- boucle php -->
        <?php 
        $idx=0;
        // attention il peut y avoir qu'une seul tuple ou pas du tout (ou un avec une erreur)
        if (!isset($errors[2])){
            while($maxIterations != 0){
                echo "<tr>
                <td>".$idx."</td>        
                <td>".$tableau[$idx]['nom']."</td>
                <td>".$tableau[$idx]['prenom']."</td>
                <td>".$tableau[$idx]['age']."</td>
                <td>".$tableau[$idx]['password0']."</td>
                <td>".$tableau[$idx]['address0']."</td>
                </tr>";
                $idx++;
                $maxIterations--;
            }
        }
        
        ?>
    </table>



    <nav class="navL">
            <a href="./inscription.php">inscription basique</a>
            <a href="./preparedaffichange.php"> affichange préparé</a>
            <a href="./preparedInscription.php">inscription préparée</a>
    </nav> 
</body>
</html>




