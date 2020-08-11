<?php
include ('connexionBDD.php');

$AfficherFormulaire=1;

if(isset($_POST['pseudo'],$_POST['mdp']))
{
    if(empty($_POST['pseudo']))
    {
        echo "Pseudo non renseigné.";
    }
    elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo']))
    {
        echo "Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    }
    elseif(strlen($_POST['pseudo'])>25)
    {
        echo "Le pseudo est trop long, il dépasse 25 caractères.";
    }
    elseif(empty($_POST['mdp']))
    {
        echo "Mot de passe non renseigné.";
    }
    
    elseif(empty($_POST['email']))
    {
		echo "Email non renseigné.";
	}
	
    elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM Clients WHERE pseudo='".$_POST['pseudo']."'")) == 1)
    {
        echo "Ce pseudo est déjà utilisé.";
    }
    else
    {	
        if(!mysqli_query($mysqli,"INSERT INTO Clients SET pseudo='".$_POST['pseudo']."', mdp='".md5($_POST['mdp'])."', email='".$_POST['email']."'"))
        {
            echo "Une erreur s'est produite: ".mysqli_error($mysqli); //Mettre dans un fichier log avant le rendu
        }
        else
        {
            echo "Vous êtes inscrit avec succès!";
            $AfficherFormulaire = 0;
            header('Location: index.php');
			exit();
        }
    }
}
?>

<html>	
	<body>
		<link rel="stylesheet" href="style.css"/>
		<?php require "entete.php"; ?>
		
		<h2>Inscription</h2>
		<div class="container">
			<?php
			if($AfficherFormulaire == 1)
			{
			?>
     
				<form method="post" action="inscription.php">
					Pseudo : <input type="text" name="pseudo">
		
					Mot de passe : <input type="password" name="mdp">

					Email : <input type="text" name="email">
				
					<input type="submit" value="S'inscrire">
				</form>
			<?php
			}
			?>
		</div>
	</body>
</html>

