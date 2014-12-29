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

<title>Ikonic: Gestion de stock</title>
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
				<li class="current_page_item"><a href="#.php">Mon compte</a></li>
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
		<li><a href="deconnexion.php">Vous déconnectez</a></li>
		</center>
	</div>
	<h1 style="padding-bottom: 15px; text-align:center;">Gestion de stock</h1>

	<article>
	<br/><p><a href="configuration.php">Configuration</a> >> Gestion de stock</p>
	<br/>
		<p>Vous pouvez :</p>
		<ol style="padding-left:50px;">
			<li>Ajouter un article</li>
			<li>Modifier un article</li>
			<li>Consulter un article</li>
		</ol>
	<br/><br/>

	<center>
	<div id="config_style">
		<table>
			<tr>
				<th><a href="ajout_stock.php"><img id="imageArticle" src="Images/ajout2.png" alt="" /><p>Ajouter un article</p></a></th>
				<th><a href="modif_article.php" ><img id="imageArticle" src="Images/update2.png" alt="" /><p>Modifier un article</p></a></th>
								<th><a href="consult_article.php"><img id="imageArticle" src="Images/consult2.png" alt="" /><p>Consulter un article</p></a></th>
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
