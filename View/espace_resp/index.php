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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/footer.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <link rel="stylesheet" href="../style/style_resp/index.css">
    <title>Home</title>
</head>
<body>
    <!-- début du menu -->
        <header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
        <a href="index.php">Accueil</a>
        <a href="../espace_resp/update/participation.php" >Participation</a>
        <a href="../espace_resp/update/activite.php" >Activité</a>
        <a href="../espace_resp/connexion/connexion.php">Déconnexion</a>
    </nav>
</header>
    <!--Fin du menu-->

    <section class="index_resp">
        <div class="index_resp-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Liste des activités</b></p>
            <a href="javascript:void(0);" class="bn3637 bn37" onclick="scrollToMain()">Explorer</a>
        </div>
    </section>

</body>
<script src="../JS/script_menu.js"></script>
</html>