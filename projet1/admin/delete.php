<?php

$host = 'localhost';
$username = 'root';
$password = 'root';
$db = 'formulaire';

//Créez l'objet PDO
$pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);

//Suppression d'une ligne à l'aide d'une instruction préparée
$sql = "DELETE FROM `users` WHERE `name` = :name";

//Préparez notre déclaration DELETE
$stmt = $pdo->prepare($sql);

//Le nom que nous souhaitons supprimer de notre table 'users'
$name = 'Alex';

//Liez la variable $name au paramètre :name
$stmt->bindValue(':name', $name);

//Exécuter notre instruction DELETE
$res = $stmt->execute();

?>