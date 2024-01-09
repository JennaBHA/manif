<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion/connexion.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['heure']) && isset($_POST['activite_id'])) {
        $heure = $_POST['heure'];
        $activite_id = $_POST['activite_id'];

        $updateHeure = $bdd->prepare('UPDATE activite SET heure = :heure WHERE id = :id');
        $updateHeure->bindParam(':heure', $heure);
        $updateHeure->bindParam(':id', $activite_id);
        $updateHeure->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style/style_resp/activite.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/general.css"></head>
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
    <div class="main" id="main">
        <div class="card">
            <div class="test">
            <?php
            $recupAct = $bdd->query('SELECT * FROM activite');
            while ($activite = $recupAct->fetch()) {
                ?>
                <div class="activite" style="border: 1px solid white">
                    <h2><?= $activite['titre']; ?></h2>
                    <p><?= $activite['description']; ?></p>
                    <p>Date : <?= $activite['date']; ?></p>
                    <p>Heure : <?= $activite['heure']; ?></p>
                    <p>Responsable : <?= $activite['responsable']; ?></p>
                    <br>

                    <!-- Formulaire pour modifier l'heure -->
                    <form method="post" action="">
                        <label for="heure">Nouvelle heure :</label>
                        <input type="time" id="heure" name="heure" required>
                        <input type="hidden" name="activite_id" value="<?= $activite['id']; ?>">
                        <button type="submit">Modifier l'heure</button>
                    </form>

                    <a href="../update/supprimer_act.php?id=<?= $activite['id']; ?>">
                    </a>
                </div>
                <br>
                <?php
            }
            ?>
        </div>
        <a href="../index.php" class="bn1234 bn34"><- Retour</a>
    </div>
    </div>

    <script src="../../JS/script_menu.js"></script>
    <script src="../../JS/navbar.js"></script>
</body>
</html>
