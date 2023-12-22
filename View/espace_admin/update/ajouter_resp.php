<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if (!isset($_SESSION['mdp'])) {
    header('Location: ../espace_admin/connexion/connexion.php');
    exit;
}

$message = '';
// Créez un tableau vide pour stocker la liste des responsables.
$responsables = array();

// Récupérez la liste des responsables depuis la base de données.
$requeteResponsables = $bdd->query('SELECT nom FROM responsable');
while ($responsable = $requeteResponsables->fetch()) {
    $responsables[] = $responsable;
}

if (isset($_POST['envoie'])) {
    if (!empty($_POST['nom']) && !empty($_POST['role']) && !empty($_POST['mdp'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $role = htmlspecialchars($_POST['role']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hash du mot de passe

        $inserAct = $bdd->prepare('INSERT INTO responsable(nom, prenom, role, mdp) VALUES(:nom, :prenom, :role, :mdp)');
        $inserAct->execute(array(':nom' => $nom, ':prenom' => $prenom, ':role' =>  $role, ':mdp' => $mdp));

        $message = '<p style="color: green;">Le responsable a bien été ajouté</p>';
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
    <link rel="stylesheet" href="../../style/style_resp/ajouter_resp.css">
    <link rel="stylesheet" href="../../style/general/navbar.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/scrollbar.css">
    <link rel="stylesheet" href="../../style/general/general.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/general/footer.css">
    <link rel="stylesheet" href="../../style/general/card.css">
    <title>Ajouter responsable</title>
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
                    <a href="../update/publier_act.php">Publier</a>
                    <a href="../update/modifier_act.php">Modifier</a>
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
                    <a href="../update/ajouter_resp.php">Ajouter</a>
                </div>
            </div>
            <a href="../espace_admin/connexion/deconnexion.php">Déconnection</a>
        </nav>
    </header>
    <!-- fin menu -->



    <section class="ajt-responsable">
        <div class="ajt-responsable-content">
            <h1>Manifestation FATALYS</h1>
            <p><b>Modification des responsables</b></p>
            <a href="#main" class="bn3637 bn37">Explorer</a>
        </div>
    </section>
    <div class="container">
    <div class="main" id="main">
    <div class="card">
    <form method="post" class="card-form">        
        <h3>Nom</h3>
        <input type="text" name="nom" placeholder="Nom">
        <br><br>
        <h3>Prenom</h3>
        <input type="text" name="prenom" placeholder="Prénom">
        <br><br>
        <h3>Rôle</h3>
        <select name="role">
            <option value="responsable">Responsable</option>
            <option value="administrateur">Administrateur</option>
            <option value="participant">Participant</option>
        </select>
        <br><br>
        <h3>Mot de passe</h3>
        <input type="password" name="mdp" placeholder="Mot de passe">
        <br><br>
        <div class="button-container">
            <button class="button" type="submit" name="envoie">Envoie</button>
            <a href="../index.php" class="button" id="btn">Retour</a>
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

    <div class="bar-sp"></div>
<footer>
  <p>© FATALYS 2023 - 2024</p>
</footer>

    <script src="../../JS/navbar.js"></script>
</body>
</html>
        