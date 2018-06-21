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

if(isset($_POST['btnSend'])) {
    include (INCLUDES_PATH . '/message.add.php');
}

$messages = $database->selectQuery('SELECT * FROM message WHERE id_utilisateur = ?', [$user->id]);
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
        .message {
            padding: 8px;
        }

        .message * {
            padding: 5px;
            border-bottom: 1px dotted #000;
        }

        .message h1, .message h2 {
            color: gray;
        }
        .message p {
            color: #123456;
            border-bottom: 1px solid #000;
        }
    </style>
</head>
<body>
    <?php include (INCLUDES_PATH . '/nav.inc.php') ?>
    <form action="message.php" method="post" class="form">
        <div class="body">
            <div class="control">
                <label class="label">Sujet</label>
                <input class="textbox" name="sujet" />
            </div>
            <div class="control">
                <label class="label">Text de message</label>
                <textarea class="textbox" name="text"></textarea>
            </div>

            <div class="control">
                <button type="submit" class="btn" name="btnSend">Envoyer</button>
            </div>
        </div>
    </form>

    <div>
    <?php
    foreach($messages as $msg):
    ?>
        <div class="message">
            <h1>Sujet: <?= $msg['sujet'] ?> à <?= $msg['date'] ?></h1>
            <p>Text: <?= $msg['text'] ?></p>
        </div>
    <?php
    endforeach;
    ?>
    </div>
</body>
</html>