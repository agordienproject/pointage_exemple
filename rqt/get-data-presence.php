<?php

include("../session.php");

include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["promo"])) {
    $promo = $_GET["promo"];

    $query_presence = "SELECT
        eleves.nom,
        eleves.prenom,
        eleves.promo,
        IF(IFNULL(presence_matin, 0) = 1, 'Présent', 'Absent') AS presence_matin,
        IF(IFNULL(presence_matin, 0) = 1, IFNULL(heure_matin, ''), '') AS heure_matin,
        IF(IFNULL(presence_aprem, 0) = 1, 'Présent', 'Absent') AS presence_aprem,
        IF(IFNULL(presence_aprem, 0) = 1, IFNULL(heure_aprem, ''), '') AS heure_aprem
    FROM
        eleves
    LEFT JOIN presence ON eleves.id_eleve = presence.id_eleve AND jour = CURDATE()
    WHERE eleves.promo = :promo;";

    // Assurez-vous d'utiliser PDO et de lier la valeur :promo à la variable $promo dans la requête.
}


$stmt = $conn->prepare($query_presence);
$stmt->bindParam(':promo', $promo); // Liez la valeur de :promo
$stmt->execute();

$presences = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert strings to UTF-8
foreach ($presences as &$row) {
    foreach ($row as $key => $value) {
        $row[$key] = mb_convert_encoding($value, 'UTF-8', 'auto');
    }
}

echo json_encode($presences, JSON_UNESCAPED_UNICODE);

// Assurez-vous de fermer la connexion PDO à la fin
$conn = null;
?>