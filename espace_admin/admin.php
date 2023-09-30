<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
}

// Vérifier si l'utilisateur est un administrateur
$utilisateur_id = $_SESSION['utilisateur_id'];
$query_admin = $bdd->prepare("SELECT est_admin FROM utilisateurs WHERE id = ?");
$query_admin->execute([$utilisateur_id]);
$utilisateur = $query_admin->fetch();

if (!$utilisateur || $utilisateur['est_admin'] != 1) {
    header('Location: accueil.php'); // Rediriger vers la page d'accueil par exemple
    exit();
}

// Récupérer les participations à afficher
$participations_query = $bdd->query('SELECT * FROM participations');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
</head>
<body>
    <h1>Liste des Participations</h1>
    <table>
        <tr>
            <th>Nom de l'Activité</th>
            <th>Nom de l'Utilisateur</th>
        </tr>
        <?php
        while ($participation = $participations_query->fetch()) {
            echo '<tr>';
            echo '<td>' . $participation['nom_activite'] . '</td>';
            echo '<td>' . $participation['nom_utilisateur'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
