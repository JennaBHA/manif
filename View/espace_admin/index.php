<?php
session_start();
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/style_admin/index.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <title>Home</title>
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
                    <a href="../espace_admin/update/modifier_act.php">Modifier</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="gerer.php">Afficher</a>
                    <a href="membre.php">Participant</a>
                    <a href="#">Participation</a>
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



    <section class="index-admin">
        <div class="index-admin-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Venez découvrir nos différentes activités !</b></p>
            <a href="../espace_admin/activite/activite.php" class="bn3637 bn37">Suivant -></a>
        </div>
    </section>





        <!-- Responsable Dropdown -->
        <!-- <div class="dropdown">
            <button class="dropbtn">Responsable
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="membre.php">Afficher</a>
                <a href="../espace_admin/update/ajouter_resp.php">Ajouter</a>
            </div>
        </div>
        <a href="../espace_admin/connexion/deconnexion.php">Déconnexion</a>
    </div> -->
    <!-- fin menu -->

    <script src="../JS/navbar.js"></script>
</body>
</html>
