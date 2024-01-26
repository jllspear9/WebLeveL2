<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title><p class="upperline">testLevel2 - display</p></title>
</head>

<body>
<header>affichange des utilisateurs</header>    
<?php
// PDO statement 
// local uwamp server
// récupération des inputs du formulaire html
$name=$_POST["txtname"];
$surname=$_POST["txtsurname"];
$age=$_POST["txtage"];
$password=$_POST["txtpassword"];
$address=$_POST["txtaddress"];
// PDO connexion
try {
    $connexion = new PDO('mysql:host=localhost; dbname=testLevel2', 'root', 'root');/* j'ai supprimé le mdp*/ 
} catch  (PDOException $erreur){
    echo "erreur de connexion a la base de données".$erreur->getMessage();
    die();
}

?>



<nav class="navL">
        <a href="./affichange.php">affichange basique</a>
        <a href="./inscription.php">inscription basique</a>
        <a href="./preparedaffichange.php"> affichange préparé</a>
        <a href="./preparedInscription.php">inscription préparée</a>
</nav> 
</body>
</html>