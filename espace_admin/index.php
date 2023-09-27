<?php
session_start();
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="membre.php">Afficher tous les membres</a>
    <a href="publier_act.php">Publier une nouvelle activité</a>
    <a href="activite.php">afficher les activités</a>
</body>
</html>