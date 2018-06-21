<?php
$cin = $data['cin'] ?? '';
$nom = $data['nom'] ?? '';
$prenom = $data['prenom'] ?? '';
$email = $data['email'] ?? '';
$pass = $data['pass'] ?? '';
$datenaiss = $data['datenaiss'] ?? '';

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
            // `id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`, `is_active`
            $database->nonQuery("INSERT INTO `$tableName` VALUES (NULL, ?, ?, ?, ?, ?, ?, false, false)", [
                $cin, $nom, $prenom, $datenaiss, $email, sha1($pass)
            ]);

            $message = [
                'errorCode' => 1,
                'textMessage' => 'Vous ête inscrit.'
            ];
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