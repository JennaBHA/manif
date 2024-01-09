<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: ../connexion/connexion.php');
    exit();
}

// print_r($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/afficher_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/style_admin/gerer_part.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/responsive.css">
    <link rel="stylesheet" href="../../style/general/scroolbar.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <title>Gérer les participants</title>
</head>
<body>
<!-- début menu -->
<header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
            <a href="../index.php">Accueil</a>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Activité</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../activite/activite.php">Afficher</a>
                    <a href="publier_act.php">Publier</a>
                    <!-- <a href="modifier_act.php">Modifier</a> -->
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../membre.php">Participant</a>
                    <a href="gerer_participant.php">Participation</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Responsable</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../../espace_resp/responsable.php">Afficher</a>
                    <a href="../../espace_admin/update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../connexion/deconnexion.php">Déconnexion</a>
        </nav>
    </header>
    <!-- fin menu -->

    <div class="affichage">
    <div class="main" id="main">
        <div>
        <h3>Gérer les participants en tant qu'administrateur</h3>
        <form action="gerer_participant.php" method="post">
            <label for="activite">Sélectionner une activité :</label>
            <select class="select_gerer" name="activite" id="activite">
                <?php
                $selectedActivite = isset($_POST['activite']) ? $_POST['activite'] : null;

                $recupAct = $bdd->query('SELECT * FROM activite');
                while ($activite = $recupAct->fetch()) {
                    $selected = ($activite['id'] == $selectedActivite) ? 'selected' : '';
                    echo "<option value=\"{$activite['id']}\" $selected>{$activite['titre']}</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn_gerer">Afficher les participants</button>
        </form>
    </div>

    <?php
    if (isset($_POST['activite'])) {
        $activite_id = $_POST['activite'];

        $recupInfo = $bdd->prepare('SELECT activite.titre, activite.description, activite.responsable, participant.nom, participant.prenom
                            FROM inscription
                            JOIN participant ON inscription.participant_id = participant.id
                            JOIN activite ON inscription.activite_id = activite.id
                            WHERE inscription.activite_id = ?');

        $recupInfo->execute([$activite_id]);

        if ($recupInfo->rowCount() > 0) {
            ?>
            <div>
                <h3>Participants pour l'activité sélectionnée :</h3>
                <?php
                $info = $recupInfo->fetch();
                echo "<div>";
                echo "<p>Activité : {$info['titre']}</p>";
                echo "<p>Description : {$info['description']}</p>";
                echo "<p>Responsable : {$info['responsable']}</p>";
                echo "</div>";

                // Afficher les participants
                $recupInfo->execute([$activite_id]); 
                while ($info = $recupInfo->fetch()) {
                    echo "<div>";
                    echo "<p>Participant : {$info['nom']} {$info['prenom']}</p>";
                    echo "</div>";
                }
                ?>
            </div>
            <?php
        } else {
            echo "<p>Aucun participant pour cette activité.</p>";
        }
    }
    ?>

    </div>
    <div class="position_btn">
    <a href="../index.php" class="bn1234 bn34"><- Retour</a>
    </div>
</div>

    <div class="bar-sp"></div>
<footer>
<p>© FATALYS 2023 - 2024</p>
</footer>

    <script src="../../JS/navbar.js"></script>
    <script src="../../JS/buttom.js"></script>
</body>
</html>
