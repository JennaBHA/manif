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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style/style_admin/publier_act.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/card.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <title>Publier une activité</title>
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
                    <!-- <a href="modifier_act.php">Modifier</a> -->
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="with-dropdown">Membres</a>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="../membre.php">Participant</a>
                    <a href="../update/gerer_participant.php">Participation</a>
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
            <a href="../connexion/deconnexion.php">Déconnexion</a>
        </nav>
    </header>
    <!-- fin menu -->

    <section class="publier-act-admin">
        <div class="publier-act-admin-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Publication des activités</b></p>
            <a href="javascript:void(0);" class="bn3637 bn37" onclick="scrollToMain()">Explorer</a>
        </div>
    </section>

    <div class="container">
    <div class="main" id="main">
        <main class="test">
            <div class="ajout">
        <div class="test2">
        <div class="card">
    <form method="post" class="card-form">            
        <h3><B>Titre de l'activité :</B></h3>
            <input type="text" name="titre" placeholder="Titre" required>
            <br><br>
            <h3><B>Description de l'activité</B></h3>
            <textarea name="description" placeholder="Description" required></textarea>
            <br><br>
            <h3><B>Responsable de l'activité :</B></h3>
            <select name="responsable" id="monselect" required>
                <?php foreach ($responsables as $responsable) : ?>
                    <option value="<?php echo $responsable; ?>"><?php echo $responsable; ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <h3><B>Date : </B></h3>
            <input type="date" name="date" required>
            <br><br>
            <h3><B>Heure :</B></h3>
            <input type="time" name="creneau" autocomplete="off" placeholder="Créneau">
            <div class="btn_act">
            <button class="bn3637 bn37" type="submit" name="envoie">Envoie</button>
            <a href="../activite/activite.php" class="bn3637 bn37"><- Retour</a>
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
    </div>
</div>
    </div>
    </div>
    </main>
    <br>
    <div class="bar-sp"></div>
<footer>
<p>© FATALYS 2023 - 2024</p>
</footer>
    <script src="../../JS/navbar.js"></script>
    <script src="../../JS/buttom.js"></script>
</body>
</html>
