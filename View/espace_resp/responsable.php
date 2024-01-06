<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleteUser = $bdd->prepare('DELETE FROM responsable WHERE id = ?');
    if ($deleteUser->execute([$id])) {
        header('Location: ../espace_resp/responsable.php');
        exit;
    } else {
        echo "Erreur : Impossible de supprimer l'utilisateur.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style_admin/responsable.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <link rel="stylesheet" href="../style/general/footer.css">
    <link rel="stylesheet" href="../style/general/responsive.css">
    <title>Afficher tous les responsables</title>
</head>
<body>
    <!-- début menu -->
    <header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
            <a href="../espace_admin/index.php">Accueil</a>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Activité</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../espace_admin/activite/activite.php">Afficher</a>
                    <a href="../espace_admin/update/publier_act.php">Publier</a>
                    <!-- <a href="../espace_admin/update/modifier_act.php">Modifier</a> -->
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../espace_admin/membre.php">Participant</a>
                    <a href="../espace_admin/update/gerer_participant.php">Participation</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Responsable</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../espace_resp/responsable.php">Afficher</a>
                    <a href="../espace_admin/update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../espace_admin/connexion/deconnexion.php">Déconnexion</a>
        </nav>
    </header>
    <!-- fin menu -->

    <section class="responsable">
        <div class="responsable-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Liste des responsables</b></p>
            <a href="javascript:void(0);" class="bn3637 bn37" onclick="scrollToMain()">Explorer</a>
        </div>
    </section>
    <main class="test">
    <div class="container">
    <div class="main" id="main">
    <?php
    $recupUsers = $bdd->query('SELECT id, nom, prenom, mdp, role FROM responsable');
    while ($user = $recupUsers->fetch()) {
        ?>
        <form action="" method="post">
            <div class="user-card">
                <div class="user-info">
                    <p> Nom : <?= $user['nom']; ?>  </p>
                    <p>Prénom : <?= $user['prenom']; ?></p>
                    <p>Mot de passe : <?= $user['mdp']; ?></p>
                    <p>Rôle : <?= $user['role']; ?></p>
                </div>
                <div class="user-actions">
                    <button class="noselect" type="submit" name="id" value="<?= $user['id']; ?>">Bannir</button>
                    <a href="../espace_admin/update/supprimer_act.php?id=<?= $user['id']; ?>">Modifier</a> <!--a refaire-->
                </div>
        </div>
            </div>

        </form>
        <?php
    }
    $recupUsers->closeCursor();
    ?>
    <br>
    </div>
    </div>
    
<div class="bar-sp"></div>
<footer>
  <p>© FATALYS 2023 - 2024</p>
</footer>
</main>


<script src="../JS/navbar.js"></script>
<script src="../JS/buttom.js"></script>
</body>
</html>
