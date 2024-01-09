<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: ../connexion/connexion.php');
    exit();
}

$responsable_id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style/style_resp/participation.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <title>Activités auxquelles je participe</title>
</head>
<body>

   <!-- début du menu -->
        <header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
        <a href="../index.php">Accueil</a>
        <a href="../update/participation.php" >Participation</a>
        <a href="../update/activite.php" >Activité</a>
        <a href="../connexion/connexion.php">Déconnexion</a>
    </nav>
</header>
    <!--Fin du menu-->
    <main class="body_participation_resp">
        <div class="container">
            <div class="test">
            <h2>Mes activités en tant que responsable</h2>

            <?php
            $recupActivites = $bdd->prepare('SELECT activite.id, activite.titre, activite.description, activite.date, activite.heure
                                            FROM activite
                                            WHERE activite.responsable = ?');
            $recupActivites->execute([$responsable_id]);

            while ($activite = $recupActivites->fetch()) {
                ?>
                <div class="activite-card">
                    <h3><?= $activite['titre']; ?></h3>
                    <p><?= $activite['description']; ?></p>
                    <p>Date : <?= $activite['date']; ?></p>
                    <p>Heure : <?= $activite['heure']; ?></p>
                    <a href="../update/modifier_act.php?id=<?= $activite['id']; ?>">Modifier</a>
                </div>
                <?php
            }
            ?>
</div>
        </div>

        <div class="bar-sp"></div>
        <footer>
            <p>© FATALYS 2023 - 2024</p>
        </footer>
    </main>

    <script src="../../JS/navbar.js"></script>
    <script src="../../JS/buttom.js"></script>
</body>
</html>
