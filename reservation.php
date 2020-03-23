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
		<link rel="stylesheet" href="reservation.css"/>
		<title>Mon Compte - Réservation salle</title>
	</head>
	
	<body class="body3">
		<?php include("header.php"); ?>
		<div class="page-reservation">

			<div id="reservation_page">
				<?php
					// un exemple mais le laisse pas, en faite tu dois toujours tester si tes $_GET Existe (pareil pour les variables en générale) 
					// avant d'aficher un truc. A toi de voir ce que tu veux faire si il existe pas
					if(!isset($_GET['id']) || $_GET['id'] === '') {
						$idReservation = '5'; // ou redirection vers autre chose je sais pas
					} else {
						$idReservation = $_GET['id'];
					} // ou alors c'est bien ca aussi non ? a voir le sujet, mais tu dois toujours t'assurer d'avoir un resultats, ou de renvoyer vers une autre page
					$connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
					$requete = "SELECT * FROM reservations  WHERE id = '".$idReservation."'";

					$resultat = mysqli_query($connexion, $requete);
					$donnees = mysqli_fetch_assoc($resultat); // au lieu d'appeler ca données, on a tendance à plutot l'appeler $reservation plutot. C'est plus parlant :)
					$requete2 = "SELECT login FROM utilisateurs WHERE id = '".$donnees['id_utilisateur']."'"; 
					$req = mysqli_query($connexion, $requete2);
					
					$data = mysqli_fetch_assoc($req); // pareil ici, $data on sait pas ce que c'est, c'est dommage
				?>
				<section class="donnees-reservation">
					<div class="reservation_page_info"><p class="mes-donnees-bold"><?php echo $donnees['titre']; ?></p></div>
					<div class="reservation_page_info"><p class="mes-donnees">Réservé par <?php echo $data['login']; ?></p></div>
					<div class="reservation_page_info"><p class="mes-donnees">Du <?php echo $donnees['debut']; ?></p></div>
					<div class="reservation_page_info"><p class="mes-donnees">Au <?php echo $donnees['fin']; ?></p></div>
					<div class="reservation_page_info"><p class="mes-donnees"><b class="mes-donnees-bold">Description - </b><?php echo $donnees['description']; ?></p></div>
				</section>
			</div>
		</div>
		<?php include("footer.php"); ?>
	</body>	
</html>