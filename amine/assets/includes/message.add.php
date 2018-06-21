<?php

$sujet = $_POST['sujet'] ?? '';
$text = $_POST['text'] ?? '';

$database->nonQuery('INSERT INTO Message VALUES(NULL, ?, ?, ?, NOW())', [
    $user->id,
    $sujet,
    $text
]);
?>