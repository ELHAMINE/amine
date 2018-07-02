<?php
session_start();
require('app/ini.inc.php');

$user = $_SESSION['user'] ?? null;

if($user == null) {
	header('location: ../signin.php');
}

require(CLASSES_PATH . '/database.class.php');
$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);
$messages = $database->selectQuery('SELECT * FROM Message INNER JOIN Utilisateur ON id_utilisateur = utilisateur.id');
$messages2 = $database->selectQuery('SELECT * FROM contact');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Messages</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/ini.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/nav.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/grid.css' ?>' />
    
    <script src='<?= JS_PATH . '/ini.js' ?>'></script>
    <script src='<?= JS_PATH . '/nav.js' ?>'></script>

    <style>
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
    <?php include(INCLUDES_PATH . '/nav.inc.php'); ?>
    <div class="row">
        <div class="col-6">
        <h1 style="font-size:50px;">messages des clients</h1>
        <?php
        foreach($messages as $msg):
        ?>
            <div class="message">
                <h1>Sujet: <?= $msg['sujet'] ?> à <?= $msg['date'] ?></h1>
                <h2>Envoyer par: <?= $msg['cin'] . ', ' . $msg['nom'] . ' ' . $msg['prenom'] ?></h2>
                <p>Text: <?= $msg['text'] ?></p>
            </div>
        <?php
        endforeach;
        ?>
        </div>
        <div class="col-6">
        <?php
        foreach($messages2 as $msg):
        ?>
            <h1 style="font-size:50px;">contact populaires</h1>
            <div class="message">
                <h1>Nom: <?= $msg['nom'] ?></h1>
                <h2>Email: <?= $msg['email'] ?></h2>
                <p>Text: <?= $msg['text'] ?></p>
            </div>
        <?php
        endforeach;
        ?>
        </div>
    </div>
</body>
</html>