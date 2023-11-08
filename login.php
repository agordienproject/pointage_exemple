<?php

// Inclure le fichier de connexion
include("connect.php");

session_start(); // Appeler session_start() au tout début du script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Préparez la requête SQL pour récupérer l'utilisateur
    $query = "SELECT * FROM users WHERE name = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $hashed_password = $user["password"];

        if (password_verify($password, $hashed_password)) {
            // Authentification réussie, redirigez vers la page d'accueil
            $_SESSION["username"] = $username; // Vous n'avez pas besoin de recréer la session_start()
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

include ("session.php");

