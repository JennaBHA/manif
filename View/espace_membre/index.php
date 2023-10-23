<?php
// Sécuriser le site pour que seule l'admin puisse y accéder
session_start();
if (!$_SESSION['mdp']) {
    header('Location: connexion.php');
}

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

// Récupérer le prénom de l'utilisateur connecté
$id = $_SESSION['id']; // Assurez-vous que $_SESSION['id'] contient l'ID de l'utilisateur connecté
$query = $bdd->prepare("SELECT prenom FROM participant WHERE id = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$prenom = $result['prenom'];
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/index_membre.css rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <!-- Debut menu -->
    <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li><a href="../espace_admin/membre.php">Afficher les membres</a></li>
                <li><a href="../espace_admin/activite/activite.php">Afficher les participations</a></li>
                <li><a href="../espace_admin/update/publier_act.php">Publier une nouvelle activité</a></li>
                <li><a href="../espace_admin/activite/activite.php">Afficher les activités</a></li>
                <li><a href="../espace_admin/connexion/connexion.php">Deconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
    </header>

    <h1>Bienvenue dans votre espace <?php echo $prenom; ?></h1>

    <!-- Le reste de votre contenu -->
</body>
</html>
