<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$nom_error = $mdp_error = ""; 

if(isset($_POST['envoi'])){
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mdp'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mdp = $_POST['mdp'];

        $recupPart = $bdd->prepare('SELECT id, nom, prenom, mdp FROM responsable WHERE nom = ? AND prenom = ?'); 
        $recupPart->execute(array($nom, $prenom));

        if($recupPart->rowCount() > 0){
            $donnees = $recupPart->fetch();
            if (password_verify($mdp, $donnees['mdp'])) { 
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $donnees['id'];
                header('Location: ../index.php');
            } else {
                $mdp_error = "Mot de passe incorrect";
            }
        } else {
            $nom_error = "Nom et prénom incorrects";
        }
    } else {
        $mdp_error = "Veuillez compléter tous les champs";
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
    <link rel="stylesheet" href="../../style/style_resp/connexion.css">
    <link rel="stylesheet" href="../../style/general/bouton.css">
    <title>connexion</title>
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
                    <input type="text" name="nom" autocomplete="off" placeholder="nom">
                </div>
            </div>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <input type="text" name="prenom" autocomplete="off" placeholder="prenom">
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe">
                </div>
            </div>
            <div class="error-message"><?php echo $nom_error; ?></div>
            <div class="error-message"><?php echo $mdp_error; ?></div>
            <div class="button-container">
                <button class="bouton" name="envoi" value="Se connecter">Se connecter</button>
                <a href="../accueil.php" class="bouton_retour">Retour</a>
            </div>
        </form>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</html>
