<?php 
require 'conndb.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin'])) {
    // Détruire la session
    session_unset();
    session_destroy();

    // Rediriger vers la page de connexion ou la page d'accueil
    header("Location: login.php");
    exit();
} else {
    // Si l'utilisateur n'est pas connecté, rediriger directement vers la page de connexion
    header("Location: login.php");
    exit();
}
?>
