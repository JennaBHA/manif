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
    <title>Activités</title>
</head>
<body>
    <?php
    if(isset($_SESSION['inscription_reussie']) && $_SESSION['inscription_reussie']){
        echo '<p>Vous êtes bien inscrit à l\'activité.</p>';
        $_SESSION['inscription_reussie'] = false; // Réinitialisez la variable de session
    }
    
    $recupAct = $bdd->query('SELECT * FROM activite');
    while($activite = $recupAct->fetch()){
        // Votre code d'affichage des activités
    }
    ?>
</body>
</html>
