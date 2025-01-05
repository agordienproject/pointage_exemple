<?php
include("session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/accueil.css">
</head>
<body>
    <h1 class="title">Home</h1>
    <a class="logout-button" href="logout.php">Logout</a>

    <form class="form-container" id="promoForm" action="presence.php" method="post">
        <label for="promo">Select the promotion:</label>
        <select id="promo" name="promo">
            <option value="FISA INFO">FISA INFO</option>
            <option value="FISE INFO">FISE INFO</option>
            <option value="FISA S3E">FISA S3E</option>
            <option value="CPIA2 INFO">CPIA2 INFO</option>
            <option value="CPIA2 S3E">CPIA2 S3E</option>
            <option value="CPIA1">CPIA1</option>
            <!-- Add other promotion options here -->
        </select>
        <input type="submit" value="Access today's attendance">
    </form>

    <div class="button-container">
        <a href="eleves.php" class="button">Student List</a>
        <a href="historique.php" class="button">Attendance History</a>
    </div>
</body>
</html>
