<?php
session_start();
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo_par_defaut = "admin";
        $mdp_par_defaut = "admin";

        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut){
            // $_SEESION["pseudo"] = $pseudo;
            $_SEESION['pseudo'] = $pseudo_saisi;
            $_SESSION['mdp'] = $mdp_saisi;
            header('Location: ../index.php');
        }else{
            echo "Votre mot de passe est incorrect";
        }
    }else{
        echo "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/connexion_admin.css">
    <title>Connexion</title>
</head>
<body>
    <form method="POST" action="" align="center">
        <h2>Espace de connexion administrateur</h2>
        <input type="text" name="pseudo" autocomplete="off" placeholder="pseudo">
        <br>
        <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe">
        <br><br>
        <input type="submit" name="valider">
        <a href="../accueil.php" class="envoie-button">Accueil</a>
    </form>
</body>
</html>