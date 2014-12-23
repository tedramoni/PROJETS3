<?php
session_start();
include("../Inclusion/gestion.php");
if(isset($_SESSION['pseudo']))
{
		connexion();
		$user=$_SESSION['pseudo'];
		$sql='SELECT email FROM membre WHERE pseudo="'.$user.'"';
		
		$sql2 = 'Select code,raison_sociale,cp,ville,nom_commercial from client,adresse where client.code = adresse.code_client group by code order by code ';
		$result2=mysql_query($sql2) or die ("erreur");
		
		$email_user=mysql_query("$sql") or die('Erreur au niveau du mail'.mysql_error());
		$data=mysql_fetch_array($email_user);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="../style/feuille_de_style.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="../style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="../style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="../style/couleur3.css" />
	<link rel="stylesheet" type="text/css" href="../style/TableCSSCode.css" />
	<script type="text/javascript" src="../Inclusion/styleswitcher.js"></script>

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
		<script type="text/javascript">
			var cache = {};
			$(function ()
			{
				$("#cc").autocomplete({
					source: function (request, response)
					{
						//Si la réponse est dans le cache
						if ((request.term) in cache)
						{
							response($.map(cache[request.term], function (item)
							{

								return {
									label: item.CodeClient + ", " + item.NomClient,
									value: function ()
									{
										if ($(this).attr('id') == 'cc')
										{
											return item.CodeClient;
										}
									}
								}
							}));
						}
						//Sinon -> Requete Ajax
						else
						{
							var objData = {};
							if ($(this.element).attr('id') == 'cc')
							{
								objData = { codeClient: request.term, maxRows: 10 };
							}

							$.ajax({
								url: "AutoCompletion.php",
								dataType: "json",
								data: objData,
								type: 'POST',
								success: function (data)
								{
									//Ajout de reponse dans le cache
									cache[(request.term)] = data;
									response($.map(data, function (item)
									{

										return {
											label: item.CodeClient + ", " + item.NomClient,
											value: function ()
											{
												if ($(this).attr('id') == 'cc')
												{
													return item.CodeClient;
												}
											}
										}
									}));
								}
							});
						}
					},
					minLength: 1,
					delay: 100
				});
			});
		</script>
		<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="../Images/favicon.ico" />
	<meta charset="utf-8"/>
	<title>Ikonic: Consultation</title>
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
		<li><a href="../deconnexion.php">Vous déconnecter</a></li>
		</center>
	</div>

<h1 style="padding-bottom: 40px; text-align:center;">Consulter un client</h1>
<center>
<form method="post" action="consulter_client2.php" id="formulaire">
	Entrer le CODE du CLIENT a consulter: <input type="text" name="cc" id="cc" size="6"/>	
	<input type="submit" name="envoie" value="OK" /></tr>
</form>
<!-- CLIENT LIST -->
<br /><br /><br />
<h2> Liste des clients </h2>
<br />
<center><div class="CSSTableGenerator" > <table>
	<tbody>
		<tr><?php	
			echo '<th>Code Client</th>';
			echo '<th>Raison Sociale</th>';
			echo '<th>Code Postal</th>';
			echo '<th>Ville</th>';
			echo '<th>Nom Commercial</th>';		
		?></tr> 
		    <?php
			while($ligne=mysql_fetch_row($result2))
			{
				echo '<tr>';
				for($i=0;$i<5;$i++)
				{
						echo '<td>'.$ligne[$i].'</td>';
				}
				echo '</tr>	';		
			}
		?></tr>
	</tbody>
</table>
</center>
<?php
}
else
{
	echo "<center><p style=\"color:red;\">Vous n'êtes pas connecté !</p></center>";
}
?>
</section>

<?php include("../Inclusion/bottom.php"); ?>
</body>
</html>
