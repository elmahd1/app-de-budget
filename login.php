<?php 
require 'menu.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
</head>
<body>
    <form 
   style="margin-top: 300px;" action="index.php" method="post">
<input type="text" name="nom" placeholder="nom de lutilsateur" required>
<input type="text" name="prenom" placeholder="prenom" required>
<input type="email" name="email" >
<input type="password" name="mot_de_passe" placeholder="mot de passe" required>
<input type="hidden" name="login" value="login">
<button type="submit">envoyer</button>
    </form>
</body>
</html>