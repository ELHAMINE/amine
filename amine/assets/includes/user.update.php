<?php
$id = $user->id;
$cin = $data['cin'] ?? '';
$lastname = $data['lastname'] ?? '';
$firstname = $data['firstname'] ?? '';
$dateN = $data['dateN'] ?? '';
$email = $data['email'] ?? '';
$newPass = $data['newPass'] ?? '';
$oldPass = $data['oldPass'] ?? '';
$oldPass = sha1($oldPass);

if($newPass == '') {
    $newPass = $oldPass;
}
else {
    $newPass = sha1($newPass);
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = [
        'errorCode' => 0,
        'textMessage' => "E-mail '$email' est invalid."
    ];
}
else if($oldPass != $user->pass) {
    $message = [
        'errorCode' => 0,
        'textMessage' => "Ancien mot de passe est incorrect."
    ];
}
else {
    $tableName = 'Utilisateur';

    $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE cin LIKE ? AND id != ?", [
        $cin, $id
    ]) != 0;

    if($isExist === false) {

        $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE email LIKE ? AND id != ?", [
            $email, $id
        ]) != 0;

        if($isExist === false) {
            // `id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`
            if($database->nonQuery("UPDATE `$tableName` SET cin = ?, nom = ?, prenom = ?, datenaiss = ?, email = ?, pass = ? WHERE id = ?", [
                $cin, $lastname, $firstname, $dateN, $email, $newPass, $id
            ])) {
                $row = $database->selectQuery('SELECT * FROM Utilisateur WHERE id = ?', [$user->id]);
                $row = $row[0];
                $_SESSION['user'] = json_encode($row);
                $user = json_decode($_SESSION['user']);
                $message = [
                    'errorCode' => 1,
                    'textMessage' => 'Client modifié.'
                ];
            }
            else {
                $message = [
                    'errorCode' => 0,
                    'textMessage' => 'Erreur inconnu :\'(.'
                ];
            }
        }
        else {
            $message = [
                'errorCode' => 0,
                'textMessage' => "E-mail '$email' déjà utilisé."
            ];
        }
    }
    else {
        $message = [
            'errorCode' => 0,
            'textMessage' => "CIN '$cin' déjà utilisé."
        ];
    }
}
?>