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
	<form method="post" class="formulairepages">
			<h1 class="inscription">Connexion</h1>
			<input type="text" name="login" class="largeur" id= "largeur1" placeholder="Login"><br/>
			<input type="password" name="password" class="largeur" placeholder="Mot de passe"><br/>
			<input type="submit" value="Valider" name="submit" class="validation">
<?php
	if (isset($_POST['submit']))
	{
		$login=$_POST['login'];
		$password=$_POST['password'];
		
		if ($login && $password)
		{
			$connect = mysqli_connect ('localhost','root','','reservationsalles') or die ('Error');
			$query = "SELECT*FROM utilisateurs WHERE login = '".$login."'";
			$reg = mysqli_query($connect,$query);
			/*permet de lire/retourner une ligne du tableau, la première par défaut*/
			$rows = mysqli_fetch_assoc($reg);
			
			if ($login == $rows['login'])
			{
				if (password_verify($_POST['password'],$rows['password']))
				{
					session_start();
					$_SESSION['login']=$login;
					$_SESSION['password']=$password;
					$_SESSION['id']=$rows['id'];
					header('location:index.php');
						
						
				} else echo "<p class='identifiants'>Mot de passe incorrect</p>";
				
			} else echo "<p class='identifiants'>Login ou mot de passe incorrect</p>";
			
		} else echo "<p class='identifiants'>Veuillez saisir tous les champs</p>";
	}
?>
</form>
		<?php include("footer.php"); ?>
</body>
</html>