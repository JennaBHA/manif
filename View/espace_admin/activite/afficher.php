<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion/connexion.php');
}

if (isset($_GET['id'])) {
    $activite_id = $_GET['id'];

    // Récupérer les informations sur l'activité
    $activite_query = $bdd->prepare("SELECT * FROM activite WHERE id = ?");
    $activite_query->execute([$activite_id]);
    $activite = $activite_query->fetch();

    // Récupérer la liste des participants
    $participants_query = $bdd->prepare("SELECT utilisateur.nom, utilisateur.prenom FROM inscription_activite 
                                         JOIN utilisateur ON inscription_activite.utilisateur_id = utilisateur.id 
                                         WHERE inscription_activite.activite_id = ?");
    $participants_query->execute([$activite_id]);
    $participants = $participants_query->fetchAll();
} else {
    header('Location: afficher_part.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants à l'activité</title>
</head>
<body>
    <h1><?= $activite['titre']; ?></h1>
    <p><?= $activite['description']; ?></p>
    <h2>Participants :</h2>
    <ul>
        <?php foreach ($participants as $participant) : ?>
            <li><?= $participant['prenom'] . ' ' . $participant['nom']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
