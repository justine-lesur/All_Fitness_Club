<?php
session_start();

	if (isset($_SESSION['login']))
	{
		
	} else header ('location: connexion.php');
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
<?php
	/*Connexion au serveur*/
	$connexion = mysqli_connect('localhost','root','', 'reservationsalles') or die ('Error');
	$query= "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
	$reg = mysqli_query ($connexion, $query);
	$data= mysqli_fetch_assoc($reg);
?>
	<form method="post" action="profil.php" class="formulairepages">
		<h1 class="inscription">Profil</h1>
		<input type="text" name="login" class="largeur" id="login" value = "<?php echo $data['login'] ?>"/>
		<br/>
		<br/>
		<input type="password" name="motdepasse" class="largeur" id="motdepasse" value = "<?php echo $data['password'] ?>"/>
		<br/>
		<br/>
		<input type="submit" name ="submit" value="Valider" class="validation"/>
		<br/>
		<br/>
	 </form>
	<?php include("footer.php"); ?>	
</body>
</html>