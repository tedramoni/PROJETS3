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
	<script type="text/javascript">
	function insertext(text)
	{
		document.comment.texte.value+=" "+ text;
		document.comment.texte.focus();
	}
</script>

<title>Ikonic: Discussion</title>
</head>


<body>
<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li class="current_page_item"><a href="#.php">Accueil</a></li>
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
				<li><a href="configuration.php">Mon compte</a></li>
			<?php }?>
		
		<li><a href="contact.php">Contact</a></li>
	</ul>
</nav>


<section>

	<h1 style="padding-bottom: 35px; text-align:center;">Discussion</h1>
	<center>
	<?php
		//GESTION DU MESSAGE
	if(isset($_SESSION['pseudo']))
	{
		if(isset($_POST['poster'])) 
		{
			if(isset($_POST['titre']) && isset($_POST['texte']))
			{
				if(!empty($_POST['titre']) && !empty($_POST['texte']))
				{
					$titre=htmlentities($_POST['titre']);
					$texte=htmlspecialchars($_POST['texte']);
					//ON SE CONNECTE A LA BDD
					connexion();
					//INSERTION DU MESSAGE
					$sql="INSERT INTO livre_or(titre,texte,pseudo) VALUES('".$titre."','".$texte."','".$_SESSION['pseudo']."');";
					mysql_query($sql) or die("souci au niveau de l'insertion des donnees".mysql_error());
					echo "<p style=\"color:green;\">Message enregistré.</p>";
				}
				else
				{
					echo "<p style=\"color:red;\">Erreur: vous n'avez pas renseigné tout les champs</p>";
				}
			}
			else
			{
				echo "<p style=\"color:red;\">Erreur: vous n'avez pas renseigné tout les champs</p>";
			}
		}
	}
	else
	{
		$form=false;
		echo "<p style=\"color:red;\">Vous devez être connecté pour envoyer un message</p>";
	}
	?>
	</center>
	<?php
	if($form)
	{
	?>
		<form method="POST" action="" name="comment">
			<center>
			<table>
				<tr>
					<th style="float:right;">&nbsp;</th>
					<th><input type="text" name="titre" placeholder="&nbsp;&nbsp;Titre"/></th>
				</tr>
				<tr>
					<th style="float:right;">&nbsp;</th>
					<th>
						<a href="javascript:insertext(':smile:','short')"><img src="Images/smiley/smile.gif" alt="smile" /></a>
						<a href="javascript:insertext(':wink:','short')"><img src="Images/smiley/wink.gif" alt="wink" /></a>
						<a href="javascript:insertext(':wassat:','short')"><img src="Images/smiley/wassat.gif" alt="wassat" /></a>
						<a href="javascript:insertext(':tongue:','short')"><img src="Images/smiley/tongue.gif" alt="tongue" /></a>
						<a href="javascript:insertext(':laughing:','short')"><img src="Images/smiley/laughing.gif" alt="laughing" /></a>
						<a href="javascript:insertext(':sad:','short')"><img src="Images/smiley/sad.gif" alt="sad" /></a>
						<a href="javascript:insertext(':angry:','short')"><img src="Images/smiley/angry.gif" alt="angry" /></a>
						<a href="javascript:insertext(':crying:','short')"><img src="Images/smiley/crying.gif" alt="crying" /></a>
					</th>
				</tr>
				<tr>
					<th style="float:right; padding-bottom: 105%;">Message :&nbsp;</th>
					<th><textarea name="texte" rows="10" cols="50"> </textarea></th>
				</tr>
			</table>
			<input type="submit" name="poster" value="Poster"/>
			</center>
		</form>
	
	<?php
	}
	?>	
	<h1 style="padding: 35px; text-align:center;">Vos messages</h1>
	<center>
	<?php
		connexion();
		//AFFICHE
		$sql="SELECT*FROM livre_or ORDER BY date desc";
		$requete=mysql_query($sql);
		while($result=mysql_fetch_array($requete))
		{
			//OBTENTION DE L'AVATAR
			if((isset($_SESSION['pseudo'])) and $_SESSION['pseudo']=="root")
			{
			?>
				<h3><?php echo "{$result['titre']}";?><a href="discussion.php?id_supp=<?php echo "{$result['id']}";?>" title="Supprimer le commentaire" onClick="window.alert('Commentaire supprimé!').html"><img src="Images/zbel.gif" style="float:right;padding-right:5px;"alt="supprimer"/></a></h3>
			<?php
			}
			else
			{
				echo "<h3>{$result['titre']}</h3>";
			}
			echo "<img src=\"Images/avatar_defaut.png\"  style=\"float:left; margin-top:0px;\" width=\"50\" height=\"50\" />";
			echo "<p style=\"margin-top: 13px;\">";
			echo nl2br(filtre_texte($result['texte'])); //nl2br pour les sauts de ligne
			echo "</p>";
			echo "<p style=\"font-size: 10px;text-align:right;font-style:italic;\"> posté par {$result['pseudo']}</p>";
			
		}
		if(isset($_GET['id_supp']) and !empty($_GET['id_supp']))
		{
		
			$sql_supp="DELETE FROM livre_or WHERE id={$_GET['id_supp']}";
			mysql_query($sql_supp);
			header('Location: discussion.php');
		}
	?>
	
	
	</center>

</section>

<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
