<?php
session_start();
include ('connexionBDD.php');
?>

<html>
	<body>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css"/>
		
		<?php require "entete.php"; ?>
		


<?php
if(isset($_GET['ID_Produit']))
{
	$query = "SELECT * FROM Produits WHERE ID_Produit = '$_GET[ID_Produit]'";
	$resultat = mysqli_query($mysqli, $query);
}
if($resultat->num_rows <= 0)
{
	header("location:boutique.php");
	exit();
}

//Affichage des produits en détail
$produit = $resultat->fetch_assoc();
$contenu .= "<div id='produit'>";
$contenu .= "<h2>$produit[Nom_Produit]</h2><hr><br>";
$contenu .= "<img src='../Images/$produit[Image_Produit]' ='150' height='150'>";
$contenu .= "<p><i>$produit[Description_Produit]</i></p><br>";
$contenu .= "<p>$produit[Date_Produit]</p><br>";
$contenu .= "<p>Prix : $produit[Prix_Produit] €</p><br>";
$contenu .= "</div>";

//Ajouter un produit au panier
if($produit['Quantite_Produit'] > 0)
{
    $contenu .= "<i>Nombre de produit(s) disponible(s) : $produit[Quantite_Produit] </i><br><br>";
    $contenu .= '<form method="post" action="panier.php">';
        $contenu .= "<input type='hidden' name='ID_Produit' value='$produit[ID_Produit]'>";
        $contenu .= '<label for="quantite">Nombre de produits souhaités : </label>';
        $contenu .= '<select id="quantite" name="quantite">';
        for($i = 1; $i <= $produit['Quantite_Produit'] && $i <= 10; $i++)
        {
			$contenu .= "<option>$i</option>";
        }
        $contenu .= '</select>';
        
        $contenu .= '<input type="submit" name="ajout_panier" value="Ajout au panier">';
    $contenu .= '</form>';
}
else
{
    $contenu .= "Ce produit n'est plus disponible en boutique";
}

echo $contenu;

?>
	</body>
</html>




