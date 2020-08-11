<?php
include ('connexionBDD.php');
session_start();

if (isset($_POST['achat']))
{
	if(empty($_POST['n_carte']))
    {
        echo "Numéro de la carte bancaire non renseigné";
    }
    
    if(empty($_POST['ddv']))
    {
        echo "Date de validité non renseigné";
    }
    
    if(empty($_POST['cvv']))
    {
        echo "CVV non renseigné";
    }
    
    elseif (strlen($_POST['n_carte']) != 16)
    {
        echo "Le numéro de la carte n'a pas le bon nombre de caractères.";
    }
    
    elseif(!preg_match("^[0-9]+$",$_POST['n_carte']))
    {
        echo "Le numéro de la carte doit être composé uniquement de chiffres.";
    }
    elseif(!preg_match("^[0-9]+$",$_POST['cvv']))
    {
        echo "Le CVV doit être composé uniquement de chiffres";
    }
    elseif(strlen($_POST['cvv']) != 3)
    {
		echo "Le CVV doit être composé de 3 chiffres.";
    }
    
    for ($i = 0; $_SESSION['panier'][$i] != NULL; $i++) 
	{
		unset($_SESSION['panier'][$i]);
	}
	
	//Le payement a bien été effectué, on revient sur l'index
    header('Location: index.php');
    
}

?>

<html>	
	<body>
		<link rel="stylesheet" href="style.css"/>
		<?php require "entete.php"; ?>
		
		<h2>Payement par CB</h2>
		<div class="container">
				<form method="post" action="commander.php">
					Numéro de carte : <input type="text" name="n_carte">
		
					Date de validité : <input type="text" name="ddv">

					CVV : <input type="text" name="cvv">
				
					<input type="submit" name="achat" value="Finaliser l'achat">
				</form>
		</div>
	</body>
</html>

