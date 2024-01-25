<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title class="upperline">testLevel2 - registration</title>
</head>
<body>
    <!-- conteneur de saisie de l'utilisateur -->
        <!-- bloc formulaire avec légende sur le bord -->
        <fieldset class="customBorder">
            <legend  class="customBorder"><h1>Registration</h1></legend>
            <!-- formulaire de saisie -->
            <form action="./affichange.php" method="POST" id="formulaire">
                <!-- champs de saisie -->
                name
                <input class="champsIn" type="text" name="txtname"      id="name"     placeholder="enter text" require>
                surname
                <input class="champsIn" type="text" name="txtsurname"   id="surname"  placeholder="enter text" required>
                age
                <input class="champsIn" type="text" name="txtage"       id="age"      placeholder="enter number" required>  
                password
                <input class="champsIn" type="text" name="txtpassword"  id="password" placeholder="enter text" required>
                address
                <input class="champsIn" type="text" name="txtaddress"   id="address"  placeholder="enter text" required>  
                <br><br>
                <input class="champsIn customBorder" type="submit" name="send" id="send" value="send"
                onclick="document.getElementById('formulaire').reset(); return false;"> 
            </form>
        </fieldset>
    
</body>
</html>