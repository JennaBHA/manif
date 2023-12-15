<?php
session_start();
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/style_admin/index.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <title>Home</title>
</head>
<body>
    <!-- début menu -->
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
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

    <!-- Début activité -->
  <main class="main-content" role="main">
    <h1> Tableau de bord </h1>
    <br>
    <div class="latest-activities">
    <h2>Dernières activités publiées :</h2>
    <?php
    // Connexion à la base de données (assurez-vous que cette partie est correcte)
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

    // Requête pour récupérer les dernières activités (par exemple, les 5 dernières)
    $query = $bdd->query('SELECT titre, description, date, heure, responsable FROM activite ORDER BY date DESC LIMIT 3');

    // Boucle pour afficher les activités
    while ($activite = $query->fetch()) {
        echo '<div class="activite" style="border: 1px solid black">';
        echo '<h3>' . $activite['titre'] . '</h3>';
        echo '<p>' . $activite['description'] . '</p>';
        echo '<p>' . $activite['date'] . '</p>';
        echo '<p>' . $activite['heure'] .'</p>';
        // echo '<p>' . $activite['responsable'] . '</p>';
        echo '</div>';
    }
    ?>
    <!-- Début bouton -->
        <button type="button" class="button_act">
        <a href="../espace_admin/activite/activite.php" class="button_act" id="btn">
            <span class="button__act">Afficher plus</span>
            <span class="button__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                <line y2="19" y1="5" x2="12" x1="12"></line>
                <line y2="12" y1="12" x2="19" x1="5"></line>
            </svg>
            </span>
        </a>
        </button>
        </div>
        <!-- Fin Bouton -->
        <!-- fin Activité -->

    <!-- Début Participant -->
    <div class="latest-membre">
    <h2>Dernièrs membre inscrit :</h2>
    <?php
    // Connexion à la base de données (assurez-vous que cette partie est correcte)
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

    // Requête pour récupérer les dernières activités (par exemple, les 5 dernières)
    $query = $bdd->query('SELECT nom, prenom, mail, telephone FROM participant LIMIT 3');
    // Boucle pour afficher les activités
    while ($activite = $query->fetch()) {
        echo '<div class="membre" style="border: 1px solid black">';
        echo '<h3>' . $activite['nom'] . '</h3>';
        echo '<p>' . $activite['prenom'] . '</p>';
        echo '<p>' . $activite['mail'] . '</p>';
        echo '<p>' . $activite['telephone'] .'</p>';
        echo '</div>';
    }
    ?>
    <!-- Début Bouton -->
    <button type="button" class="button_membre">
    <a href="membre.php" class="button_membre" id="btn_membre">
    <span class="button__membre">Afficher plus</span>
    <span class="button__icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
        <line y2="19" y1="5" x2="12" x1="12"></line>
        <line y2="12" y1="12" x2="19" x1="5"></line>
      </svg>
    </span>
  </a>
</button>
</div>
    <!-- Fin Bouton -->
</main>
    <!-- Fin activité -->
</body>
<script src="../JS/script_menu.js"></script>
</html>
