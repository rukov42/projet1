<?php
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

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="main.js"></script>
	
	</head>
	<body onload="init()">
		
		<div class="sucess">
		<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
		<p>C'est votre espace utilisateur.</p>
		<?php
		require('config.php');
		session_start();

		$date = date("d-m-Y H:i:s");
		$heure = date("H:i:s");
		
	
Print("Nous sommes le $date et il est $heure");
?>
<?php 
if(!empty($_POST['arrivee'])){
	date_default_timezone_set('Africa/Abidjan');
	$jour   = date('Y-m-d');
	$arrivee = date('H:i:s');
	$utilisateurs = $_SESSION['id'];
//verifier sil a ermarger aujourdhui 
            $requete = $connexion->prepare("SELECT * FROM listes  
            WHERE id = ? AND jour = ? ");       
            $requete->execute(array( $utilisateurs,$jour));
            $res = $requete->fetch();
                if($res){
                    echo "Vous avez emmarge ce matin";
                }else{
                    $requete = $connexion->prepare("INSERT INTO listes(jour, id, arrivee) VALUES(:jour, :id :arrivee)");
                    $requete->execute(array(
                        'jour' => $jour,
                        'id' => $utilisateurs,
                        'arrivee' =>$arrivee));
                } 
        }else{
            if(!empty($_POST['depart'])){
                date_default_timezone_set('Africa/Abidjan');
                $jour = date('Y-m-d');
                $depart = date('H:i:s');
                $utilisateurs =$_SESSION['id'];  

    //recuperer lenregistrement du matin
                
                $requete = $connexion->prepare("SELECT * FROM listes INNER JOIN users ON users.id = listes.id WHERE listes.id = ? AND listes.arrivee = ?;");       
                $requete->execute(array($utilisateurs, $jour));
                $rep = $requete->fetch();
                    if($rep){
                        $id = $rep['id_liste'];
                        echo "vous avez emmarge ce matin";
              
                        if(!$rep['depart']){
                            $requete = $connexion->prepare("UPDATE listes SET depart = ? WHERE id_ = ?");
                            $requete->execute(array($depart, $id));
                        }else{
                            echo "Vous avez deja emmarge ce soir";
                        }                  
                }else{
                    echo "vous navez pas emmarge ce matin";
                }     
        }
        }     
	}

?>
		<a href="logout.php">Déconnexion</a>
		</div>
		<div id="map" style="height:500px; width:800px"></div>
		<div class="col-sm-6">
                    <form action="" method="post">
					
                        <label for="arrivee">ARRIVEE :  </label>
                        <input type="submit" name="arrivee" value="arrivee">
                        <br><br>
                        <label for="depart">DEPART :  </label>
                        <input type="submit" name="depart" value="depart">
                        <br><br>
                    </form>
                </div>

		<script src="index.js" ></script>
	</body>
</html>
