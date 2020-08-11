<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<header>
		<div id="banniere">
			<img src="../Images/logo.png"/>
			<link rel="stylesheet" href="entete.css"/>
			<strong> ESIE'Animalerie</strong>
		</div>
	</header>
	
	<body>
		<div class="onglets">
			<?php
			if (isset($_SESSION['ConnectOK']))
			{
				?>
				<ul class="onglets">
					<li class="onglet"><a href="index.php">Accueil</a></li>
					<li class="onglet"><a href="boutique.php">Boutique</a></li>
					<li class="onglet"><a href="profil.php">Mon profil</a></li>
					<li class="onglet"><a href="deconnexion.php">Deconnexion</a></li>
				</ul>
				<?php
			}

			else
			{
				?>
				<ul class="onglets">
					<li class="onglet"><a href="index.php">Accueil</a></li>
					<li class="onglet"><a href="boutique.php">Boutique</a></li>
					<li class="onglet"><a href="profil.php">Mon profil</a></li>
					
					<li class="onglet"><a href="authentification.php">Se connecter</a></li>
					<li class="onglet"><a href="inscription.php">S'inscrire</a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</body>

</html>
