<?php // connexion du fichier php a la base de données
// session_start();

// if(!isset($_SESSION["username"])){
    // header("Location: login.php");

include("config.php");

// $now = NOW() et $now = gmdate("Y-m-d"); ne marchent pas correctement
$heure_arrive = gmdate("H:i:s");

$conn->query("INSERT INTO emargement (date, HA) VALUES(NOW(), '$heure_arrive')");

// }


    ?>