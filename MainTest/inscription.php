<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title class="upperline">testLevel2 - register</title>
</head>
<body>
    <!-- conteneur de saisie de l'utilisateur -->
        <!-- bloc formulaire avec légende sur le bord -->
        <fieldset class="customBorder">
            <legend  class="customBorder"><h1 class="customBorder">Register</h1></legend>
            <!-- formulaire de saisie -->
            <form action="./affichange.php" method="POST" id="formulaire">
                <!-- champs de saisie -->
                name
                <input class="champsIn" type="text" name="txtname"      id="name"     placeholder="name" required>
                surname
                <input class="champsIn" type="text" name="txtsurname"   id="surname"  placeholder="surname" required>
                age
                <input class="champsIn" type="text" name="txtage"       id="age"      placeholder="age" required>  
                password
                <input class="champsIn" type="text" name="txtpassword"  id="password" placeholder="password" required>
                address
                <input class="champsIn" type="text" name="txtaddress"   id="address"  placeholder="address" required>  
                <br><br>
                <input class="champsIn customBorder" type="submit" name="send" id="send"> 
            </form>
        </fieldset>
    
</body>
</html>