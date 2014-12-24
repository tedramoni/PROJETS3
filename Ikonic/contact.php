<?php
session_start();
include("Inclusion/gestion.php");
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
	<link rel="stylesheet" type="text/css" href="style/feuille_de_style.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="style/couleur3.css" />
	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="Images/favicon.ico" />
	<meta charset="utf-8"/>
	<title>Ikonic: Contact</title>
</head>


<body>

<?php include("Inclusion/header.php");?>
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
		
		<li class="current_page_item"><a href="contact.php">Contact</a></li>
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
		<li><a href="deconnexion.php">Vous déconnecter</a></li>
		</center>
	</div>
<?php
}
?>
<h1 style="padding-bottom: 40px; text-align:center;">Nous contacter</h1>
<center>

<?php

if(isset($_POST['envoie']))
{
	if( !empty($_POST['pseudo']) AND !empty($_POST['mel']) AND !empty($_POST['texte']) AND !empty($_POST['sujet']) AND !empty($_POST['captcha']) )
	{

		if(($_POST['captcha'])==($_SESSION['secure']))
		{
			$destinataire='izo78@hotmail.fr';
			$message=htmlentities(trim($_POST['texte']));
			$subject=htmlentities(trim($_POST['sujet']));
			$mail=htmlentities(trim($_POST['mel']));
			$nom=htmlentities(trim($_POST['pseudo']));
			$headers = "From: \"$nom\"<$mail>\n";
			$headers .= "Reply-To: $mail\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			if (mail($destinataire,$subject,$message,$headers))
			{
				echo "<p style=\"color:green;\">Votre message a bien été envoyé<br/><br/></p>";
				//$rand=rand(10000,99999);
				//$_SESSION['secure']=$rand;
			}
			else
			{
				echo "<p style=\"color:red;\">Il y a une erreur quelque part<br/><br/></p>";
			}
		}
		else
		{
			echo "<p style=\"color:red;\">Erreur, captcha invalide  <br/></br></p>";
		}
	}
	else
	{
		echo "<p style=\"color:red;\">Erreur, vous n'avez pas renseigner tout les champs <br/></br></p>";
	}
}
?>
</center>
<form method="post" action="contact.php" id="formulaire">

		<table>
			<tr>
				<th style="float:right;"> Votre Nom : &nbsp;</th>
				<th> <input type="text" name="pseudo" value="<?php if(isset($_SESSION['pseudo'])){echo "{$_SESSION['pseudo']}";}  ?>" maxlength="40" /> </th>
			</tr>
			<tr>
				<th style="float:right;"> Votre adresse e-mail : &nbsp;</th>
				<th> <input type="email" name="mel" maxlength="60" value="<?php if(isset($_SESSION['pseudo'])){echo $data['email'];}  ?>"/> </th>
			</tr>
			<tr>
				<th style="float:right;"> Sujet :&nbsp; </th>
				<th> <input type="text" name="sujet" size="30" maxlength="60"/> </th>
			</tr>
			<tr>
				<th style="float:right; padding-bottom: 75%;"> Votre Message : &nbsp;</th>
				<th> <textarea name="texte" rows="12" cols="60" style="margin-bottom:20px;"></textarea> </th>
			</tr>
			<tr>
				<th style="float:right;"> Captcha :&nbsp; </th>
				<th colspan="2"> <input type="text" name="captcha" /> <img src="captcha.php" alt="captcha" /> </th>
			</tr>
					
			<tr> <th></th> <th><input type="submit" name="envoie" value="Envoyer" /> </th></tr>
		</table>

</form>

</section>

<?php include("Inclusion/bottom.php"); ?>



</body>


</html>
