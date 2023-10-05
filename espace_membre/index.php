<?php
// Sécuriser le site pour que seule l'admin puisse y accéder
session_start();
if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/index_admin.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <!-- Menu en haut -->
    <ul class="menu">
        <li><a href="../espace_membre/afficher_part.php"><!-- A FAIRE !! -->Afficher les activités</a></li>
        <li><a href="../espace_admin/deconnexion.php">deconnexion</a></li>
    </ul>

    <h1>Bienvenu dans votre espace Membre</h1>

    <!-- Le reste de votre contenu -->
</body>
</html>
