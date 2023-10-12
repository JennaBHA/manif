<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: ../espace_admin/connexion/connexion.php');
    exit(); // Arrête l'exécution du script après la redirection
}

// Vérifier si l'utilisateur est un administrateur
$participant_id = $_SESSION['participant_id']; // Utilisez la variable correcte
$query_admin = $bdd->prepare("SELECT * FROM participant WHERE id = ?");
$query_admin->execute([$participant_id]); // Utilisez $participant_id au lieu de $id
$participant = $query_admin->fetch();

if (!$participant || $participant['id'] != 1) {
    header('Location: ../espace_admin/connexion/connexion.php');
    exit();
}

// Récupérer les participations à afficher
$participations_query = $bdd->query('SELECT * FROM participations'); // Assurez-vous que la table est correcte

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
