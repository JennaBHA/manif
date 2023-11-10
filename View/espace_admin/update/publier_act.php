<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if (!isset($_SESSION['mdp'])) {
    header('Location: ../espace_admin/connexion/connexion.php');
    exit;
}

$message = '';
$responsables = array();

$requeteResponsables = $bdd->query('SELECT nom FROM responsable');
while ($responsable = $requeteResponsables->fetch()) {
    $responsables[] = $responsable['nom'];
}

if (isset($_POST['envoie'])) {
    if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['date'])) { // Ajout de la vérification de la date
        $titre = htmlspecialchars($_POST['titre']);
        $description = nl2br(htmlspecialchars($_POST['description']));
        $date = date('Y-m-d', strtotime($_POST['date']));
        $heure = empty($_POST['creneau']) ? null : $_POST['creneau'];

        $responsable = $_POST['responsable'];

        $inserAct = $bdd->prepare('INSERT INTO activite(titre, description, date, heure, responsable) VALUES(:titre, :description, :date, :heure, :responsable)');
        $inserAct->execute(array(':titre' => $titre, ':description' => $description, ':date' => $date, ':heure' => $heure, ':responsable' => $responsable));

        $message = '<p style="color: green;">L\'activité a bien été envoyée</p>';
    } else {
        $message = '<p style="color: red;">Veuillez compléter tous les champs</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/publier_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/card.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <title>Publier une activité</title>
</head>
<body>
    <div class="ajout">
        <h1>Publier une activité</h1>
        <form method="post">
            <p><B>Titre de l'activité :</B></p>
            <input type="text" name="titre" placeholder="Titre" required>
            <br><br>
            <p><B>Description de l'activité</B></p>
            <textarea name="description" placeholder="Description" required></textarea>
            <br>
            <p><B>Responsable de l'activité :</B></p>
            <select name="responsable" id="monselect" required>
                <?php foreach ($responsables as $responsable) : ?>
                    <option value="<?php echo $responsable; ?>"><?php echo $responsable; ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <p><B>Date : </B></p>
            <input type="date" name="date" required>
            <br><br>
            <p><B>Heure :</B></p>
            <input type="time" name="creneau" autocomplete="off" placeholder="Créneau">
            <br><br>
            <div class="envoie-activite-container">
    <button class="envoie" type="submit" name="envoie" style="text-decoration: none;">Envoie</button>
    <a href="../activite/activite.php" class="envoie-act" style="text-decoration: none;">Activité</a>
</div>

        </form>
    </div>
    <div id="message-container">
        <?php
        if (!empty($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
