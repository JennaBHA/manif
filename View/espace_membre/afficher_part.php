<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!isset($_SESSION['mdp'])) {
    header('Location: ../connexion/connexion.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/footer.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <link rel="stylesheet" href="../style/style_membre/afficher_part.css">
    <title>Afficher les activités</title>
</head>
<body>
    <!-- début menu -->
    <header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
        <a href="index.php">Accueil</a>
        <a href="afficher_part.php" >Activité</a>
        <a href="../espace_membre/connexion/deconnexion.php">Déconnexion</a>
    </nav>
</header>
    <!-- fin menu -->
   
    <div class="affichage">
        <div class="test">
        <div class="main" id="main">
        <?php
        $recupAct = $bdd->query('SELECT * FROM activite');
        while ($activite = $recupAct->fetch()) {
            $isInscrit = false;

            if (isset($_SESSION['id'])) {
                $participant_id = $_SESSION['id'];
                $checkInscription = $bdd->prepare('SELECT * FROM inscription WHERE participant_id = ? AND activite_id = ?');
                $checkInscription->execute([$participant_id, $activite['id']]);
                $isInscrit = ($checkInscription->rowCount() > 0);
            }
            ?>
            <div class="activite">
                <h1><?= $activite['titre']; ?></h1> 
                <p>Description : <?= $activite['description']; ?></p> 
                <p>Date : <?= $activite['date']; ?></p>
                <p>Heure : <?= $activite['heure']; ?></p>
                <p>Responsable : <?= $activite['responsable']; ?></p>
                <p>Nombre de participants : <?= $activite['participants']; ?></p>
                <p>Horaire : <?= $activite['horaire']; ?></p>
                <?php if ($isInscrit): ?>
                    <button class="deja_inscrit" onclick="alert('Vous êtes déjà inscrit à cette activité')">Déjà inscrit</button>
                    <a href="../espace_membre/desinscription.php?id=<?= $activite['id']; ?>">
                        <button class="desinscription" onclick="alert('Vous vous êtes désinscrit de l\'activité')">Se désinscrire</button>
                    </a>
                <?php else: ?>
                    <a href="../espace_membre/participation.php?id=<?= $activite['id']; ?>">
                        <button class="bouton_participer" onclick="alert('Votre participation a été prise en compte')">Participer</button>
                    </a>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>
        </div>
        </div>
    </div>
</body>
</html>
