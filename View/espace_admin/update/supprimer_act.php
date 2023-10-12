<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupAct = $bdd->prepare('SELECT * FROM activite WHERE id = ?');
    
    $recupAct->execute(array($getid));
    if($recupAct->rowCount() > 0){
        $deleteAct = $bdd->prepare('DELETE FROM activite WHERE id = ?');
        $deleteAct->execute(array($getid));
        header('Location: ../activite/activite.php');
    }else{
        echo "Aucune activité trouver";
    }
}else{
    echo "Aucun identifiant trouver";
}
?>