<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleteUser = $bdd->prepare('DELETE FROM participant WHERE id = ?');
    if ($deleteUser->execute([$id])) {
        header('Location: ../espace_admin/membre.php');
        exit;
    } else {
        echo "Erreur : Impossible de supprimer l'utilisateur.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_admin/afficher_membre.css">
    <title>Afficher tous les membres</title>
</head>
<body>
    <h1>Liste des membres</h1>
    <?php
    $recupUsers = $bdd->query('SELECT id, prenom, nom, mdp, role FROM participant');
    while ($user = $recupUsers->fetch()) {
        ?>
        <form action="" method="post">
            <div class="user-card">
                <div class="user-info">
                    <p><?= $user['prenom']; ?> <?= $user['nom']; ?></p>
                    <p>Rôle : <?= $user['role']; ?></p>
                </div>
                <div class="user-actions">
                    <button class="noselect" type="submit" name="id" value="<?= $user['id']; ?>">Bannir</button>
                    <a href="../espace_admin/connexion/modifier_membre.php?id=<?= $user['id']; ?>">Modifier</a>
                </div>
            </div>
        </form>
        <?php
    }
    $recupUsers->closeCursor();
    ?>
    <br>
    <a href="../espace_admin/index.php" style="text-decoration: none; font-weight: bold; margin-bottom: 10px; display: block;">Retour</a>
</body>
</html>
