<?php
$bdd = new PDO('mysql:host=localhost;dbname=manif;', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])){

}else{
    echo "Aucun identifiant trouver";
}
?>