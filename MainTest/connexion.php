<!DOCTYPE html>
<!--  on fait la connexion pour toutes les pages php au même en droit avec pdo 
 pour ne pas a avoir a faire less modifications dans tous les fichiers -->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        try {
            $laConnexion=new PDO('mysql:host=localhost;dbname=testlevel2','root','root');
        } catch (Exception $erreur) {
            echo "erreur de connexion à la base de données".$erreur->getMessage();
            die();
        }
        ?>
    </body>
</html>


