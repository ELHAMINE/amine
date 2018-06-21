<?php
session_start();

$data = $_POST;

if(isset($data['logout'])) {
	$_SESSION['user'] = null;
}

if(!isset($_SESSION['user'])) {
	header('location: signin.php');
}

$user = $_SESSION['user'];
$user = json_decode($user);

if($user->is_active == '0' || $user->is_active == null) {
    header('location: signin.php');
}

require('app/ini.inc.php');
require_once(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);
$message = [
	'errorCode' => -1,
	'textMessage' => '',
	'isAdmin' => false
];

if(isset($data['btnUpdateClient'])) {
    include (INCLUDES_PATH . '/user.update.php');
}
else {
    $row = $database->selectQuery('SELECT * FROM Utilisateur WHERE id = ?', [$user->id]);
    $row = $row[0];
    $id = $user->id;
    $cin = $row['cin'];
    $lastname = $row['nom'];
    $firstname = $row['prenom'];
    $dateN = $row['datenaiss'];
    $email = $row['email'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $user->nom . ' ' . $user->prenom ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>/ini.css" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>/forms.css" />
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>/nav.css" />

    <script src="<?= JS_PATH ?>/ini.js"></script>
    <script src="<?= JS_PATH ?>/nav.js"></script>

    <style>
        .form {
            width: 100%;
        }

        .form .control {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php include (INCLUDES_PATH . '/nav.inc.php') ?>
    <form action="profile.php" method="post" class="form">
        <div class="header">
            <h1 class="inner-header"></h1>
        </div>

        <div class="body">
            <div class="control">
                <label class="label message">
                    <?= $message['textMessage'] ?>
                </label>
            </div>
            
            <div class="control has-controls">
                <div class="control">
                    <label class="label">Nom</label>
                    <input type="text" class="textbox" name="lastname" value="<?= $lastname ?? '' ?>" />
                </div>

                <div class="control">
                    <label class="label">Prénom</label>
                    <input type="text" class="textbox" name="firstname" value="<?= $firstname ?? '' ?>" />
                </div>
            </div>

            <div class="control">
                <label class="label">CIN</label>
                <input type="text" class="textbox" name="cin" value="<?= $cin ?? '' ?>" />
            </div>

            <div class="control">
                <label class="label">Date de naissance</label>
                <input type="date" class="textbox" name="dateN" value="<?= $dateN ?? '' ?>" />
            </div>

            <div class="control">
                <label class="label">Email</label>
                <input type="text" class="textbox" name="email" value="<?= $email ?? '' ?>"/>
            </div>

            <div class="control">
                <label class="label">Ancien mot de passe</label>
                <input type="password" class="textbox" name="oldPass" />
            </div>

            <div class="control">
                <label class="label">Nouveau mot de passe</label>
                <input type="password" class="textbox" name="newPass" />
            </div>

            <div class="control has-controls">
                <div class="control">
                    <button class="btn" name="btnUpdateClient">Modifier</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>