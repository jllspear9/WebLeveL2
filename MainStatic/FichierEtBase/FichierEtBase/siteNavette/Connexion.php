<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        try {
            $laConnexion=new PDO('mysql:host=localhost;dbname=navette','root','root');
        } catch (Exception $erreur) {
            echo "erreur de connexion à la base de données".$erreur->getMessage();
            die();

        }
        ?>
    </body>
</html>
