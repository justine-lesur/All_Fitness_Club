<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
		<meta name="description">
    <link rel="stylesheet" href="reservation.css">
</head>
<body class="body4">
	<?php include("header.php"); ?>
		<div class="body">
			<section id="agenda">
				<table>
					<thead>
						<tr id="jours">
							<th class="heure"></th>
							<th class="jour2">Dimanche</th>
							<th class="jour2">Lundi</th>
							<th class="jour2">Mardi</th>
							<th class="jour2">Mercredi</th>
							<th class="jour2">Jeudi</th>
							<th class="jour2">Vendredi</th>
							<th class="jour2">Samedi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//Je me connecte à la base de données.
							$connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
						
							//Je fais ma requête : je sélectionne la table utilisateurs que je lie à la table reservations, sur l'id_utilisateur. WHERE WEEK = la semaine prend en compte la date de début de ma réservation, afin que ça s'inscrive dans la semaine actuelle.
						    $requete = "SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur WHERE WEEK(reservations.debut) = WEEK(CURDATE())";
						
							//J'exécute la connexion et la requête.
							$resultat = mysqli_query($connexion, $requete);
							
							//$l correspond aux heures : donc je commence une boucle : $l démarre à 8h, et $l fait des tours jusqu'à 19h.
							for($l = 8; $l < 19; ++$l)
							{
							
							//j'affiche mon $l dans la ligne sur la case correspondante.
								echo '<tr class="ligne">';
									echo '<td class="heure">', $l, ' heures</td>';
									
							//$i correspond aux jours: donc je démarre une boucle: $i démarre à zéro, augmente jusqu'à ce qu'il soit <= à 6.
									for($i = 0; $i <= 6; ++$i)
									{
										echo '<td class="evenement">';
										
							//$d est la balise qui lie à la fois $j et $i : elle démarre de 0.
										$d = 0;
										
							//foreach me permet de parcourir les $donnees dans le $resultat
										foreach($resultat as $donnees)
										{
											
							//Je créé une $date qui prend en compte dans ma bdd la donnée du début de ma réservation, que je sors au format d/m/y.
											$date = date_create($donnees['debut'])->format('d/m/Y');
											
							//je sépare mon format en 3 parties : $jour, $mois, $annee. j'enlève avec explode mes / dans $date.
											list($jour, $mois, $annee) = explode('/', $date);
											
							//Je convertis cette donnée que j'ai inséré dans ma BDD en temps séparé entre $mois, $jour, $annee : par défaut, mes données = 0.
											$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
											
							//Cette balise permet d'insérer mon $timestamp dans ma date.
											$joursem = date("w",$timestamp);

							//Cette balise permet que la date que j'ai créée soit au format "heure": donc G.
											$heure = date_create($donnees['debut'])->format('G');
											
							//Si mon jour de la semaine correspond à $i et que l'heure correspond à $l, j'affiche mes données dans la case :
											if($joursem == $i && $heure == $l)
											{
												$id = $donnees['id'];
												echo "<a href='reservation.php?id=", $id, "'><div class='event_color'>";
												echo $donnees['login'], '<br/>';
												echo $donnees['titre'];
												echo '</div></a>';
											}
											++$d; //les jours augmentent.
										}
										echo '</td>';
									}
								echo'</tr>';
							}
						?>
					</tbody>
				</table>
					<?php include("footer.php"); ?>
			</section>
		</div>
	</body>
</html>