<?php 
try {
    $conn = new PDO ("mysql: host=localhost; dbname=formulaire;", "root","root");

} catch (Exception  $e) {
    die ("Error:" .$e->getMessage());
}

if(isset($_GET['id'])){
    $id=htmlspecialchars($_GET['id']);
}

if(empty($_POST['update'])){
    
    //selectionner tout ce qui est dans la base de donée conscernant le produit selectionné
    $recup = $conn->prepare("SELECT * FROM users WHERE id=?");
    $recup->execute(array($id));
    
    $data = $recup->fetch();
    
        if(isset($_POST['username']) && isset($_POST['email'])&& isset($_POST['type'])){

            $nom=$_POST['username'];
            $mail=$_POST['email'];
            $type=$_POST['type'];
             $modif=$conn->prepare('UPDATE users SET username=?, email=? ,type=? WHERE id=?');
        $modif->execute(array($nom ,$mail,$type,$id));
     
        header("Location:home.php");
        }
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
    <form class="box" action="" method="post">
        <h1 class="box-title">modifier les informations</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur"
            value="<?php echo $data["username"] ?>" />
        <input type="text" class="box-input" name="email" placeholder="Email" value="<?php echo $data["email"] ?>" />
        <div class="input-group">
        <select class="box-input" name="type" id="type" >
				<option value="" disabled selected>Type</option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
        </div>
        <input type="submit" name="submit" value="update" class="box-button" />
    </form>

</body>

</html>