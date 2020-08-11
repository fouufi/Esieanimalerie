<?php
session_start();
include ('connexionBDD.php');
?>
    
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="entete.php" />
	</head>
	
	<body>
		<?php require "entete.php"; ?>
		<br />
		
<?php
//Creation fonctions organisation du panier
function ajouterProduit($ID_Produit)
{
	if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier']))
	{
		$_SESSION['panier'] = array();
	}
	
	array_push($_SESSION['panier'], $ID_Produit); 
}

function supprProduit($ID_Produit_A_Suppr)
{

		if(isset($_SESSION['panier']) && (!empty($_POST["suppr_panier"])))
		{
			array_splice($_SESSION['panier'], $ID_Produit_A_Suppr);
		}
		elseif(!isset($_SESSION['panier']))
		{
			echo "Le panier est vide";
		}
}

function viderPanier()
{
	for ($i = 0; $_SESSION['panier'][$i] != NULL; $i++) 
	{
		unset($_SESSION['panier'][$i]);
	}
}

//Programme récupérant les données du form du fichier fiche_produit.php
if(!empty($_POST["ajout_panier"]) && !empty($_POST[ID_Produit]))
{
    $produit = $_POST["ID_Produit"];  

	$query = "SELECT * FROM Produits WHERE ID_Produit = '$_POST[ID_Produit]'";
	$resultat = mysqli_query($mysqli, $query);
	$EverythingaboutProduit = $resultat->fetch_assoc();
	$nameProduit = $EverythingaboutProduit[Nom_Produit];
	
    /* on veut ajouter un nouveau produit */
	ajouterProduit($produit);
	echo "Le produit suivant a été ajouté dans votre panier : $nameProduit";
}

    ?>
    <div id="panier">
		<!-- Affichage du panier -->
		<h3>Panier</h3> <!-- TODO: Encadrer si possible et centrer -->
	<?php
	
//Parcours du panier et affichage des produits	
for ($i = 0; $_SESSION['panier'][$i] != NULL; $i++) 
{
	$id = $_SESSION['panier'][$i];
		
	$query2 = "SELECT * FROM Produits WHERE ID_Produit = '$id'";
	$resultat2 = mysqli_query($mysqli, $query2) or die ('Erreur');
	$row = mysqli_fetch_row($resultat2);
	
	printf("<h3><b>%s</b></h3>",$row[1]);
	printf("<img src='../Images/%s' ='100' height='100'><br />", $row[3]);
	printf("<br /> <i>Description : %s</i><br />",$row[4]);
	printf("<br /> Prix : %s €", $row[5]);
	
	?>
	<!-- Formulaire suppression des éléments du panier -->
	<form method="post" action="panier.php">
		<input type="submit" name="suppr_panier" value="Supprimer ce produit du Panier">
	</form>
	
	<?php
	if(!empty($_POST["suppr_panier"]) && (!empty($id)))
	{
		supprProduit($id);
	}
	
	//Affichage du nombre d'objets dans le panier
	echo "<p>Le panier contient " . count($_SESSION['panier']) . " produits. </p>" ;

	//Permet de vider le panier
	if(isset($_GET['panier']))
	{
		if (!empty($_SESSION['panier']))
		{
			viderPanier();
			echo "Le panier a été vidé.";
		}
		else
		{
			echo "Le panier est déjà vide.";
		}
	}
}

//Si l'utilisateur est connecté et que le panier n'est pas vide
if ($_SESSION['ConnectOK'] == true && (!empty($_SESSION['panier'])))
{
	//Procéder au payement
	?>
	<form method="post" action="">
		<input type="submit" name="payer" value="Procéder au payement">
	</form>
	<?php
	if(isset($_POST['payer']))
	{
		for ($i = 0; $_SESSION['panier'][$i] != NULL; $i++) 
		{
			$id = $_SESSION['panier'][$i];
		
			$query2 = "SELECT * FROM Produits WHERE ID_Produit = '$id'";
			$resultat2 = mysqli_query($mysqli, $query2);
			$row = mysqli_fetch_row($resultat2);
	
			$prix_total += ($row[6] * $_POST['quantite']);
			
			
			$quer = "INSERT INTO Commandes (ID_Client, ID_Facture) VALUES ('$id', '$prix_total')";
			$done = mysqli_query($mysqli, $quer);
			
			header('Location: commander.php');
			exit();
			
		}
    }
	
}
?>
	
	</div>

	</body>
</html>
