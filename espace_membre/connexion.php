<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
            header('Location: index.php');
        } else {
            echo "Votre mot de passe ou mail est incorrect";
        }
    } else {
        echo "Veuillez compléter tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body>
    <form method="POST" action="" align="center">
        <input type="text" name="mail" autocomplete="off" placeholder="Adresse email">
        <br>
        <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe">
        <br><br>
        <input type="submit" name="envoi" value="Se connecter">
    </form>
</body>
</html>