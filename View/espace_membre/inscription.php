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

    // Vérifier si le participant est déjà inscrit
    $checkInscription = $bdd->prepare('SELECT * FROM inscription WHERE participant_id = ? AND activite_id = ?');
    $checkInscription->execute([$participant_id, $activite_id]);

    if ($checkInscription->rowCount() > 0) {
        // Le participant est déjà inscrit, donc l'inscrire
        echo "Vous êtes déjà inscrit à cette activité.";
    } else {
        // Le participant n'est pas inscrit, donc l'inscrire
        $insertInscription = $bdd->prepare('INSERT INTO inscription (participant_id, activite_id) VALUES (?, ?)');

        // Vérifier si l'insertion s'est bien déroulée pour éviter les erreurs
        if ($insertInscription->execute([$participant_id, $activite_id])) {
            // Mettre à jour le nombre de participants dans la table activite
            $updateParticipants = $bdd->prepare('UPDATE activite SET participants = participants + 1 WHERE id = ?');
            $updateParticipants->execute([$activite_id]);

            header('Location: afficher_part.php');
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}
?>
