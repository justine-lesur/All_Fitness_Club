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

<body class="body3">
	<?php include("header.php"); ?>
    <?php
    if (isset($_SESSION['login']))
    {
       date_default_timezone_set('Europe/Paris'); 
       $connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
       $requete = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
       $query = mysqli_query($connexion, $requete);
       $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);
	}
     ?>
		<section class="les-reservations">
     	<form class="formulairepages2" method ="post" action ="">
			<h1 class="inscription">Réservez</h1>
     		<label><b class="le-label">Titre </b></label>
     	    <Select name="titre" class="largeur2">
                <option></option>
                <option>Cours avec Stephane</option>
                <option>Cours avec Sophie</option>               
                <option>Cours avec David</option>
            </select>
            <label for="text"><b class="le-label">Description </b></label>
            <input type="text" placeholder="Tapez une Description" name="description" class="largeur" required/>
            <label for="datedebut"><b class="le-label">Date de début </b></label>
            <input type="datetime-local" name="datedebut" class="largeur" required/>
            <label for="datefin"><b class="le-label">Date de fin </b></label>
            <input type="datetime-local" name="datefin" class="largeur" required/><br>
          
            <br><input type="submit" value="Réserver" class="validation" name="valider">
     	<?php
                    if ( isset($_POST["valider"]) )
                    {
                          $titro = $_POST['titre'];
                          $renametitre = addslashes($titro); 
                          $descriptio = $_POST['description'];
                          $renamedescription = addslashes($descriptio); 
                          $datedebut = $_POST['datedebut'];
                          $datefin = $_POST['datefin'];
                          $startdate = date('Y-m-d H:i:s', strtotime($datedebut));
                          $enddate = date('Y-m-d H:i:s', strtotime($datefin));
						
							if ($startdate < date('Y-m-d H:i:s')) 
							{
								echo "<p class='identifiants'>vous ne pouvez pas réserver<br/> à une date antérieure à la date d’aujourd’hui</p>";
							}
	
							elseif ($enddate < $startdate) 
						  	{
                              echo "<p class='identifiants'>Vous ne pouvez pas choisir<br/> une date de fin antérieure à la date de debut</p>";
							}
                         
							
						 	else
						 	{
							  $requete2 = "SELECT * FROM reservations WHERE (debut BETWEEN '$startdate' AND '$enddate') OR (fin BETWEEN '$startdate' AND '$enddate') ";
                              $query2 = mysqli_query($connexion, $requete2);
                              $resultat2 = mysqli_fetch_all($query2);
                              
							 if(!empty($resultat2))
							 {
                               	echo "<p class='identifiants'>Une réservation existe déjà à cette date</p>";
                          	 }
							 
                          		else
						  		{
                              		$requete3 = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('$renametitre', '$renamedescription', '$startdate', '$enddate',  ".$resultat[0]['id'].")";
									$query3 = mysqli_query($connexion, $requete3);
                          		}   
                          
						 	} 
                         
            		}
           

				mysqli_close($connexion);
				?>
				</form>
			</section>
			<?php include("footer.php"); ?>
</body>
</html>
