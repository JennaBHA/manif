<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}

if(isset($_POST['envoie'])) {
    if(!empty($_POST['titre']) AND !empty($_POST['description'])) { 
        $titre = htmlspecialchars($_POST['titre']);
        $description = nl2br(htmlspecialchars($_POST['description']));

        $inserAct = $bdd->prepare('INSERT INTO activite(titre, description) VALUES(?, ?)');
        $inserAct->execute(array($titre, $description));

        echo "L'activité a bien été envoyé"; 
    } else {
        echo "Veuillez compléter tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/publier_act.css">
    <title>Publier une activité</title>
</head>
<body>
    <form method="POST" action="">
    <h1>Modifier l'activité</h1>
    <input type="text" name="titre" placeholder="Titre">
        <br>
        <textarea name="description" placeholder="Description"></textarea>
        <br>
        <input type="date" name="creneau" autocomplete="off" placeholder="creneau">
        <br><br>
        <input type="submit" name="envoie">
        <a href="index.php" class="envoie-button">Retour</a>
    </form>
</body>
</html>
