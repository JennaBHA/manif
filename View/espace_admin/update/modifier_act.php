<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];

    $recupAct = $bdd->prepare('SELECT * FROM activite WHERE id = ?');
    $recupAct->execute(array($getid));
    if($recupAct->rowCount() > 0){
        $activiteInfo = $recupAct->fetch();
        $titre = $activiteInfo['titre'];
        $description = str_replace('<br />', '', $activiteInfo['description']);

        if(isset($_POST['valider'])){
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $description_saisi = nl2br(htmlspecialchars($_POST['description']));

            $updateAct = $bdd->prepare('UPDATE activite SET titre = ?, description = ? WHERE id = ?');
            $updateAct->execute(array($titre_saisi, $description_saisi, $getid));
            header('Location: ../activite/activite.php');
        }

    }else{
        echo "Aucun article trouvé";
    }
}else{
    echo "Aucun identifiant trouvé";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_admin/modifier_act.css">
    <title>Modifier l'article</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" name="titre" value="<?= $titre; ?>">
        <br>
        <textarea name="description"><?= $description ?></textarea>
        <br><br>
        <input type="submit" name="valider">
    </form>
</body>
</html>
