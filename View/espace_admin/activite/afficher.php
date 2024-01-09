<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion/connexion.php');
}

if (isset($_GET['id'])) {
    $activite_id = $_GET['id'];

    $activite_query = $bdd->prepare("SELECT * FROM activite WHERE id = ?");
    $activite_query->execute([$activite_id]);
    $activite = $activite_query->fetch();

    $activite_id = 123; 
    $stmt = $pdo->prepare("SELECT u.nom, u.prenom FROM inscription_activite AS ia JOIN utilisateur AS u ON ia.utilisateur_id = u.id WHERE ia.activite_id = ?");
    $stmt->bindParam(1, $activite_id, PDO::PARAM_INT);
    $stmt->execute();

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
