<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(!$_SESSION['mdp']){
    header('Location: ../espace_admin/connexion/connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/afficher_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <title>Afficher les activités</title>
</head>
<body>
    <h1>Liste des activités</h1>
    <?php
    $recupAct = $bdd->query('SELECT * FROM activite');
    while ($activite = $recupAct->fetch()) {
        ?>
        <div class="activite" style="border: 1px solid black">
            <h2><?= $activite['titre']; ?></h2>
            <p><?= $activite['description']; ?></p>
            <p>Heure : <?= $activite['date']; ?></p> <!-- Afficher l'heure associée à l'activité -->

            <a href="../update/supprimer_act.php?id=<?= $activite['id']; ?>">
                <button class="supprimer" role="button">Supprimer</button>
            </a>
            <a href="../update/modifier_act.php?id=<?= $activite['id']; ?>">
                <button class="modifier" role="button">Modifier</button>
            </a>
        </div>
        <br>
        <?php
    }
    ?>
    <br>
    <div class="button-container">
        <a href="../index.php" class="button" id="btn">Retour</a>
    </div>
</body>
</html>