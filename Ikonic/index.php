		<?php
session_start();
$form=true;
if (isset($_SESSION['pseudo'])) {
	$form=false;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="style/feuille_de_style.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="style/couleur3.css" />
	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="Images/favicon.ico" />
	<meta charset="utf-8"/>
	<title>Ikonic: Connexion</title>
</head>


<body>

<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li><a href="discussion.php">Accueil</a></li>
		<li><a href="info.php">Info'</a></li>
		<li><a href="lien.php">Liens</a></li>
		<?php
			if(!isset($_SESSION['pseudo']))
			{
		?>
				<li><a href="index.php">Se Connecter</a></li>
		<?php
			}
			else
			{
		?>
				<li><a href="configuration.php">Mon compte</a></li>
			<?php }?>
		
		<li><a href="contact.php">Contact</a></li>
	</ul>
</nav>


<section>
	<h1 style="padding-bottom: 30px; text-align:center;">Se connecter</h1>
	<center>
	<?php
	//SI FORMULAIRE ENVOYER
	if(isset($_POST['connexion']))
	{
		//SI LES VARIABLES SUPERGLOBALES EXISTENT
		if(isset($_POST['pseudo']) && isset($_POST['passw']))
		{
			//SI LES CHAMPS NE SONT PAS VIDES
			if(!empty($_POST['pseudo']) && !empty($_POST['passw']))
			{
				//Connexion = la BDD
				connexion();
				//On sécurise
				$password=htmlspecialchars(trim($_POST['passw']));
				$login=htmlspecialchars(trim($_POST['pseudo']));
				//On crypte en sha afin de transformer le mdp tq celui enregistré dans la BDD
				$password=sha1($password);
			
				$sql = 'SELECT count(*) FROM membre WHERE pseudo="'.mysql_real_escape_string($_POST['pseudo']).'" AND password="'.mysql_real_escape_string($password).'";';
				$req = mysql_query("$sql") or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				$data = mysql_fetch_array($req);

				mysql_free_result($req);
				mysql_close();
			
				// si on obtient une réponse, alors l'utilisateur est un membre
				if ($data[0] == 1) 
				{
					session_start();
					$_SESSION['pseudo'] = $_POST['pseudo'];
					header('Location: configuration.php');
					exit();
				}
				else
				{
					echo "<p style=\"color:red;\">Votre mot de passe ou votre pseudo sont incorrects.</p>";
				}
			}
			else
			{
				echo "<p style=\"color:red;\">Tout les champs ne sont pas remplis</p>";
			}
		}
		else
		{
			echo "<p style=\"color:red;\">Hey, je ne sais pas où mais il y a une erreur</p>";
		}
	}

	?>
	<?php
	if($form)
	{
	?>
	</center>
	<br/>
	<form action="index.php" method="post" >
		<center>
	
		<table>
		<tr>
			<th style="text-align: right;"><label for="pseudo">Pseudo :&nbsp;  </label></th><th><input type="text" name="pseudo" /></tr>
		</tr>
		<tr>
			<th style="text-align: right;"><label for="passw">Mot de passe :&nbsp;  </label></th><th><input type="password" name="passw" /></th>
		</tr>
		<tr>
			<th style="font-size: 12px;" colspan="2"><input style="margin-left: 105px;" type="checkbox" value="" />&nbsp;Connexion automatique</th>
		</tr>
		<tr>
			<th colspan="2"><input style="margin-left: 50px; margin-top:10px;" type="submit" name="connexion" value="Se connecter" /></th>
		</tr>
	
		</table>
		</center>
	</form>
	<br/>
	<?php
	}
	else
	{
		echo "<p style=\"color:red;\">Vous êtes déjà connecté {$_SESSION['pseudo']}!</p>";
	}
	?>
	<?php
	try
	{
		 $bdd = new PDO('mysql:host=mysql.serversfree.com;dbname=u157965635_ikc', 'u157965635_root', 'ramoni');
	}
	catch(Exception $e)
	{
		die('Erreur: '.$e->getMessage());
	}
	?>

</section>

<?php include("Inclusion/bottom.php"); ?>



</body>


</html>
