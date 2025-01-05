<?php
session_start();
if (!isset($_SESSION["username"])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.html");
    exit();
}
?>