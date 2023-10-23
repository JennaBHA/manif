<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];

    $recupAct = $bdd->prepare('SELECT * FROM activite WHERE id = ?');
    $recupAct->execute(array($getid));

    if ($recupAct->rowCount() > 0) {
        $activiteInfo = $recupAct->fetch();
        $titre = $activiteInfo['titre'];
        $description = str_replace('<br />', '', $activiteInfo['description']);
        $date = $activiteInfo['date'];

        if (isset($_POST['valider'])) {
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $description_saisi = nl2br(htmlspecialchars($_POST['description']));
            $nouvelle_heure = $_POST['creneau']; // Récupérez la nouvelle heure entrée par l'utilisateur.

            // Modifiez l'activité en incluant l'heure dans la requête.
            $updateAct = $bdd->prepare('UPDATE activite SET titre = ?, description = ?, date = ? WHERE id = ?');
            $updateAct->execute(array($titre_saisi, $description_saisi, $nouvelle_heure, $getid));
            header('Location: ../activite/activite.php');
        }
    } else {
        echo "Aucun article trouvé";
    }
} else {
    echo "Aucun identifiant trouvé";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/modifier_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/card.css">
    <title>Modifier l'article</title>
</head>
<body>

<div class="card">
        <h1>Modifier une activité</h1>
        <form method="post">
            <input type="text" name="titre" value="<?= $titre; ?>">
            <br><br>
            <textarea name="description"><?= $description ?></textarea>
            <br>
            <input type="time" name="creneau" value="<?= $date ?>">
            <div class="button-container">
                <button class="button" type="submit" name="valider">Modifier</button>
                <a href="../activite.php" class="button" id="btn">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>

