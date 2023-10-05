<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;' , 'root', '');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/afficher_membre.css">
    <title>Afficher tous les membres</title>
</head>
<body>
    <!-- début afficher tous les membres -->
    <?php
        $recupUsers = $bdd->query('SELECT * FROM participant');
        while($user = $recupUsers->fetch()){
            ?>
                <p><?= $user['prenom']; ?> <?= $user['nom']; ?> <a href="bannir.php?id=<?= $user['id']; ?>" style="color: red; text-decoration: none">Bannir le membre</a></p>
            <?php
        }
    ?>
    <!-- fin afficher tous les membres  -->
    <a href="../espace_admin/index.php" style="text-decoration: none; font-weight: bold; margin-bottom: 10px; display: block;">Retour</a>
</body>
</html>