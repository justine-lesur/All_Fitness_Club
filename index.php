<?php
session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Document sans titre</title>
    <link rel="stylesheet" href="reservation.css">
</head>

<body class="body1">
		<?php include("header.php"); ?>
			<div class="text">
				<h2 class="titre-fitness">All Fitness Club</h2>
				<button><a class="reserver-bouton" href="reservation-form.php">Réservez ici !</a></button>
			</div>
		<?php include("footer.php"); ?>
</body>
</html>