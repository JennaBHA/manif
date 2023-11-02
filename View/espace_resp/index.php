<?php
session_start();
if (!$_SESSION['mdp']) {
    header('Location: ../espace_resp/connexion/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_resp/index.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <title>Home</title>
</head>
<body>
    <!-- début du menu -->
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li><a href="#">Afficher les participations</a></li>
                <li><a href="#">Afficher les activités</a></li>
                <li><a href="../espace_resp/connexion/deconnexion.php">Deconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
    </header>
        <!--Fin du menu-->
  <main class="main-content" role="main">
    <h1> Bienvenue dans votre espace Responsable </h1>
    <br>
</main>

</body>
<script src="../JS/script_menu.js"></script>
</html>