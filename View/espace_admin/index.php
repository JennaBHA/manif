<?php
// Sécuriser le site pour que seule l'admin puisse y accéder
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
    <link rel="stylesheet" href="../style/style_admin/index.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
    <title>Home</title>
</head>
<body>
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li><a href="../espace_admin/membre.php">Afficher les membres</a></li>
                <li><a href="../espace_resp/responsable.php">Afficher les responsables</a></li>
                <li><a href="../espace_admin/activite/activite.php">Afficher les participations</a></li>
                <li><a href="../espace_admin/activite/activite.php">Afficher les activités</a></li>
                <li><a href="../espace_admin/update/ajouter_resp.php">Ajouter un responsable</a></li>
                <li><a href="../espace_admin/update/publier_act.php">Publier une nouvelle activité</a></li>
                <li><a href="../espace_admin/connexion/connexion.php">Deconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
    </header>
  <main class="main-content" role="main">
    <h1> Bienvenue dans votre espace Administrateur </h1>
    <br>
    <!--Fin du menu-->
<!--------------------------------------------------------------------------------------------------------------------------------------->
<!-- <div class="latest-activities">
    <h2>Dernières activités publiées :</h2>
    <//?php
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
    <a href="../espace_admin/activite/activite.php">Afficher plus</a>
</div> -->
<!--------------------------------------------------------------------------------------------------------------------------------------->
<!-- <div class="latest-membre">
    <h2>Derniers participant inscrit :</h2>
    <//?php
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
    <a href="../espace_admin/membre.php">Afficher plus</a>
</div> -->

</main>

</body>
<script src="../JS/script_menu.js"></script>
</html>
