	<header>
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="inscription.php">Inscription</a></li>
				<?php
					if(isset($_SESSION['login']))
					{
						echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
						
					} else echo '<li><a href="connexion.php">Connexion</a></li>';
				?>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="planning.php">Planning</a></li>
				<li><a href="reservation.php">Réservation</a></li>
				<li><a href="reservation-form.php">Formulaire</a></li>
			</ul>
		</nav>
	</header>