<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title class="upperline">testLevel2 - registration</title>
    <script type="javascript">
        document.getElementById('formulaire').reset();
    </script>
</head>

<body>
  
    <!-- conteneur de saisie de l'utilisateur -->
        <!-- bloc formulaire avec légende sur le bord -->
        <fieldset>
            <legend><h1>Registration</h1></legend>
            <!-- formulaire de saisie -->
            <form action="./affichange.php" method="POST" id="formulaire">
                <!-- champs de saisie -->
                <input type="text" name="txtname" id="name" placeholder="name" require>
                <input type="text" name="txtsurname" id="surname" placeholder="surname" required>
                <input type="text" name="txtage" id="age" placeholder="age" required>  
                <input type="text" name="txtpassword" id="password" placeholder="password" required>
                <input type="text" name="txtaddress" id="address" placeholder="address" required>  
                <input type="submit" name="send" id="send" value="send"> 
            </form>
        </fieldset>
    <nav class="navL">
        <a href="./affichange.php">affichange basique</a>
        <a href="./inscription.php">inscription basique</a>
        <a href="./preparedaffichange.php"> affichange préparé</a>
        <a href="./preparedInscription.php">inscription préparée</a>
    </nav>          
    
</body>
</html>