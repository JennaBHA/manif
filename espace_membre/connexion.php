<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(isset($_POST['envoi'])){
    if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = sha1($_POST['mdp']);

        $recupPart = $bdd->prepare('SELECT * FROM participant WHERE mail = ? AND mdp = ?');
        $recupPart->execute(array($mail, $mdp));

        if($recupPart->rowCount() > 0){
            $_SESSION['mail'] = $mail;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupPart->fetch()['id'];
            header('Location: index.php');
        
        }else{
            echo "Votre mot de passe ou mail est incorect";
        }
    }else{
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
        <input type="text" name="mail" autocomplete="off">
        <br>
        <input type="password" name="mdp" autocomplete="off">
        <br><br>
        <input type="submit" name="envoi">
    </form>
</body>
</html>