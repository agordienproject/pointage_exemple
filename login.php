<?php
// Include the connection file
include("connect.php");
include('data/data-admin.php'); // Add the file extension

session_start(); // Call session_start() at the very beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($user) {
        $hashed_password = $user["password"];

        if (password_verify($password, $hashed_password)) {
            // Authentication successful, redirect to the home page
            $_SESSION["username"] = $username;
            header("Location: accueil.php");
            exit();
        } else {
            // Incorrect password, redirect to index.html with an error message
            header("Location: index.html?error=incorrect");
            exit();
        }
    } else {
        // Username not found, redirect to index.html with an error message
        header("Location: index.html?error=notfound");
        exit();
    }
}

// Make sure to close the PDO connection at the end
$conn = null;

include("session.php");
?>
