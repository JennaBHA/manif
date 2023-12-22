<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

// Définir des valeurs par défaut
$titre = '';
$description = '';
$date = '';
$responsable = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];

    $recupAct = $bdd->prepare('SELECT * FROM activite WHERE id = ?');
    $recupAct->execute(array($getid));

    if ($recupAct->rowCount() > 0) {
        $activiteInfo = $recupAct->fetch();
        $titre = $activiteInfo['titre'];
        $description = str_replace('<br />', '', $activiteInfo['description']);
        $date = $activiteInfo['date'];
        $responsable = $activiteInfo['responsable'];

        // Récupération des noms des responsables depuis la base de données
        $recupResponsables = $bdd->query('SELECT nom FROM responsable');
        $responsables = $recupResponsables->fetchAll(PDO::FETCH_COLUMN);
        $recupResponsables->closeCursor();

        if (isset($_POST['valider'])) {
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $description_saisi = nl2br(htmlspecialchars($_POST['description']));
            $nouvelle_date = date('Y-m-d', strtotime($_POST['date']));
            $nouveau_responsable = $_POST['responsable'];

            $updateAct = $bdd->prepare('UPDATE activite SET titre = ?, description = ?, date = ?, responsable = ? WHERE id = ?');
            $updateAct->execute(array($titre_saisi, $description_saisi, $nouvelle_date, $nouveau_responsable, $getid));
            header('Location: ../activite/activite.php');
        }
    } else {
        echo "Aucun article trouvé";
    }
}
// }else {
//     echo "Aucun identifiant trouvé";
//  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style/style_admin/modifier_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/card.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <title>Modifier l'article</title>
</head>
<body>

<!-- début menu -->
<header class="header">
    <a class="logo">FATALYS</a>
    <nav class="navbar">
            <a href="../index.php">Accueil</a>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Activité</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../activite/activite.php">Afficher</a>
                    <a href="publier_act.php">Publier</a>
                    <a href="modifier_act.php">Modifier</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../membre.php">Participant</a>
                    <a href="#">Participation</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Responsable</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../../espace_resp/responsable.php">Afficher</a>
                    <a href="../../espace_admin/update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../connexion/deconnexion.php">Déconnection</a>
        </nav>
    </header>
    <!-- fin menu -->

    <section class="modifier-act">
        <div class="modifier-act-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Modification des activités</b></p>
            <a href="#main" class="bn3637 bn37">Explorer</a>
        </div>
    </section>


    <div class="container">
    <div class="main" id="main">
    <div class="card">
    <form method="post" class="card-form">        
        <p><b>Titre</b></p>
        <input type="text" name="titre" value="<?= $titre; ?>">
        <br><br>
        <p><b>Description</b></p>
        <textarea name="description"><?= $description ?></textarea>
        <br><br>
        <p><b>Date :</b></p>
        <input type="date" name="date" value="<?= $date ?>">
        <br><br>
        <p><b>Heure</b></p>
        <input type="time" name="creneau" value="<?= $date ?>">
        <br><br>
        <p><b>Responsable :</b></p>
        <select name="responsable" required style="height: 20px; width: 100%;"> <!-- Ajustez la hauteur selon vos besoins -->
            <?php foreach ($responsables as $r) : ?>
                <option value="<?= $r; ?>" <?= ($r == $responsable) ? 'selected' : ''; ?>>
                    <?= $r; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="btn_act">
        <button class="bn3637 bn37 type="submit" name="valider">Modifier</button>
        <a href="../activite/activite.php" class="bn3637 bn37"><- Retour</a>
        </div>
    </form>
    </div>
</div>
</div>
<div class="bar-sp"></div>
<footer>
  <p>© FATALYS 2023 - 2024</p>
</footer>

<script src="../../JS/navbar.js"></script>
</body>
</html>
