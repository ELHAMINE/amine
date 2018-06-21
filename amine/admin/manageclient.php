<?php
session_start();
require('app/ini.inc.php');

$user = $_SESSION['user'] ?? null;

if($user == null) {
	header('location: ../signin.php');
}

require(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);
$data = $_POST;
$action = $_GET['action'] ?? '';
$buttons = [
    'add' => ['name' => 'btnCreateClient', 'text' => 'Créer', 'action' => '']
];

$isAdmin = $isAdmin ?? false;
$isActive = $isActive ?? false;

$message = [
    'errorCode' => 0,
    'textMessage' => ''
];

switch($action) {
    case 'delete': {
        require(INCLUDES_PATH . '/user.delete.php');
    } break;
    case 'update': {
        require(INCLUDES_PATH . '/user.update.php');
    }
    case 'edit': {
        $buttons['add'] = ['name' => 'btnAbort', 'text' => 'Annuler', 'action' => 'index.php'];

        $id = $_GET['idClient'] ?? '';
        $client = $database->selectQuery('SELECT * FROM Utilisateur WHERE id = ?', [
            $id
        ]);

        if(count($client) != 0) {
            $client = $client[0];

            $cin = $client['cin'];
            $lastname = $client['nom'];
            $firstname = $client['prenom'];
            $email = $client['email'];
            $dateN = $client['datenaiss'];
            $isAdmin = $client['is_admin'];
            $isActive = $client['is_active'];

            $isAdmin = $isAdmin === '1' ? true : false;
            $isActive = $isActive === '1' ? true : false;
        }
    } break;
    default: {
        if(isset($_POST['btnCreateClient'])) {
            require(INCLUDES_PATH . '/user.add.php');
        }
    }
}
$clients = $database->selectQuery('SELECT * FROM Utilisateur ORDER BY nom, prenom');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/ini.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/nav.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/forms.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/tables.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/grid.css' ?>' />
    
    <script src='<?= JS_PATH . '/ini.js' ?>'></script>
    <script src='<?= JS_PATH . '/nav.js' ?>'></script>
</head>
<body>
    <?php include(INCLUDES_PATH . '/nav.inc.php'); ?>
    <section class="row">
        <div class="form col-4">
            <form action="" method="post">
                <div class="header">
                    <h1 class="inner-header">Gérer clients</h1>
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
                        <label class="label">Mot de passe</label>
                        <input type="password" class="textbox" name="pass" />
                    </div>

                    <div class="control has-controls">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="isAdmin" <?= $isAdmin === true ? 'checked' : '' ?> />
                                Est admin
                            </label>
                        </div>
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="isActive" <?= $isActive === true ? 'checked' : '' ?> />
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="control has-controls">
                        <div class="control">
                            <button class="btn" formaction="<?= $buttons['add']['action'] ?>" name="<?= $buttons['add']['name'] ?>"><?= $buttons['add']['text'] ?></button>
                        </div>
                        <div class="control">
                            <button class="btn" formaction="index.php?action=update&idClient=<?= $_GET['idClient'] ?>" <?= $action == '' ? 'disabled' : '' ?> name="btnUpdateClient">Modifier</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-8">
            <table>
                <tr> 
                    <th>Nom</th><th>Prénom</th><th>CIN</th><th>Date de naissance</th><th>E-mail</th><th>Etat</th>
                    <th></th><th></th>
                </tr>
                <?php
                foreach($clients as $client):
                ?>
                <tr <?= $client['is_active'] == '1' ? '' : 'class="not-active"' ?> >
                    <td><?= $client['nom']?></td>
                    <td><?= $client['prenom']?></td>
                    <td><?= $client['cin']?></td>
                    <td><?= $client['datenaiss']?></td>
                    <td><?= $client['email']?></td>
                    <td><?= $client['is_admin'] === '1' ? 'Admin' : 'Client' ?></td>
                    <td><a class="btn edit" href="?action=edit&idClient=<?= $client['id'] ?>">Editer</a></td>
                    <td><a class="btn delete" href="?action=delete&idClient=<?= $client['id'] ?>">Supprimer</a></td>
                </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </section>
</body>
</html>