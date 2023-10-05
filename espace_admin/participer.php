<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
    exit; // Assurez-vous de quitter le script si la session n'est pas valide.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez d'abord si le formulaire a été soumis.

    // Récupérez les données du formulaire (nom et prénom de la personne participant).
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Vous devrez également récupérer l'ID de l'activité à partir de la requête, par exemple :
    $activite_id = $_GET['id'];

    // Ensuite, insérez ces données dans votre base de données.
    $insertion = $bdd->prepare('INSERT INTO participations (nom, prenom, activite_id) VALUES (?, ?, ?)');
    $insertion->execute([$nom, $prenom, $activite_id]);

    // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée.
    header('Location: confirmation_participation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez ici les balises meta, title, et les liens CSS -->
</head>
<body>
    <!-- Créez un formulaire pour collecter le nom et le prénom de la personne participant -->
    <form method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br>

        <input type="submit" value="Participer">
    </form>
</body>
</html>
