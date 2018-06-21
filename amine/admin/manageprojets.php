
<?php
session_start();
require('app/ini.inc.php');

$user = $_SESSION['user'] ?? null;

if($user == null) {
	header('location: ../signin.php');
}

require(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);

if(isset($_POST['addProjet'])) {
    include (INCLUDES_PATH . '/projet.add.php');
}
else if(isset($_POST['addLiverable'])) {
    include (INCLUDES_PATH . '/liverable.add.php');
}

$clients = $database->selectQuery('SELECT * FROM Utilisateur WHERE (is_admin = false OR is_admin IS NULL) AND is_active = true');
$projets = $database->selectQuery('SELECT projet.*, utilisateur.cin, CONCAT(utilisateur.nom, \' \', utilisateur.prenom) AS \'nom_utilisateur\' FROM projet INNER JOIN utilisateur ON id_utilisateur = utilisateur.id');
$liverables = $database->selectQuery('SELECT * FROM Liverable');
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
    <link rel='stylesheet' href='<?= CSS_PATH . '/manageprojets.css' ?>' />

    <script src='<?= JS_PATH . '/ini.js' ?>'></script>
    <script src='<?= JS_PATH . '/nav.js' ?>'></script>
</head>
<body>
    <?php include(INCLUDES_PATH . '/nav.inc.php'); ?>
    <section>
        <div class="row">
            <div class="col-6">
                <form action="manageprojets.php" method="post" class="form">
                    <div class="body">
                        <div class="control">
                            <label class="label">Client</label>
                            <select name="idClient" class="textbox">
                            <?php
                            foreach ($clients as $client):
                            ?>
                                <option value="<?= $client['id'] ?>"><?= $client['nom'] . ' ' . $client['prenom'] ?></option>
                            <?php
                            endforeach;
                            ?>
                            </select>
                        </div>
                        <div class="control">
                            <label class="label">Nom</label>
                            <input class="textbox" type="text" name="nom" />
                        </div>
                        <div class="control has-controls">
                            <div class="control">
                                <label class="label">Date de début</label>
                                <input class="textbox" type="date" name="dateDebut" />
                            </div>
                            <div class="control">
                                <label class="label">Date de fin</label>
                                <input class="textbox" type="date" name="dateFin" />
                            </div>
                        </div>
                        <div class="control">
                            <label class="label">Description</label>
                            <textarea name="description" class="textbox"></textarea>
                        </div>
                        <div class="control">
                            <button name="addProjet" class="btn">Créer projet</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-6">
                <form action="manageprojets.php" method="post" class="form">
                    <input type="hidden" name="idProjet" value="<?= $_GET['idProjet'] ?? '' ?>"/>
                    <div class="body">
                        <div class="control">
                            <label class="label">Numéro</label>
                            <input class="textbox" type="text" name="numero" />
                        </div>
                        <div class="control has-controls">
                            <div class="control">
                                <label class="label">Date de début</label>
                                <input class="textbox" type="date" name="dateDebut" />
                            </div>
                            <div class="control">
                                <label class="label">Date de fin</label>
                                <input class="textbox" type="date" name="dateFin" />
                            </div>
                        </div>
                        <div class="control">
                            <label class="label">Montant</label>
                            <input class="textbox" type="text" name="montant" />
                        </div>
                        <div class="control">
                            <button class="btn" name="addLiverable" <?= !isset($_GET['idProjet']) ? 'disabled title="Selectioner un projet"' : '' ?>>Créer liverable</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <!-- id_projet, id_utilisateur, date_debut, date_fin, nom, description ,cin, nom_utilisateur -->
            <div class="col-6">
                <table class="custom">
                    <tr class="title">
                        <th colspan="2">Client</th>
                        <th colspan="5">Projet</th>
                    </tr>
                    <tr>
                        <th>CIN</th><th>Nom</th>
                        <th>Nom</th><th>Date début</th><th>Date fin</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach($projets as $prj):
                    ?>
                    <tr>
                        <td><?= $prj['cin'] ?></td>
                        <td><?= $prj['nom_utilisateur'] ?></td>
                        <td><?= $prj['nom'] ?></td>
                        <td><?= $prj['date_debut'] ?></td>
                        <td><?= $prj['date_fin'] ?></td>
                        <td><a href="?idProjet=<?= $prj['id_projet'] ?>">Select</a></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <th>Numéro</th><th>Date début</th><th>Date fin</th><th>Montant</th><th>Etat</th>
                    </tr>
                    <?php
                    foreach($liverables as $livrable):
                    ?>
                        <tr>
                            <td><?= $livrable['numero_liverable'] ?></td>
                            <td><?= $livrable['date_debut'] ?></td>
                            <td><?= $livrable['date_fin'] ?></td>
                            <td><?= $livrable['montant'] ?></td>
                            <td><a><?= $livrable['paye'] == '0' ? 'Non payé' : 'Payé' ?></a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>