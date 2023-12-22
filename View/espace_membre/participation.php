<?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit(); // assurez-vous de terminer le script après la redirection
}

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');
    // Définissez le mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Récupérer le prénom de l'utilisateur connecté
$id = $_SESSION['id']; // Assurez-vous que $_SESSION['id'] contient l'ID de l'utilisateur connecté
try {
    $query = $bdd->prepare("SELECT prenom FROM participant WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    // Vérifiez si la requête a réussi avant d'accéder aux résultats
    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $prenom = $result['prenom'];
    } else {
        die('Aucun résultat trouvé pour cet utilisateur.');
    }
} catch (PDOException $e) {
    die('Erreur lors de la récupération du prénom : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à une activité</title>
</head>
<body>

<h1>Inscription à une activité</h1>

<form action="inscription.php" method="post">
    <label for="activiteId">S'inscrire à l'activité avec l'ID :</label>
    <input type="number" name="activiteId" required>
    <input type="submit" value="S'inscrire">
</form>

<form action="desinscription.php" method="post">
    <label for="activiteIdDes">Se désinscrire de l'activité avec l'ID :</label>
    <input type="number" name="activiteIdDes" required>
    <input type="submit" value="Se désinscrire">
</form>

</body>
</html>
