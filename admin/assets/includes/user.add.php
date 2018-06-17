<?php
$cin = $data['cin'] ?? '';
$lastname = $data['lastname'] ?? '';
$firstname = $data['firstname'] ?? '';
$dateN = $data['dateN'] ?? '';
$email = $data['email'] ?? '';
$pass = $data['pass'] ?? '';
$isAdmin = $data['isAdmin'] ?? null;
$isActive = $data['isActive'] ?? null;

if($isAdmin == 'on') {
    $isAdmin = true;
}

if($isActive == 'on') {
    $isActive = true;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = [
        'errorCode' => 0,
        'textMessage' => "E-mail '$email' est invalid."
    ];
}
else {
    $tableName = 'Utilisateur';

    $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE cin LIKE ?", [
        $cin
    ]) != 0;

    if($isExist === false) {

        $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE email LIKE ?", [
            $email
        ]) != 0;

        if($isExist === false) {
            // `id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`
            if($database->nonQuery("INSERT INTO `$tableName` VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $cin, $lastname, $firstname, $dateN, $email, sha1($pass), $isAdmin, $isActive
            ])) {
                $cin = $lastname = $firstname = $dateN = $email = $pass = '';
                $isAdmin = false;

                $message = [
                    'errorCode' => 1,
                    'textMessage' => 'Client crée.'
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