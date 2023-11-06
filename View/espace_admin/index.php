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
    <link rel="stylesheet" href="../style/style_admin/index.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <title>Home</title>
</head>
<body>
    <!-- début menu -->
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li class="dropdown">
                    <a href="gerer.php">Membres</a>
                    <div class="dropdown-content">
                        <a href="membre.php">Participant</a>
                        <a href="../espace_resp/responsable.php">Responsable</a>
                        <a href="#">Participation</a> <!-- A faire -->
                    </div>
                </li>
                <li class="dropdown">
                <a href="../espace_admin/activite/activite.php">Activités</a>
                    <div class="dropdown-content">
                        <a href="../espace_admin/update/publier_act.php">Publier une activite</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/ajouter_resp.php">Ajouter un responsable</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/publier_act.php">Publier une nouvelle activité</a>
                    </div>
                </li>
                <li><a href="../espace_admin/connexion/connexion.php">Déconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
  </header>
    <!-- fin menu -->

  <main class="main-content" role="main">
    <h1> Tableau de bord </h1>
    <br>

    

  </main>
</body>
<script src="../JS/script_menu.js"></script>
</html>
