<?php
session_start();

include ('connexionBDD.php');

?>
<html>
	<header>
		<meta charset="utf-8"/>
		<title>ESIE'Animalerie</title>
			
	</header>

	<body>
		<link rel="stylesheet" href="style.css"/>
		<link rel="stylesheet" href="index.css"/>
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
		<?php require "entete.php"; ?>
		<br />
			
		<div id="main">
			<?php
			if (isset($_SESSION['pseudo']))
			{
				$pseudo = $_SESSION['pseudo'];
				echo "<h3>Bienvenue sur la page d'accueil <strong>$pseudo</strong></h3><br />Vous pouvez effectuer des achats dans la section boutique.";
				
			}
			
			else
			{
				echo "<h3>Bienvenue sur la page d'accueil ! Vous pouvez commencer par vous connecter</h3>";
			}
			?>
			
			<br />
			<br />
            Nous vendons de nombreux gadgets uniques, et de nourriture pour animaux.
				
			<?php
			$query1 = mysqli_query($mysqli, "SELECT * FROM Produits ORDER BY RAND() LIMIT 1");
			$query2 = mysqli_query($mysqli, "SELECT * FROM Produits ORDER BY RAND() LIMIT 1");
			$query3 = mysqli_query($mysqli, "SELECT * FROM Produits ORDER BY RAND() LIMIT 1");
			$query4 = mysqli_query($mysqli, "SELECT * FROM Produits ORDER BY RAND() LIMIT 1");
			$produit1 = $query1->fetch_assoc();
			$produit2 = $query2->fetch_assoc();
			$produit3 = $query3->fetch_assoc();
			$produit4 = $query4->fetch_assoc();
			?>
			
			<div class="produits">
				<h2>Nos produits du moment</h2>
				<?php
				echo "<img class='random' src='../Images/$produit1[Image_Produit]' ='150' height='150'>";
				echo "<img class='random' src='../Images/$produit2[Image_Produit]' ='150' height='150'>";
				echo "<img class='random' src='../Images/$produit3[Image_Produit]' ='150' height='150'>";
				echo "<img class='random' src='../Images/$produit4[Image_Produit]' ='150' height='150'>";
				?>
			</div>
			
		</div>
	</body>
</html>
