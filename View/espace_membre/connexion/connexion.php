<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$mail_error = $mdp_error = ""; // Initialize error messages

if(isset($_POST['envoi'])){
    if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = sha1($_POST['mdp']);

        $recupPart = $bdd->prepare('SELECT id, prenom FROM participant WHERE mail = ? AND mdp = ?');
        $recupPart->execute(array($mail, $mdp));

        if($recupPart->rowCount() > 0){
            $donnees = $recupPart->fetch();
            $_SESSION['mail'] = $mail;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $donnees['id'];
            $_SESSION['prenom'] = $donnees['prenom']; // Enregistrez le prénom dans la session
            header('Location: ../index.php');
        } else {
            $mail_error = "Votre mot de passe ou mail est incorrect";
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
    <link rel="stylesheet" href="../../style/style_membre/connexion.css">
    <!-- <link rel="stylesheet" href="../../style/general/bouton.css"> -->
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
                    <input type="text" name="mail" autocomplete="off" placeholder="Adresse email">
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
            <div class="error-message"><?php echo $mail_error; ?></div>
                <div class="error-message"><?php echo $mdp_error; ?></div>

                
            <button class="bouton" type="submit" name="envoi">Se connecter</button>
            <a href="../accueil.php" class="bouton_retour" >Retour</a>

            <br>
            <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></p>
        </form>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</html>