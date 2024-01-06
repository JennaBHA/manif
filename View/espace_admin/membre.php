<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleteUser = $bdd->prepare('DELETE FROM participant WHERE id = ?');
    if ($deleteUser->execute([$id])) {
        header('Location: ../espace_admin/membre.php');
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
    <link rel="stylesheet" href="../style/style_admin/afficher_membre.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/footer.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <title>Afficher tous les membres</title>
</head>
<body>
     <!-- début menu -->
<header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
            <a href="index.php">Accueil</a>
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
                    <a href="membre.php">Participant</a>
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

    <section class="membre">
        <div class="membre-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Liste des membres</b></p>
            <a href="javascript:void(0);" class="bn3637 bn37" onclick="scrollToMain()">Explorer</a>
        </div>
    </section>

    <main class="test">
    <div class="main" id="main">
    <section class="padding">
    <?php
    $recupUsers = $bdd->query('SELECT id, prenom, nom, mail, telephone, mdp, role FROM participant');
    while ($user = $recupUsers->fetch()) {
        ?>
        <form action="" method="post">
            <div class="user-card">
                <div class="user-info">
                    <p><B>Nom et prenom :</B> <?= $user['prenom']; ?> <?= $user['nom']; ?></p> 
                    <p><B>Rôle :</B> <?= $user['role']; ?></p>
                    <p><B>Mail :</B> <?= $user['mail']; ?> </p>
                    <p><B>Telephone : </B><?= $user['telephone']; ?></p>
                    <p><B>Mot de passe : </B><?= $user['mdp']; ?></p>
                </div>
                <div class="user-actions">
                    <button class="noselect" type="submit" name="id" value="<?= $user['id']; ?>">Bannir</button>
                    <a href="../espace_admin/connexion/modifier_membre.php?id=<?= $user['id']; ?>">Modifier</a>
                </div>
            </div>
        </form>
        <?php
    }
    $recupUsers->closeCursor();
    ?>
    <br>
    <div class="position_btn">
    <a href="../espace_admin/index.php" class="bn1234 bn34"><- Retour</a>
    </div>
</a>
</section>
</main>

<div class="bar-sp"></div>
<footer>
  <p>© FATALYS 2023 - 2024</p>
</footer>
<script src="../JS/navbar.js"></script>
<script src="../JS/buttom.js"></script>
</body>
</html>
