<?php
$idProjet = $_POST['idProjet'];
$numero = $_POST['numero'];
$dateDebut = $_POST['dateDebut'];
$dateFin = $_POST['dateFin'];
$montant = $_POST['montant'];

$database->nonQuery('INSERT INTO liverable VALUES (NULL, ?, ?, ?, ?, ?, false)', [
    $numero,
    $idProjet,
    $dateDebut,
    $dateFin,
    $montant
]);
?>