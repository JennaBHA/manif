<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];

    $recupident = $bdd->prepare('SELECT * FROM participant WHERE id = ?');
    $recupident->execute(array($getid));
    
    if($recupident->rowCount() > 0){
        $activiteInfo = $recupident->fetch();
        $nom = $activiteInfo['nom'];
        $mdp = str_replace('<br />', '', $activiteInfo['mdp']);

        if(isset($_POST['valider'])){
            $mdp_saisi = htmlspecialchars($_POST['mdp']);

            $updateident = $bdd->prepare('UPDATE participant SET mdp = ? WHERE id = ?');
            $updateident->execute(array($mdp_saisi, $getid));
            header('Location: ../membre.php');
        }

    } else {
        echo "Aucun participant trouvé";
    }
} else {
    echo "Aucun identifiant trouvé";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/modifier_act.css">
    <title>Modifier le mot de passe</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" name="nom" value="<?= $nom; ?>">
        <br>
        <input type="text" name="mdp" value="<?= $mdp; ?>">
        <br><br>
        <input type="submit" name="valider">
    </form>
</body>
</html>
