<?php
 
 $host = 'localhost';
 $dbname = 'formulaire';
 $username = 'root';
 $password = 'root';

 $dsn = "mysql:host=$host;dbname=$dbname"; 
 // récupérer tous les utilisateurs
 $sql = "SELECT * FROM Users";
  
 try{
  $pdo = new PDO($dsn, $username, $password);
  $stmt = $pdo->query($sql);
  
  if($stmt === false){
   die("Erreur");
  }
  
 }catch (PDOException $e){
   echo $e->getMessage();
 }
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<div class="sucess">
		<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
		<p>C'est votre espace admin.</p>
		<h1>Liste des utilisateurs</h1>
 <table>
   <thead>
     <tr>
       <th>Pseudo</th>
       <th>Mail</th>
     </tr>
   </thead>
   <tbody>
     <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
     <tr>
       <td><?php echo htmlspecialchars($row['username']); ?></td>
       <td><?php echo htmlspecialchars($row['email']); ?></td>
	   <td><button><a href="delete_user.php?id=<?php echo $row['id'] ?>">supprimer</a></button></td>
	   <td><button><a href="update_user.php?id=<?php echo $row['id'] ?>">modifier</a></button></td>
     </tr>
     <?php endwhile; ?>
   </tbody>
 </table>
		<a href="add_user.php">AJOUTER utilisateur</a> | | 
		<a href="../logout.php">Déconnexion</a>
		</ul>
		</div>
	</body>
</html>
