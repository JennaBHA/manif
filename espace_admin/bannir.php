<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    
    $recupUser = $bdd->prepare('SELECT * FROM participant WHERE id = ?');
    $recupUser->execute(array($getid));
    
    if ($recupUser->rowCount() > 0) {
        $bannirUser = $bdd->prepare('DELETE FROM participant WHERE id = ?');
        $bannirUser->execute(array($getid));
        
        header('Location: membre.php');
        exit(); 
    } else {
        echo "Aucun membre n'a été trouvé";
    }
} else {
    echo "L'identifiant n'a pas été récupéré";
}
?>
