<?php
$idClient = $_POST['idClient'];
$nom = $_POST['nom'];
$dateDebut = $_POST['dateDebut'];
$dateFin = $_POST['dateFin'];
$description = $_POST['description'];

$database->nonQuery('INSERT INTO projet VALUES (NULL, ?, ?, ?, ?, ?)', [
    $idClient,
    $dateDebut,
    $dateFin,
    $nom,
    $description
]);
?>