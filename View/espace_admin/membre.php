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
                    <a href="../espace_admin/update/modifier_act.php">Modifier</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="membre.php">Participant</a>
                    <a href="#">Participation</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Responsable</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../espace_resp/responsable.php">Afficher</a>
                    <a href="../../espace_admin/update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../espace_membre/connexion/deconnexion.php">Déconnection</a>
        </nav>
    </header>
    <!-- fin menu -->

    <section class="membre">
        <div class="membre-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Liste des membres</b></p>
            <a href="#main" class="bn3637 bn37">Explorer</a>
        </div>
    </section>
    
    <main class="test">
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
    <a href="../espace_admin/index.php">
  <button class="button_retour">
    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
      <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
    </svg>
    <span><B>Retour</B> </span>
  </button>
</a>
</section>
</main>

<div class="bar-sp"></div>
<footer>
  <p>© FATALYS 2023 - 2024</p>
</footer>
<script src="../JS/navbar.js"></script>
</body>
</html>
