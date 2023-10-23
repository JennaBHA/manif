<?php
session_start();
$pseudo_error = "";
$mdp_error = "";

if (isset($_POST['valider'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo_par_defaut = "admin";
        $mdp_par_defaut = "admin";

        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if ($pseudo_saisi == $pseudo_par_defaut && $mdp_saisi == $mdp_par_defaut) {
            $_SESSION['pseudo'] = $pseudo_saisi;
            $_SESSION['mdp'] = $mdp_saisi;
            header('Location: ../index.php');
            exit; // Terminer le script après la redirection
        } else {
            $mdp_error = "Votre mot de passe est incorrect";
        }
    } else {
        $mdp_error = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <link rel="stylesheet" href="../../style/style_admin/connexion_admin.css">
    <title>Connexion</title>
</head>

<body>
    <img class="wave" src="../../background/wave_.png" />
    <div class="container">
        <div class="img"></div>
        <div class="login-content">
            <form method="post">
                <h2 class="title">Connexion</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="text" name="pseudo" autocomplete="off" placeholder="pseudo">
                    </div>
                </div>

                <div class="error-message"><?php echo $pseudo_error; ?></div> <!-- Message d'erreur pseudo -->

                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe">
                    </div>
                </div>

                <div class="error-message"><?php echo $mdp_error; ?></div> <!-- Message d'erreur mot de passe -->
<!-- 
                <div class="button-container">
                    <input type="submit" name="valider" value="Connexion">
                    <a href="../accueil.php" id="btn">Accueil</a>
                </div> -->

                <div class="button-container">
            <button class="button" type="submit" name="valider">Se connecter</button>
            <a href="../accueil.php" class="button" id="btn">Retour</a>
        </div>

        </div>
        </form>
    </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>

</html>