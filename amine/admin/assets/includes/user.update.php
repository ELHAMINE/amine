<?php
$id = $_GET['idClient'] ?? '';
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

    $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE cin LIKE ? AND id != ?", [
        $cin, $id
    ]) != 0;

    if($isExist === false) {

        $isExist = $database->scalarQuery("SELECT COUNT(*) FROM `$tableName` WHERE email LIKE ? AND id != ?", [
            $email, $id
        ]) != 0;

        if($isExist === false) {
            // `id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`
            if($database->nonQuery("UPDATE `$tableName` SET cin = ?, nom = ?, prenom = ?, datenaiss = ?, email = ?, is_admin = ?, is_active = ? WHERE id = ?", [
                $cin, $lastname, $firstname, $dateN, $email, $isAdmin, $isActive, $id
            ])) {
                $cin = $lastname = $firstname = $dateN = $email = $pass = '';
                $isAdmin = $isActive = false;

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