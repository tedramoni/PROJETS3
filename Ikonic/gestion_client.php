<?php
session_start();
$form=true;
if(!isset($_SESSION['pseudo'])) {
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
	<meta charset="utf-8" />

<title>Ikonic: Gestion de client</title>
</head>


<body>
<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li><a href="discussion.php">Accueil</a></li>
		<li><a href="info.php">Info'</a></li>
		<li><a href="lien.php">Liens</a></li>
		<!-- C DUR -------------------------------!-->
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
				<li class="current_page_item"><a href="configuration.php">Mon compte</a></li>
			<?php }?>
		
		<li><a href="contact.php">Contact</a></li>
	</ul>
</nav>


<section>
	<?php
		if($form)
		{
	?>
	<div id="menu_c">
		<center>
		<li><?php echo $_SESSION['pseudo'];?></li>
		<li>Administrateur</li>
		<li><?php echo $_SERVER["REMOTE_ADDR"]; ?></li>
		<li><a href="deconnexion.php">Vous déconnecter</a></li>
		</center>
	</div>
	<h1 style="padding-bottom: 15px; text-align:center;">Gestion de client</h1>

	<article>
	<br/><br/>
		<p>Vous pouvez :</p>
		<ol style="padding-left:50px;">
			<li>Ajouter un client</li>
			<li>Modifier un client</li>
			<li>Consulter un client</li>
		</ol>
	<br/><br/>

	<center>
	<div id="config_style">
		<table>
			<tr>
				<th><a href="ajout_client.php"><img id="imageArticle" src="Images/ajout.png" alt="" /><p>Ajouter un client</p></a></th>
				<th><a href="search/index2.php" ><img id="imageArticle" src="Images/update.png" alt="" /><p>Modifier un client</p></a></th>
								<th><a href="search/"><img id="imageArticle" src="Images/consult.png" alt="" /><p>Consulter un client</p></a></th>
			</tr>
		</table>
	</center>
	</div>
	</article>

	<?php
	}
	else
		{
			echo "<center><p style=\"color:red;\">Vous n'êtes pas connecté !</p></center>";
		}
	?>
</section>

<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
