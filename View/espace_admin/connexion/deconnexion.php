<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: ../espace_admin/connexion/connexion.php');
?>