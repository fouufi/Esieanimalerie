<?php
session_start();
include ('connexionBDD.php');
?>

<html>
	<body>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css"/>
		<link rel="stylesheet" href="boutique.css"/>
		
		<?php require "entete.php"; ?>
		<div id"contenaire">
		<br />
			
			<?php
			$query = 'SELECT DISTINCT ID_Categorie FROM Produits';
			$Categorie = mysqli_query($mysqli, $query);

			$contenu .= '<div class="boutique-gauche">';
			$contenu .= "<ul>";

			//--- Affichage des catégories ---//
			
			while($cat = $Categorie->fetch_assoc())
			{
				if ($cat['ID_Categorie'] == 1)
				{
					$contenu .= "<li><a href='?ID_Categorie=" . $cat['ID_Categorie'] . "'>Accessoires</a></li>";	
				}
				if ($cat['ID_Categorie'] == 2)
				{
					$contenu .= "<li><a href='?ID_Categorie=" . $cat['ID_Categorie'] . "'>Alimentation</a></li>";	
				}
			}
			$contenu .= "<li><a href=panier.php>Voir mon panier</a></li>";
			$contenu .= "<li><a href=panier.php?panier>Vider mon panier</a></li>";
			
			$contenu .= "</ul>";
			$contenu .= "</div>";
			
			$contenu .= '<div class="boutique-droite">';
			
			$query = "select ID_Produit, Nom_Produit, Prix_Produit, ID_Categorie, Image_Produit, Description_Produit, Quantite_Produit FROM Produits";
			$donnees = mysqli_query($mysqli, $query);
			
			//--- Affichage de tous les produits ---//
			if(!isset($_GET['ID_Categorie']))
			{
				while($produits = $donnees->fetch_assoc())
				{
					$contenu .= '<div class="boutique-produit">';
					$contenu .= "<h4>$produits[Nom_Produit]</h4>";
					$contenu .= "<a href=\"fiche_produit.php?ID_Produit=$produits[ID_Produit]\"><img src=\"../Images/$produits[Image_Produit]\" =\"130\" height=\"100\"></a>";
					$contenu .= "<p>$produits[Prix_Produit] €</p>";
					$contenu .= '<a href="fiche_produit.php?ID_Produit=' . $produits['ID_Produit'] . '">Voir la fiche du produit</a>';
					$contenu .= '</div>';
				}
			}
			
			//--- Affichage des produits par catégories ---//
			if(isset($_GET['ID_Categorie']))
			{
				$query = "select ID_Produit, Nom_Produit, Prix_Produit, ID_Categorie, Image_Produit, Description_Produit, Quantite_Produit FROM Produits WHERE ID_Categorie = '$_GET[ID_Categorie]'";
				$donnees = mysqli_query($mysqli, $query) or die ('Erreur: requête affichage produits par catégories');
				
				while($produit = $donnees->fetch_assoc())
				{
					$contenu .= '<div class="boutique-produit">';
					$contenu .= "<h4>$produit[Nom_Produit]</h4>";
					$contenu .= "<a href=\"fiche_produit.php?ID_Produit=$produit[ID_Produit]\"><img src=\"../Images/$produit[Image_Produit]\" =\"130\" height=\"100\"></a>";
					$contenu .= "<p>$produit[Prix_Produit] €</p>";
					$contenu .= '<a href="fiche_produit.php?ID_Produit=' . $produit['ID_Produit'] . '">Voir la fiche du produit</a>';
					$contenu .= '</div>';
				}
			}
		
			$contenu .= '</div>';

			echo $contenu;
			?>
			</div>
	</body>
</html>
