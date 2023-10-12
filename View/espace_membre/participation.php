<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit();
}

if (isset($_GET['id'])) {
    $activite_id = $_GET['id'];
    // Assurez-vous que la variable de session 'utilisateur_id' est correctement initialisée ailleurs dans votre application.
    if(isset($_SESSION['utilisateur_id'])){
        $utilisateur_id = $_SESSION['utilisateur_id'];
        // Assurez-vous que la table 'participations' possède une colonne 'activite_id' et une colonne 'utilisateur_id'.
        $insert_query = $bdd->prepare("INSERT INTO participations (activite_id, utilisateur_id) VALUES (?, ?)");
        $insert_query->execute([$activite_id, $utilisateur_id]);
        echo "Bien jouer";
        exit();
    } else {
        echo "aucun identifiant trouver";
        // Gérer le cas où 'utilisateur_id' n'est pas défini dans la session.
        // Vous pouvez rediriger l'utilisateur vers une page d'erreur ou effectuer une autre action appropriée.
        // header('Location: erreur.php');
        exit();
    }
} else {
    header('Location: afficher_part.php');
    exit();
}
?>
