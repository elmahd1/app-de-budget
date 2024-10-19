<?php
require 'conndb.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Utiliser le nom de la session
    $nom = $_SESSION['username'];
        $prenom = $_SESSION['prenom'];
        $email=$_SESSION['email'];
        
//needs some acount details like editing the infos
    echo "Bienvenue, " .htmlspecialchars($nom) . "!<br>";
    echo "$nom <br>$prenom<br>$email<br>";
   


} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.html");
    exit();
}
?>
