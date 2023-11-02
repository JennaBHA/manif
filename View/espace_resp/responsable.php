<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleteUser = $bdd->prepare('DELETE FROM responsable WHERE id = ?');
    if ($deleteUser->execute([$id])) {
        header('Location: ../espace_admin/responsable.php');
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
    <link rel="stylesheet" href="../style/style_admin/responsable.css">
    <title>Afficher tous les responsables</title>
</head>
<body>
    <h1>Liste des responsables</h1>
    <?php
    $recupUsers = $bdd->query('SELECT id, nom, prenom, mdp, role FROM responsable');
    while ($user = $recupUsers->fetch()) {
        ?>
        <form action="" method="post">
            <div class="user-card">
                <div class="user-info">
                    <p> Nom : <?= $user['nom']; ?>  </p>
                    <p>Prénom : <?= $user['prenom']; ?></p>
                    <p>Mot de passe : <?= $user['mdp']; ?></p>
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
