<?php
$id = $_GET['idClient'] ?? '';

if($id != '') {
    $database->nonQuery('DELETE FROM Utilisateur WHERE id = ?', [
        $id
    ]);
}
?>