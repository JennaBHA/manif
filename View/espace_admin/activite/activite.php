<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(!$_SESSION['mdp']){
    header('Location: ../espace_admin/connexion/connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style/style_admin/afficher_act.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <title>Afficher les activités</title>
</head>
<body>

     <!-- début menu -->
    <header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
            <a href="../index.php">Accueil</a>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Activité</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="activite.php">Afficher</a>
                    <a href="../update/publier_act.php">Publier</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../membre.php">Participant</a>
                    <a href="../update/gerer_participant.php">Participation</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Responsable</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../../espace_resp/responsable.php">Afficher</a>
                    <a href="../update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../connexion/deconnexion.php">Déconnexion</a>
        </nav>
    </header>
    <!-- fin menu -->
<div class="main" id="main">
  <div class="card">
    <?php
    $recupAct = $bdd->query('SELECT * FROM activite');
    while ($activite = $recupAct->fetch()) {
        ?>
        <div class="activite" style="border: 1px solid black">
            <h2><?= $activite['titre']; ?></h2>
            <p><?= $activite['description']; ?></p>
            <p>Date : <?= $activite['date']; ?></p> 
            <p>Heure : <?= $activite['heure']; ?></p>
            <p>Responsable : <?= $activite['responsable']; ?></p>
            <br>

            <a href="../update/supprimer_act.php?id=<?= $activite['id']; ?>">
                <button class="supprimer" role="button">Supprimer</button>
            </a>
            <a href="../update/modifier_act.php?id=<?= $activite['id']; ?>">
                <button class="modifier" role="button">Modifier</button>
            </a>
        </div>
        <br>
        <?php
    }
    ?>
    </div>
    <a href="../index.php" class="bn1234 bn34"><- Retour</a>
</a>
</div>
</main>

<div class="bar-sp"></div>
<footer>
<p>© FATALYS 2023 - 2024</p>
</footer>

<script src="../../JS/navbar.js"></script>
<script src="../../JS/buttom.js"></script>
</body>
</html>