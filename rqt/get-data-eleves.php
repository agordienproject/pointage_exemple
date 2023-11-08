<?php

include ("../session.php");

include("../connect.php");

$query_eleves = "SELECT * from eleves";

$stmt = $conn->prepare($query_eleves);
$stmt->execute();

$eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($eleves);

// Assurez-vous de fermer la connexion PDO à la fin
$conn = null;

?>