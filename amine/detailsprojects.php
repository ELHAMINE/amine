<?php
session_start();

$user = $_SESSION['user'] ?? null;

if($user == null) {
    header('location: signin.php');
}

$user = json_decode($user);

if($user->is_active == '0' || $user->is_active == null) {
    header('location: signin.php');
}

require('app/ini.inc.php');

require(CLASSES_PATH . '/database.class.php');
$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);
$data = $_POST;
$idProjet = $_GET['idProjet'] ?? '';

if(isset($_GET['id_liverable'])) {
    $id_liv = $_GET['id_liverable'];
    $paye = $_GET['paye'];
    if($paye === '1') {
        $paye = '0';
    }
    else {
        $paye = '1';
    }

    $database->nonQuery('UPDATE Liverable SET paye = ? WHERE id_projet = ? AND id_liverable = ?', [$paye, $idProjet, $id_liv]);
}

$projets = $database->selectQuery('SELECT * FROM Projet WHERE id_utilisateur = ?', [$user->id]);

$livrables = [];
if($idProjet != '')
    $livrables = $database->selectQuery('SELECT * FROM Liverable WHERE id_projet = ?', [$idProjet]);
?>
<!DOCTYPE html>
<html
<head>
    <title><?= $user->nom . ' ' . $user->prenom ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>/ini.css" />
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>/nav.css" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>/forms.css" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>/grid.css" />
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>/tables.css" />
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>/detailsproject.css" />

    <script src="<?= JS_PATH ?>/ini.js"></script>
    <script src="<?= JS_PATH ?>/nav.js"></script>
</head>
<body>
    <?php include (INCLUDES_PATH . '/nav.inc.php') ?>
    <div>
        <div class="row">
            <div class="col-5">
                <h1>
                    Mes projets
                </h1>

                <table>
                <?php
                foreach($projets as $projet):
                ?>
                    <tr>
                        <th>Nom</th><th>Date début</th><th>Date fin</th>
                    </tr>
                    <tr>
                        <td><?= $projet['nom'] ?></td>
                        <td><?= $projet['date_debut'] ?></td>
                        <td><?= $projet['date_fin'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><label>Description</label></td>
                        <td colspan="1"><a href="?idProjet=<?= $projet['id_projet'] ?>">Afficher les livrables</a></td>
                    </tr>
                    <tr>
                        <td colspan="3"><p class="long-text"><?= nl2br($projet['description']) ?><label data-role="show" class="link">Lire la suite...</label></p></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </table>
            </div>

            <div class="col-7">
                <h1>
                    Liverables
                </h1>
                <table>
                    <tr>
                        <th>Numéro</th><th>Date début</th><th>Date fin</th><th>Montant</th><th>Etat</th>
                    </tr>
                    <?php
                    foreach($livrables as $livrable):
                    ?>
                        <tr>
                            <td><?= $livrable['numero_liverable'] ?></td>
                            <td><?= $livrable['date_debut'] ?></td>
                            <td><?= $livrable['date_fin'] ?></td>
                            <td><?= $livrable['montant'] ?></td>
                            <td><a href="?idProjet=<?= $livrable['id_projet'] ?>&id_liverable=<?= $livrable['id_liverable'] ?>&paye=<?= $livrable['paye'] ?>"><?= $livrable['paye'] == '1' ? 'payé' : 'Payer' ?></a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        var links = document.getElementsByClassName('link');

        for(let i = 0; i < links.length; i++) {
            let link = links[i];
            link.addEventListener('click', function () {
                let parent = this.parentNode;
                let role = this.getAttribute('data-role');
                switch(role) {
                    case 'show': {
                        parent.style.height = 'auto';
                        let role = this.setAttribute('data-role', 'hide');
                        this.innerHTML = 'Réduire text';
                    } break;
                    case 'hide': {
                        parent.style.height = '50px';
                        let role = this.setAttribute('data-role', 'show');
                        this.innerHTML = 'Lire la suite...';
                    } break;
                }
            });
        }
    </script>
</body>
</html>