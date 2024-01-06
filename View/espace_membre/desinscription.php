<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit();
}

if (!isset($_SESSION['mdp'])) {
    header('Location: ../connexion/connexion.php');
    exit();
}

if (isset($_GET['id'])) {
    $activite_id = $_GET['id'];
    $participant_id = $_SESSION['id'];

    // Vérifier si le participant est inscrit
    $checkInscription = $bdd->prepare('SELECT * FROM inscription WHERE participant_id = ? AND activite_id = ?');
    $checkInscription->execute([$participant_id, $activite_id]);

    if ($checkInscription->rowCount() > 0) {
        // Le participant est inscrit, donc le désinscrire
        $deleteInscription = $bdd->prepare('DELETE FROM inscription WHERE participant_id = ? AND activite_id = ?');
        $deleteInscription->execute([$participant_id, $activite_id]);

        // Mettre à jour le nombre de participants dans la table activite
        $updateParticipants = $bdd->prepare('UPDATE activite SET participants = participants - 1 WHERE id = ?');
        $updateParticipants->execute([$activite_id]);
    }

    header('Location: afficher_part.php');
    exit();
}
?>

