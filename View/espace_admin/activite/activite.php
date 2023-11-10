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
    <link rel="stylesheet" href="../../style/style_admin/afficher_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <title>Afficher les activités</title>
</head>
<body>

     <!-- début menu -->
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li class="dropdown">
                    <a href="gerer.php">Membres</a>
                    <div class="dropdown-content">
                        <a href="membre.php">Participant</a>
                        <a href="../espace_resp/responsable.php">Responsable</a>
                        <a href="#">Participation</a> <!-- A faire -->
                    </div>
                </li>
                <li class="dropdown">
                <a href="../espace_admin/activite/activite.php">Activités</a>
                    <div class="dropdown-content">
                        <a href="../espace_admin/update/publier_act.php">Publier une activite</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/ajouter_resp.php">Ajouter un responsable</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/publier_act.php">Publier une nouvelle activité</a>
                    </div>
                </li>
                <li><a href="../espace_admin/connexion/connexion.php">Déconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
  </header>
    <!-- fin menu -->

    <h1>Liste des activités</h1>
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
    <br>


    <a href="../index.php">
  <button class="button_retour">
    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
      <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
    </svg>
    <span><B>Retour</B> </span>
  </button>
</a>
</body>
</html>