<?php
	session_start();
	if(isset($_SESSION['login']) || isset($_SESSION['password'])){}
	else
	{
		header('Location: index.php');
	}
?>	
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css"/>
		<title>Mon Compte - Réservation salle</title>
	</head>
	
	<body>
		
		<div class="body">
			<div id="reservation_page">
				<?php
					$connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
					$requete = "SELECT * FROM reservations  WHERE id = '".$_GET['id']."'";
					$resultat = mysqli_query($connexion, $requete);
					$donnees = mysqli_fetch_assoc($resultat);
				
					$requete2 = "SELECT login FROM utilisateurs WHERE id = '".$donnees['id_utilisateur']."'";
					$req = mysqli_query($connexion, $requete2);
					$data = mysqli_fetch_assoc($req);
				?>
				
				<div class="reservation_page_info"><?php echo $donnees['titre']; ?></div>
				<div class="reservation_page_info">Réservé par <?php echo $data['login']; ?></div>
				<div class="reservation_page_info">Salles <?php echo $donnees['salles']; ?></div>
				<div class="reservation_page_info">Du <?php echo $donnees['debut']; ?></div>
				<div class="reservation_page_info">Au <?php echo $donnees['fin']; ?></div>
				<div class="reservation_page_info">Description<br/><?php echo $donnees['description']; ?></div>
			</div>
		</div>
		
	</body>	
</html>