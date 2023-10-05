<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit(); // Assurez-vous que le script se termine après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/afficher_act.css">
    <title>Afficher les activités</title>
</head>
<body>
    <?php
    $recupAct = $bdd->query('SELECT * FROM activite');
    while ($activite = $recupAct->fetch()) {
        ?>
        <div class="activite" style="border: 1px solid black">
            <h1><?= $activite['titre']; ?></h1> 
            <p><?= $activite['description']; ?></p> 
            <a href="../espace_admin/participer.php?id=<?= $activite['id']; ?>">
                <button style="color: black; background-color: red;" onclick="alert('Votre participation a été prise en compte')">Participer</button>
            </a>
        </div>
        <br>
        <?php
    }
    ?>
    <a href="../espace_membre/index.php" class="envoie-button">retour</a>
</body>
</html>