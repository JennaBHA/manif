<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(!$_SESSION['mdp']){
    header('Location: ../espace_admin/connexion/connexion.php');
}

if(isset($_POST['envoie'])) {
    if(!empty($_POST['titre']) AND !empty($_POST['description'])) { 
        $titre = htmlspecialchars($_POST['titre']);
        $description = nl2br(htmlspecialchars($_POST['description']));

        $inserAct = $bdd->prepare('INSERT INTO activite(titre, description) VALUES(?, ?)');
        $inserAct->execute(array($titre, $description));

        $message = '<p style="color: green;">L\'activité a bien été envoyé</p>';
    } else {
        $message = '<p style="color: red;">Veuillez compléter tous les champs</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/publier_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <title>Publier une activité</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Publier une activité</h1>
        <input type="text" name="titre" placeholder="Titre">
        <br>
        <textarea name="description" placeholder="Description"></textarea>
        <br>
        <input type="time" name="creneau" autocomplete="off" placeholder="Créneau">
        <br><br>
        <div class="button-container">
            <button class="button" type="submit" name="envoie">Envoie</button>
            <a href="../index.php" class="button" id="btn">Retour</a>
        </div>
    </form>
    
    <button class="button1" role="button">Activité -&gt;</button>

    <!-- Message container -->
    <div id="message-container">
        <?php
        if(isset($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
