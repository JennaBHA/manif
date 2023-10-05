<?php
// Sécuriser le site pour que seule l'admin puisse y accéder
session_start();
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/index_admin.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <!-- Menu en haut -->
    <ul class="menu">
        <li><a href="../espace_admin/membre.php">Afficher les membres</a></li>
        <li><a href="../espace_membre/participation.php">Afficher les participations</a></li>
        <li><a href="publier_act.php">Publier une nouvelle activité</a></li>
        <li><a href="activite.php">Afficher les activités</a></li>
        <li><a href="../espace_membre/deconnexion.php">deconnexion</a></li>
    </ul>

    <h1>Bienvenu dans votre espace Administrateur</h1>

    <!-- Le reste de votre contenu -->
</body>
</html>
