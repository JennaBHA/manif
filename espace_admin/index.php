<?php
// Sécuriser le site pour que seule l'admin puisse y accéder
session_start();
if (!$_SESSION['mdp']) {
    header('Location: ../espace_admin/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style\index_admin.css">
    <link rel="stylesheet" href="..\style\navbar.css">
    <link rel="stylesheet" href="..\style\.css">
    <title>Home</title>
</head>
<body>
    <!--Menu-->
    <nav class="navbar dark-mode" role="navigation">
    <div class="navbar__logo"> <//?php $_SESSION['pseudo']; ?> Admin </div>    
    <ul class="navbar__links">
      <li class="navbar__link first"><a href="../espace_admin/membre.php">Afficher les membres</a></li>
      <li class="navbar__link third"><a href="../espace_admin/activite.php">Afficher les participations</a></li>
      <li class="navbar__link four"><a href="publier_act.php">Publier une nouvelle activité</a></li>
      <li class="navbar__link fifth"><a href="activite.php">Afficher les activités</a></li>
      <li class="navbar__link six"><a href="../espace_admin/deconnexion.php">deconnexion</a></li>
    </ul>   
    <button class="burger">
      <span class="bar"></span>  
    </button>   
  </nav>
  <main class="main-content" role="main">
    <h1> Bienvenue dans votre espace Administrateur </h1>
    <br>
    <!--Fin du menu-->
<!--------------------------------------------------------------------------------------------------------------------------------------->
<div class="latest-activities">
    <h2>Dernières activités publiées :</h2>
    <?php
    // Connexion à la base de données (assurez-vous que cette partie est correcte)
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

    // Requête pour récupérer les dernières activités (par exemple, les 5 dernières)
    $query = $bdd->query('SELECT titre, description, date FROM activite ORDER BY date DESC LIMIT 3');

    // Boucle pour afficher les activités
    while ($activite = $query->fetch()) {
        echo '<div class="activite" style="border: 1px solid black">';
        echo '<h3>' . $activite['titre'] . '</h3>';
        echo '<p>' . $activite['description'] . '</p>';
        echo '<p>' . $activite['date'] . '</p>';
        echo '</div>';
    }
    ?>
    <a href="activite.php">Afficher plus</a>
</div>
<!--------------------------------------------------------------------------------------------------------------------------------------->
<div class="latest-membre">
    <h2>Derniers participant inscrit :</h2>
    <?php
    // Connexion à la base de données (assurez-vous que cette partie est correcte)
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

    // Requête pour récupérer les dernières activités (par exemple, les 5 dernières)
    $query = $bdd->query('SELECT nom, prenom, mail, telephone FROM participant LIMIT 3');

    // Boucle pour afficher les activités
    while ($participant = $query->fetch()) {
        echo '<div class="participant" style="border: 1px solid black">';
        echo '<h3>' . $participant['nom'] . '</h3>';
        echo '<h3>' . $participant['prenom'] . '</h3>';
        echo '<h3>' . $participant['mail'] . '</h3>';
        echo '<p>' . $participant['telephone'] . '</p>';
        echo '</div>';
    }
    ?>
    <a href="membre.php">Afficher plus</a>
</div>

</main>

</body>
<script src="../JS/script_menu.js"></script>
</html>
