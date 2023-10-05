<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $activite_id = $_GET['id'];

    $insertion = $bdd->prepare('INSERT INTO participations (nom, prenom, activite_id) VALUES (?, ?, ?)');
    $insertion->execute([$nom, $prenom, $activite_id]);

    header('Location: confirmation_participation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<p>Vous êtes bien inscrit</p>
<a href="../espace_membre/index.php">retourner a l'accueil</a>
</body>
</html>
