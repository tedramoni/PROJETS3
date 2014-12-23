<?php
session_start();
include("../Inclusion/gestion.php");
if(isset($_SESSION['pseudo']))
{
		connexion();
		$user=$_SESSION['pseudo'];
		$sql='SELECT email FROM membre WHERE pseudo="'.$user.'"';
		$email_user=mysql_query("$sql") or die('Erreur au niveau du mail'.mysql_error());
		$data=mysql_fetch_array($email_user);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="../style/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="../style/TableCSSCode.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="../style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="../style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="../style/couleur3.css" />
	<script type="text/javascript" src="../Inclusion/styleswitcher.js"></script>
	<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
	<link rel="icon" type="image/ico" href="../Images/favicon.ico" />
	<meta charset="utf-8"/>
	<title>Ikonic: Contact</title>
</head>


<body>

<?php include("../Inclusion/header.php");?>
<nav id="menu">
	<ul>
		<li><a href="../discussion.php">Accueil</a></li>
		<li><a href="../info.php">Info'</a></li>
		<li><a href="../lien.php">Liens</a></li>
		<!-- C DUR -------------------------------!-->
		<?php
			if(!isset($_SESSION['pseudo']))
			{
		?>
				<li><a href="../index.php">Se Connecter</a></li>
		<?php
			}
			else
			{
		?>
				<li class="current_page_item"><a href="../configuration.php">Mon compte</a></li>
			<?php }?>
		
		<li><a href="../contact.php">Contact</a></li>
	</ul>
</nav>


<section>
<?php
if(isset($_SESSION['pseudo']))
{
?>
	<div id="menu_c">
		<center>
		<li><?php echo $_SESSION['pseudo'];?></li>
		<li>Administrateur</li>
		<li><?php echo $_SERVER["REMOTE_ADDR"]; ?></li>
		<li><a href="../deconnexion.php">Vous déconnectez</a></li>
		</center>
	</div><br /> <br />
<?php
	if(isset($_GET['state']) && isset($_GET['type']))
	{
		if($_GET['state'] == 'success')
		{	
			if($_GET['type'] == 'client')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Client supprimé avec succès ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}
			if($_GET['type'] == 'contact')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Contact supprimé avec succès ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}
			if($_GET['type'] == 'adresse')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Adresse supprimée avec succès ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}			
		}
		if($_GET['state'] == 'error')
		{	
			if($_GET['type'] == 'client')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Une erreur a eu lieu lors de la suppression du client ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}
			if($_GET['type'] == 'contact')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Une erreur a eu lieu lors de la suppression du contact ! ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}
			if($_GET['type'] == 'adresse')
			{	
				echo '<h1 style="padding-bottom: 40px; text-align:center;"> Une erreur a eu lieu lors de la suppression de l\' adresse ! </h1>';
				echo '<a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">Retourner à la page de modification</a>'; 
			}			
		}		
	}
}
?>
</section>

<?php include("../Inclusion/bottom.php"); ?>



</body>


</html>
