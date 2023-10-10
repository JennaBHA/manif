<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
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
    while($activite = $recupAct->fetch()){
        ?>
        <div class="activite" style="border: 1px solid black">
            <h1><?= $activite['titre'];?></h1> <!--Afficher le titre de la base de donnée quand on ajoute une activité-->
            <p><?= $activite['description'];?></p> <!--Afficher la description de la base de donnée quand on ajoute une actvité-->
            <p><?= $activite['date'];?></p>
            <a href="supprimer_act.php?id=<?= $activite['id']; ?>">
                <button style="color: black; background-color: red;">Supprimer l'activite</button>
            </a>
            <a href="modifier_act.php?id=<?= $activite['id']; ?>">
                <button style="color: black; background-color: yellow;">modifier l'activite</button>
            </a>
            <!-- <button style="color: black; background-color: yellow;">Modicier l'article</button> -->
        </div>
        <br>
        <?php
    }
    ?>
    <a href="../espace_admin/index.php" class="envoie-button">retour</a>
</body>
</html>