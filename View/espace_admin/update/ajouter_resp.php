<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if (!isset($_SESSION['mdp'])) {
    header('Location: ../espace_admin/connexion/connexion.php');
    exit;
}

$message = '';
// Créez un tableau vide pour stocker la liste des responsables.
$responsables = array();

// Récupérez la liste des responsables depuis la base de données.
$requeteResponsables = $bdd->query('SELECT nom FROM responsable');
while ($responsable = $requeteResponsables->fetch()) {
    $responsables[] = $responsable;
}

if (isset($_POST['envoie'])) {
    if (!empty($_POST['nom']) && !empty($_POST['role']) && !empty($_POST['mdp'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $role = htmlspecialchars($_POST['role']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hash du mot de passe

        $inserAct = $bdd->prepare('INSERT INTO responsable(nom, role, mdp) VALUES(:nom, :role, :mdp)');
        $inserAct->execute(array(':nom' => $nom, ':role' => $role, ':mdp' => $mdp));

        $message = '<p style="color: green;">Le responsable a bien été ajouté</p>';
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
    <link rel="stylesheet" href="../../style/general/card.css">
    <title>Ajouter responsable</title>
</head>
<body>
    <div class="card">
        <h1>Ajouter un responsable</h1>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom">
            <br><br>
            <input type="text" name="role" placeholder="Rôle">
            <br><br>
            <input type="password" name="mdp" placeholder="Mot de passe">
            <br><br>
            <div class="button-container">
                <button class="button" type="submit" name="envoie">Envoie</button>
                <a href="../index.php" class="button" id="btn">Retour</a>
            </div>
        </form>
    </div>
    
    <a href="../activite/activite.php" class="button1" role="button">Activité -&gt;</a>
    <!-- Message container -->
    <div id="message-container">
        <?php
        if (!empty($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
        