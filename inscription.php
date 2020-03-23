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

<body class="body2">
		<?php include("header.php"); ?>
	<form method="post" action="inscription.php" class="formulairepages">
			<h1 class="inscription">Inscription</h1>
			<input type="text" name="login" class="largeur" class= "largeur" placeholder="Login"><br/>
			<input type="password" name="password" class="largeur" placeholder="Mot de passe"><br/>
			<input type="password" name="repeatpassword" class="largeur" placeholder="Confirmer le mot de passe"><br/><br/>
			<input type="submit" value="Valider" name="submit" class="validation">

<?php
	if (isset($_POST['submit']))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		$repeatpassword = $_POST['repeatpassword'];
		
		if ($login && $password && $repeatpassword)
		{
			if ($password == $repeatpassword)
			
			{
				/*On se connecte à la base de données*/
				$connect = mysqli_connect('localhost','root','','reservationsalles') or die ('Error');
				
				/*On regarde si login existe dans la base de données*/
				$nouveaulogin = "SELECT * FROM utilisateurs WHERE login = '".$login."'";
			
				/*On lie connexion et nouveau login avec la requête reg*/
				$reg = mysqli_query($connect, $nouveaulogin);
			
				/*Voir si reg existe pour pas : si il existe, la variable $row est égale à 1. Si il existe pas, la variable $row est égale à 0*/
				$row = mysqli_num_rows($reg);
				
				if ($row == 0)
				{
					/*Je sécurise le mot de passe en le cryptant*/
				    $mdp = password_hash($_POST['password'], PASSWORD_BCRYPT,array ('cost'=> 12));
					
					/*Je créé ma requête*/
					$query = "INSERT INTO utilisateurs (login, password) VALUES ('$login', '$mdp')";
					
					/*j'exécute ma requête et je me connecte*/
					mysqli_query($connect, $query);
					mysqli_close($connect);
					header('location: connexion.php');
					
					
				} else echo "<p class='identifiants'>Les identifiants existent déjà</p>";
			
			} else echo "<p class='identifiants'>Les deux mots de passe doivent êtres identiques</p>";
			
		} else echo "<p class='identifiants'>Veuillez saisir tous les champs</p>";
	}
?>
	</form>
	<?php include("footer.php"); ?>
</body>
</html>