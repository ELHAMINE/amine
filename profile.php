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
require('app/ini.inc.php');

if($user->is_active == 0 || $user->is_active == null) {
    header('location: signin.php');
}


$message = [
	'errorCode' => -1,
	'textMessage' => '',
	'isAdmin' => false
];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="icon" type="image/ico" />
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
    <div class="form">
        <form action="profile.php" method="post">
            <div class="header">
            </div>

            <div class="body">
                <div class="control">
                    <label class="label message <?= $message['status'] ?>">
                        <?= $message['textMessage'] ?>
                    </label>
                </div>

                <div class="control">
                    <input type="text" class="textbox" name="lastname" value="<?= $nom ?? '' ?>" placeholder="Nom"/>
                </div>

                <div class="control">
                    <input type="text" class="textbox" name="firstname" value="<?= $prenom ?? '' ?>" placeholder="Prénom" />
                </div>

                <div class="control">
                    <input type="text" class="textbox" name="username" value="<?= $email ?? '' ?>" placeholder="Nom d'utilisateur"/>
                </div>

                <div class="control">
                    <input type="password" class="textbox" name="passwordOld" placeholder="Ancien mot de passe" />
                </div>

                <div class="control">
                    <input type="password" class="textbox" name="passwordNew" placeholder="Nouveau mot de passe" />
                </div>

                <div class="control">
                    <button class="btn" name="btnUpdate">Modifier</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>