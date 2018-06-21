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

$action = $data['action'] ?? '';

$idClient = $_GET['idClient'] ?? '';
$idProjet = $_GET['idProjet'] ?? '';

$clients = [];

if(isset($data['btnSearch'])) {
    $clients = $database->selectQuery('SELECT * FROM Utilisateur WHERE (nom LIKE :value OR prenom LIKE :value) AND (is_admin = 0 OR is_admin IS NULL)', [
        ':value' => '%' . $data['searchValue'] . '%'
    ]);    
}
else {
    $clients = $database->selectQuery('SELECT * FROM Utilisateur WHERE is_admin = 0 OR is_admin IS NULL');
}

$projets = [];
if($idClient != '')
    $projets = $database->selectQuery('SELECT * FROM Projet WHERE id_utilisateur = ?', [$idClient]);

$livrables = [];
if($idProjet != '')
    $livrables = $database->selectQuery('SELECT * FROM Liverable WHERE id_projet = ?', [$idProjet]);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/ini.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/nav.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/grid.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/tables.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/forms.css' ?>' />
    <link rel='stylesheet' href='<?= CSS_PATH . '/detailsclients.css' ?>' />
    
    <script src='<?= JS_PATH . '/ini.js' ?>'></script>
    <script src='<?= JS_PATH . '/nav.js' ?>'></script>
</head>
<body>
    <?php include(INCLUDES_PATH . '/nav.inc.php'); ?>
    <section>
        <div class="row">
            <div class="col-3">
                <h1>
                    Clients
                </h1>
                <div class="form">
                    <div class="control">
                        <form action="detailsclients.php" method="post">
                            <input type="text" class="textbox" name="searchValue" placeholder="Nom, Prénom, ..."/>
                            <button name="btnSearch" class="btn">Rechercher</button>
                        </form>
                    </div>
                </div>
                <ul class="list">
                    <?php
                    foreach($clients as $client):
                    ?>
                    <li><a href="?idClient=<?= $client['id'] ?>"><?= $client['nom'] . ' ' . $client['prenom'] . ' ' . $client['cin'] ?></a></li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="col-5">
                <h1>
                    Projets
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
                        <td colspan="1"><a href="?idClient=<?= $idClient ?>&idProjet=<?= $projet['id_projet'] ?>">Afficher les livrables</a></td>
                    </tr>
                    <tr>
                        <td colspan="3"><p class="long-text"><?= nl2br($projet['description']) ?><label data-role="show" class="link">Lire la suite...</label></p></td>
                    </tr>
                <?php
                endforeach;
                ?>
                </table>
            </div>
            <div class="col-4">
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
                            <td><?= $livrable['paye'] == '1' ? 'Payé' : 'Non payé' ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </section>

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