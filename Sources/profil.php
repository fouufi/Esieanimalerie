
<?php
session_start(); //Récupère les données de la session
include ('connexionBDD.php'); //Récupère les infos du client
?>

<html>
	<header>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css"/>
	</header>

		<body>
		<?php
		require "entete.php";
		$Pseudo = $_SESSION['pseudo'];
		?>
		<div align="center">
			<h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>

			<h4>Pseudo : <?php echo $_SESSION['pseudo']; ?></h4>
			
			<?php
			/* On récupère les données du client dans un tableau */
			$Requete = mysqli_query($mysqli,"SELECT * FROM Clients WHERE pseudo = '$Pseudo'");
			$userinfos = mysqli_fetch_array($Requete);
			
			$ville = htmlentities($_POST['ville'], ENT_QUOTES, "ISO-8859-1"); //Empêche les injections SQL
			$cp = htmlentities($_POST['cp'], ENT_QUOTES, "ISO-8859-1");
			$rue = htmlentities($_POST['rue'], ENT_QUOTES, "ISO-8859-1");
			?>
			<h4>Mail : <?php echo $userinfos['email']; ?></h4>
			
			<!-- Ajout de la ville dans le profil du client -->
			<div class="container">
				<form action="profil.php" method="post">
					<input placeholder="ville" type="text" name="ville" >
					<input type="submit" name="AjoutVille" value="Ajouter une ville"/>
				</form>
			</div>
			<h4>Ville : <?php echo $userinfos['ville']; ?></h4>

			<?php
			if(isset($_POST['AjoutVille']))
			{
				if(!empty($_POST["ville"]))
				{
					$_POST["ville"] = $ville;
					$AjoutVille = "UPDATE Clients SET ville = '$ville'  WHERE pseudo = '$Pseudo'";
					
					if(mysqli_query($mysqli, $AjoutVille))
						echo "Ville ajoutée à la BDD"; //A supprimer avant le rendu
					
					echo " ".mysqli_error($mysqli); //Mettre dans un fichier log avant le rendu
					 
				}
			}
			?>
			
			<!-- Ajout du code postal dans le profil du client -->
			<div class="container">
				<form action="profil.php" method="post">
					<input type="text" name="cp" value="" />
					<input type="submit" name="AjoutCP" value="Ajouter un Code postal" />
				</form>
			</div>
			
			<h4>Code postal : <?php echo $userinfos['cp']; ?></h4>
			<?php
			if(!empty($_POST['cp']))
			{
					$_POST["cp"] = $cp;

					$AjoutCP = "UPDATE Clients SET cp = '$cp'  WHERE pseudo = '$Pseudo'";
					
					if(mysqli_query($mysqli, $AjoutCP))
						echo "Code postal ajoutée à la BDD"; //A supprimer avant le rendu
					
					echo " ".mysqli_error($mysqli); //Mettre dans un fichier log avant le rendu
			}				
			?>
			<!-- Ajout de la rue dans le profil du client -->
			<div class="container">
				<form action="profil.php" method="post">
					<input type="text" name="rue" value="" />
					<input type="submit" name="AjoutRue" value="Ajouter une rue" />
				</form>
			</div>
			<h4>Rue : <?php echo $userinfos['rue']; ?></h4>
			
			<?php
				if(!empty($_POST['rue']))
				{
					$_POST["rue"] = $rue;

					$AjoutRue = "UPDATE Clients SET rue = '$rue'  WHERE pseudo = '$Pseudo'";
					
					if(mysqli_query($mysqli, $AjoutRue))
						echo "Rue ajoutée à la BDD"; //A supprimer avant le rendu
					
					echo " ".mysqli_error($mysqli); //Mettre dans un fichier log avant le rendu
			}

			/* Changement du Mot de Passe si le Client a besoin */
			$Oldmdp = htmlentities($_POST['Oldmdp'], ENT_QUOTES, "ISO-8859-1"); //Empêche les injections SQL
			$Newmdp = htmlentities($_POST['Newmdp'], ENT_QUOTES, "ISO-8859-1");
			$ReNewmdp = htmlentities($_POST['ReNewmdp'], ENT_QUOTES, "ISO-8859-1");

			//Verifications si les champs ont été remplis, sinon on ne fait rien.
			if(!(empty($_POST['Oldmdp']) && empty($_POST['Newmdp']) && empty($_POST['ReNewmdp'])))
			{
				$Oldmdp = $_POST['Oldmdp'];
				$Newmdp = $_POST['Newmdp'];
				$ReNewmdp = $_POST['ReNewmdp'];

				$HashOldmdp = md5($Oldmdp);
				$HashNewmdp = md5($Newmdp);
				
				if ($userinfos['mdp'] == $HashOldmdp)
				{	
					if($Newmdp == $ReNewmdp)
					{
						//Changer le mot de passe dans la bdd
						mysqli_query($mysqli, "UPDATE Clients SET mdp='$HashNewmdp' WHERE pseudo = '$Pseudo'");
						echo "Votre mot de passe a bien été modifié.";
					}
					else
					{
						//Verification du mot de passe 
						echo "Les mots de passes ne sont pas identiques. Veuillez revérifier.";
					}
				}
				else
				{
					//Le mot de passe entré ne correspond pas au mot de passe du compte
					echo "Le mot de passe que vous avez entré ne correspond pas à votre mot de passe actuel.";
				}
			}
				?>
			
			<div class="container">
				<h4>Changement du mot de passe</h4>
				<form action="profil.php" method="post">
				Mot de passe actuel: <input type="password" name="Oldmdp" value="" />

				Nouveau mot de passe : <input type="password" name="Newmdp" value="" />

				Confirmation nouveau mot de passe : <input type="password" name="ReNewmdp" value="" />
				
				<input type="submit" name="ModifyPsswd" value="Changer le mot de passe" />
				<p class="Caution">Attention pas de retour en arrière</p>
				</form>
			</div>
		</div>

	</body>
	
</html>
