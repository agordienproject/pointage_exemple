<?php
include("session.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/accueil.css">
    
</head>
<body>
    <h1 class="title">Accueil</h1>
    <a class="logout-button" href="logout.php">Se déconnecter</a>

    <form class="form-container" id="promoForm" action="presence.php" method="post">
        <label for="promo">Sélectionnez la promotion :</label>
        <select id="promo" name="promo">
            <option value="FISA INFO">FISA INFO</option>
            <option value="FISE INFO">FISE INFO</option>
            <option value="FISE INFO">FISA S3E</option>
            <option value="FISE INFO">CPIA2 INFO</option>
            <option value="FISE INFO">CPIA2 S3E</option>
            <option value="FISE INFO">CPIA1</option>
            <!-- Ajoutez d'autres options de promotion ici -->
        </select>
        <input type="submit" value="Accéder aux présences du jour">
    </form>

    <div class="button-container">
        <a href="eleves.php" class="button">Liste des élèves</a>
        <a href="historique.php" class="button">Historique des présences</a>
    </div>
</body>
</html>
