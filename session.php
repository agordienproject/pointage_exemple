<?php
session_start();
if (!isset($_SESSION["username"])) {
    // Si l'utilisateur n'est pas connecté, redirigez vers la page de connexion
    header("Location: index.html");
    exit();
}
?>