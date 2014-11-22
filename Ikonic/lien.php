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
	<link rel="stylesheet" type="text/css" href="style/style_test.css" />
	<link rel="stylesheet" type="text/css" href="style/feuille_de_style.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="style/couleur3.css" />
	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="Images/favicon.ico" />
	<meta charset="utf-8" />

<title>Ikonic: Liens</title>
</head>


<body>
<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li><a href="discussion.php">Accueil</a></li>
		<li><a href="info.php">Info'</a></li>
		<li class="current_page_item"><a href="#.php">Liens</a></li>
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
	<h1 style="padding-bottom: 15px; text-align:center;">Liens</h1>

	<article>
	<br/><br/>
	<div id="lien">
    <p> 
		<b>LiENS UTiLES</b><br><hr><br>
		Lien du <a href="https://github.com/Speleo99/PROJETS3" target="_blank">dépôt</a> GitHub.<br>
		Lien de la <a href="http://iuted.bugs3.com/projet/docs/" target="_blank">documentation</a>.<br><br>
		<b>GENERATION BL/FACTURE/DUPLICATA</b><br><hr><br>
		<a href="http://iuted.bugs3.com/projet/bon_livraison.php">Générer un bon de livraison</a> <br>
		<a href="http://iuted.bugs3.com/projet/facture.php">Générer une facture.</a> <br>
		<a href="http://iuted.bugs3.com/projet/facture_duplicata.php">Générer un duplicata de la facture.</a><br><br>
		<b>CODE SOURCE</b><br><hr><br>
		Template du bon de livraison : <br> <a href="http://iuted.bugs3.com/projet/highlighter.php?fichier=bl_template.php">bl_template.php</a> <br><br>
		Bon de livraison : <br> <a href="http://iuted.bugs3.com/projet/highlighter.php?fichier=bon_livraison.php">bon_livraison.php</a> <br><br>
		Template de la facture : <br> <a href="http://iuted.bugs3.com/projet/highlighter.php?fichier=facture_template.php">facture_template.php</a> <br><br>
		Facture : <br> <a href="http://iuted.bugs3.com/projet/highlighter.php?fichier=facture.php">facture.php</a> <br><br>
		Duplicata de la facture : <br> <a href="http://iuted.bugs3.com/projet/highlighter.php?fichier=facture_duplicata.php">facture_duplicata.php</a> <br><br><br>
		<b>RECHERCHE CLIENT INTELLIGENTE + REMPLISSAGE FORMULAIRE</b><br><hr><br>
		Lien de la gestion des <a href="http://iuted.bugs3.com/projet/search/">clients</a><br><br><br>
			<b>INTERFACE WEB V2 - Update du 23/11/2014</b><br><hr><br>
		Lien de l'<a href="http://iuted.bugs3.com/projet/Ikonic2/index.php">interface</a> web.<br>
		Ajout de la page d'<a href="ajout_client.php">ajout du client</a> avec formulaire dynamique pour les adresses livraison/facturation.
	</p>
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