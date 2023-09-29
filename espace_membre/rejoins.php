<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
}

if (isset($_GET['id'])) {
    $activite_id = $_GET['id'];
    $utilisateur_id = $_SESSION['id'];

    // Récupérer le nom de l'activité
    $query_activite = $bdd->prepare("SELECT titre FROM activite WHERE id = ?");
    $query_activite->execute([$activite_id]);
    $activite = $query_activite->fetch();

    // Récupérer le nom et prénom de l'utilisateur
    $query_utilisateur = $bdd->prepare("SELECT nom, prenom FROM participant WHERE id = ?");
    $query_utilisateur->execute([$utilisateur_id]);
    $utilisateur = $query_utilisateur->fetch();

    // Insérer l'inscription dans la table "participation"
    $insert_query = $bdd->prepare("INSERT INTO participations (activite_id, utilisateur_id, nom_activite, nom_utilisateur) VALUES (?, ?, ?, ?)");
    $insert_query->execute([$activite_id, $utilisateur_id, $activite['titre'], $utilisateur['nom'].' '.$utilisateur['prenom']]);

    // Rediriger l'utilisateur vers la page précédente
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    header('Location: afficher_part.php');
    exit();
}
?>
