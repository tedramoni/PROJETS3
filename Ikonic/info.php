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

<title>Ikonic: Info'</title>
</head>


<body>
<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li><a href="discussion.php">Accueil</a></li>
		<li class="current_page_item"><a href="#.php">Info'</a></li>
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
				<li><a href="configuration.php">Mon compte</a></li>
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
	<h1 style="padding-bottom: 15px; text-align:center;">Info'</h1>

	<article>
				<center><p><img src="Images/logo_iut.png" /></p>
					Projet réalisé par ZOUHIRI Malik, RAMONI Ted, COUDRAY Ugo et AZZA Nordine.
					<br/><br/>
					<h4 style="background-color:#456875;color:white;">Couleur de fond</h4><br/>
					<div id="config_style">
						<a href="#" onclick="setActiveStyleSheet(''); return false;"><img src="Images/defaut.png" /></a>
						<a href="#" onclick="setActiveStyleSheet('couleur'); return false;"><img src="Images/gris.png" /></a>
						<a href="#" onclick="setActiveStyleSheet('couleur2'); return false;"><img src="Images/feuille.png" /></a>
						<a href="#" onclick="setActiveStyleSheet('couleur3'); return false;"><img src="Images/hachure.png" /></a>
					</div>
				</center>

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
