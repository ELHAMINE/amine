<?php
$rows = $database->selectQuery('SELECT * FROM utilisateur WHERE `email` LIKE ? AND pass LIKE ?', [
    $data['email'],
    sha1($data['password'])
]);

if(count($rows) == 0) {
    $message = [
        'errorCode' => '0',
        'textMessage' => 'Login et/ou mot de passe et incorrect.',
        'isAdmin' => false
    ];
}
else {
    $_SESSION['user'] = json_encode($rows[0]);
    
    $message = [
        'errorCode' => '1',
        'textMessage' => 'Vous ête connecté.',
        'isAdmin' => $rows[0]['is_admin'] == 1
    ];
}
?>