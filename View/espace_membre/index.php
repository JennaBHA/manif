<?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit();
}

$isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

$id = $_SESSION['id']; 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/general.css">
    <link rel="stylesheet" href="../style/style_membre/index.css">
    <link rel="stylesheet" href="../style/general/bouton.css">

    <title>Home</title>
</head>
<body>

<header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
        <a href="index.php">Accueil</a>
        <a href="../espace_membre/afficher_part.php" >Activité</a>
        <a href="../espace_membre/connexion/deconnexion.php">Déconnexion</a>
    </nav>
</header>

<section class="index-admin">
    <div class="index-admin-content">
        <h1>Manifestation FATALYS</h1>
        <p><b>Bienvenue dans votre espace <?php echo $prenom; ?></b></p>
        <a href="../espace_membre/afficher_part.php" class="bn3637 bn37">Suivant -></a>
    </div>
</section>
</body>
</html>
