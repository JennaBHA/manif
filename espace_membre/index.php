<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <p>Bienvenue dans votre espace <?php echo isset($_SESSION['prenom']) ? $_SESSION['prenom'] : ''; ?></p>
    <a href="deconnexion.php">
        <button>Se déconnecter</button>
    </a>
</body>
</html>
