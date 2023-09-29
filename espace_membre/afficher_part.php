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
    <title>activité</title>
</head>
<body>
    <?php
    $recupAct = $bdd->query('SELECT * FROM activite');
    while($activite = $recupAct->fetch()){
        ?>

        <!-- ... (votre code existant) ... -->
<div class="activite" style="border: 1px solid black">
    <h1><?= $activite['titre']; ?></h1>
    <p><?= $activite['description']; ?></p>
    <a href="participation.php?id=<?= $activite['id']; ?>"> <!-- Lien vers le script d'inscription -->
        <button style="color: black; background-color: blue;">S'inscrire à l'activité</button>
    </a>
</div>
<br>
<!-- ... (votre code existant) ... -->

        <br>
        <?php
    }
    ?>
</body>
</html>