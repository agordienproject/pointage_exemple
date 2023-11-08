<?php

include ("../session.php");


include("../connect.php");


$query_historique = "SELECT
c.jour,
UPPER(el.nom) as nom,
CONCAT(UPPER(SUBSTRING(el.prenom,1,1)),LOWER(SUBSTRING(el.prenom,2))) as prenom,
el.promo,
CASE WHEN p.presence_matin = 1 THEN 'Présent' ELSE 'Absent' END AS presence_matin,
IFNULL(p.heure_matin, NULL) AS heure_matin,
CASE WHEN p.presence_aprem = 1 THEN 'Présent' ELSE 'Absent' END AS presence_aprem,
IFNULL(p.heure_aprem, NULL) AS heure_aprem
FROM
calendrier c
LEFT JOIN
eleves el
ON
1 = 1
LEFT JOIN
presence p
ON
el.id_eleve = p.id_eleve AND c.jour = p.jour
WHERE DAYOFWEEK(c.jour) NOT IN (7)
ORDER BY `jour` DESC";

$stmt = $conn->prepare($query_historique);
$stmt->execute();

$historique = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($historique);

// Assurez-vous de fermer la connexion PDO à la fin
$conn = null;

?>