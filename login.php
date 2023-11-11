<?php
// Inclure le fichier de connexion
include("connect.php");
include('rqt/data-admin.php'); // Ajoutez l'extension du fichier

session_start(); // Appeler session_start() au tout début du script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($user) {
        $hashed_password = $user["password"];

        if (password_verify($password, $hashed_password)) {
            // Authentification réussie, redirigez vers la page d'accueil
            $_SESSION["username"] = $username;
            header("Location: accueil.php");
            exit();
        } else {
            // Mot de passe incorrect, redirigez vers index.html avec un message d'erreur
            header("Location: index.html?error=incorrect");
            exit();
        }
    } else {
        // Nom d'utilisateur introuvable, redirigez vers index.html avec un message d'erreur
        header("Location: index.html?error=notfound");
        exit();
    }
}

// Assurez-vous de fermer la connexion PDO à la fin
$conn = null;

include("session.php");
?>
