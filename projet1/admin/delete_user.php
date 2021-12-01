<?php
session_start();
try {
    $conn = new PDO ("mysql: host=localhost; dbname=formulaire;", "root","root");

} catch (Exception  $e) {
    die ("Error:" .$e->getMessage());
}
//verifier si l'id existe et s'affiche dans le lien du haut

if(isset($_GET["id"])){
    $id=htmlspecialchars($_GET['id']);
}

//pour supprimer lorsqu'on appuie sur oui
if(isset($_POST['oui'])){
    $sup=$conn-> prepare("DELETE FROM users  WHERE id=? ");
    $sup->execute(array($id));
    header("Location:home.php"); 
}elseif(isset( $_POST['non'])) {
    header("Location:home.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <form action="" method="POST">
<h1>VOULEZ VOUS VRAIMENT SUPPRIMER?</h1>
        <input type="submit" name="oui" value="oui">
        <input type="submit" name="non" value="non">
    </form>
</body>
</html>