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
    <link rel="stylesheet" href="../style/general/navbar.css">
    <link rel="stylesheet" href="../style/general/bouton.css">
    <link rel="stylesheet" href="../style/general/scrollbar.css">
    <title>Afficher tous les membres</title>
</head>
<body>
      <!-- début menu -->
  <header>
    <nav>
        <ul class='nav-bar'>
            <li class='logo'><a href='#'><img src='../background/logo.png'/></a></li>
            <input type='checkbox' id='check' />
            <span class="menu">
                <li class="dropdown">
                    <a href="gerer.php">Membres</a>
                    <div class="dropdown-content">
                        <a href="membre.php">Participant</a>
                        <a href="../espace_resp/responsable.php">Responsable</a>
                        <a href="#">Participation</a> <!-- A faire -->
                    </div>
                </li>
                <li class="dropdown">
                <a href="../espace_admin/activite/activite.php">Activités</a>
                    <div class="dropdown-content">
                        <a href="../espace_admin/update/publier_act.php">Publier une activite</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/ajouter_resp.php">Ajouter un responsable</a>
                    </div>
                <li class="dropdown">
                    <a href="../espace_admin/update/publier_act.php">Publier une nouvelle activité</a>
                    </div>
                </li>
                <li><a href="../espace_admin/connexion/connexion.php">Déconnexion</a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
  </header>
    <!-- fin menu -->

    <section class="padding">
    <h1>Liste des membres</h1>
    <?php
    $recupUsers = $bdd->query('SELECT id, prenom, nom, mail, telephone, mdp, role FROM participant');
    while ($user = $recupUsers->fetch()) {
        ?>
        <form action="" method="post">
            <div class="user-card">
                <div class="user-info">
                    <p><B>Nom et prenom :</B> <?= $user['prenom']; ?> <?= $user['nom']; ?></p> 
                    <p><B>Rôle :</B> <?= $user['role']; ?></p>
                    <p><B>Mail :</B> <?= $user['mail']; ?> </p>
                    <p><B>Telephone : </B><?= $user['telephone']; ?></p>
                    <p><B>Mot de passe : </B><?= $user['mdp']; ?></p>
                </div>
                <!-- Début Bouton Modifier -->
                <div class="user-actions">
                    <a href="../espace_admin/connexion/modifier_membre.php?id=<?= $user['id']; ?>"> Modifier</a>
                </div>
                <!-- Fin Bouton modifier -->
                <!-- Debut Bouton Supprimer -->
                
                <button class="button" type="submit" name="id" value="<?= $user['id']; ?>">
                <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                </svg>
                </button>

                <!-- Fin Bouton Supprimer -->
            </div>
        </form>
        <?php
    }
    $recupUsers->closeCursor();
    ?>
    <br>
    <a href="../espace_admin/index.php">
  <button class="button_retour">
    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
      <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
    </svg>
    <span><B>Retour</B> </span>
  </button>
</a>
</section>
</body>
</html>
