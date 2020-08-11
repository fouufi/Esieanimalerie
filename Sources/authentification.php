<?php
session_start();
include ('connexionBDD.php');

if(isset($_POST['connexion']))
{
    if(empty($_POST['pseudo']))
    {
        echo "Pseudo non renseigné";
    }
    else
    {
		if(empty($_POST['mdp']))
		{
            echo "Mot de passe non renseigné";
        }
        else
        {
			$Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "ISO-8859-1"); //Empêche les injections SQL
			$MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "ISO-8859-1");

			if(!$mysqli)
			{
                echo "Erreur de connexion à la base de données.";
            }
            else
            {
                //Recherche si les données existent et correspondent:
                $Requete = mysqli_query($mysqli,"SELECT * FROM Clients WHERE pseudo = '".$Pseudo."' AND mdp = '".md5($MotDePasse)."'");
				
				if(mysqli_num_rows($Requete) == 0) //Aucun résultat trouvé
				{
                    echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                }
                else
                {
                    $_SESSION['pseudo'] = $Pseudo;
                    
                    echo "Vous êtes connecté";
                    $_SESSION['ConnectOK'] = true; //Statut de connexion
                    $_SESSION['panier'] = array(); //Création du panier

                    header('Location: index.php');
					exit();
                }
            }
        }
    }
}

?>

<html>
	<link rel="stylesheet" href="style.css"/>
	<?php require "entete.php"; ?>
	
	<h2>Authentification</h2>
	<div class="container">
		<form action="authentification.php" method="post">
			Pseudo: <input type="text" name="pseudo" value="" />

			Mot de passe: <input type="password" name="mdp" value="" />

			<input type="submit" name="connexion" value="Connexion" />
		</form>
	</div>
</html>
