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
				<li class="current_page_item"><a href="#.php">Mon compte</a></li>
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
	</div>
<?php
}

// AFFICHAGE DU CLIENT APRES ENVOIE DU CODE

if(isset($_POST['envoie']))
{
	if(isset($_POST['cc']))
	{
		$code_client=$_POST['cc'];
		$connexion=mysqli_connect('mysql.serversfree.com', 'u157965635_root', 'ramoni') or die ("Connexion Impossible");
		$bd="u157965635_ikc";
		mysqli_select_db($connexion, $bd) or die ("Erreur l.16");
		$query='SELECT * from client where code = "'.$code_client.'"';
		$query2='SELECT * FROM adresse WHERE type = "L" AND code_client = "'.$code_client.'"';
		$query3='SELECT * FROM adresse WHERE type = "F" AND code_client = "'.$code_client.'"';
		$result=mysqli_query($connexion,$query) or die ("Erreur l.19");
		$result2=mysqli_query($connexion,$query2) or die ("Erreur l.20");
		$result3=mysqli_query($connexion,$query3) or die ("Erreur l.20");

		$colum_result = mysqli_query($connexion,"SHOW COLUMNS FROM client");
	}
?>
<!-- INFOS CLIENTS -->
<br /><br /><br />
<h2> Client </h2>
<br />
<center><div class="CSSTableGenerator" > <table>
	<tbody>
		<tr><?php
			echo '<th>Code Client</th>';
			echo '<th>Forme Juridique</th>';
			echo '<th>Raison Sociale</th>';
			echo '<th>Nom Commercial</th>';
			echo '<th>Mode Réglement</th>';
			echo '<th>Echéance</th>';
			echo '<th>Remise</th>';
			echo '<th>Infos Complémentaires</th>';	
		?></tr> 
		<tr><?php
			while($ligne=mysqli_fetch_row($result))
			{
				for($i=0;$i<8;$i++)
				{
						echo '<td>'.$ligne[$i].'</td>';		
				}
			 }
		?></tr>
	</tbody>
</table></center></div>
<!-- ADRESSE DE LIVRAISON -->
<br /><br /><br />
<h2> Adresse de Livraison </h2>
<br />
<center><div class="CSSTableGenerator" > <table>
	<tbody>
		<tr><?php
			echo '<th>Numéro</th>';
			echo '<th>Code Client</th>';
			echo '<th>Adresse</th>';
			echo '<th>Complément d\'adresse 1</th>';
			echo '<th>Complément d\'adresse 2</th>';
			echo '<th>Code Postal</th>';
			echo '<th>Ville</th>';
			echo '<th>Pays</th>';
			echo '<th>Tel.</th>';
			echo '<th>Email</th>';
			echo '<th>Site web</th>';
			echo '<th> </th>';			
		?></tr> 
		    <?php
			$j=1;
			while($ligne=mysqli_fetch_row($result2))
			{
				echo '<tr>';
				for($i=0;$i<10;$i++)
				{
					if ($i==0) 
					{
						echo '<td>Adresse '.$j.'</td>';
						echo '<td>'.$ligne[$i].'</td>';
					}
					else
					{
						echo '<td>'.$ligne[$i].'</td>';
					}
				}
					 echo "<td style='text-align:center'>
								<a onclick='return window.confirm('Etes-vous sûr ?')' title='Supprimer' href=''>
								<img title='supprimer' alt='supprimer' src='http://iuted.bugs3.com/projet/Ikonic2/Images/pictoPoubelle.gif' /></a>
							</td>";	
				echo '</tr>	';		
				$j=$j+1;
			}
		?></tr>
	</tbody>
</table></center></div>
<p style="margin-top:10px">&raquo;&nbsp;<a href="">Ajouter une adresse</a></p>
<!-- ADRESSE DE FACTURATION -->
<br /><br /><br />
<h2> Adresse de Facturation </h2>
<br />
<center><div class="CSSTableGenerator" > <table>
	<tbody>
		<tr><?php
			echo '<th>Numéro</th>';
			echo '<th>Code Client</th>';
			echo '<th>Adresse</th>';
			echo '<th>Complément d\'adresse 1</th>';
			echo '<th>Complément d\'adresse 2</th>';
			echo '<th>Code Postal</th>';
			echo '<th>Ville</th>';
			echo '<th>Pays</th>';
			echo '<th>Tel.</th>';
			echo '<th>Email</th>';
			echo '<th>Site web</th>';
			echo '<th> </th>';			
		?></tr>
		<?php
		
			while($ligne=mysqli_fetch_row($result3))
			{
				$j=1;
				echo '<tr>';
				for($i=0;$i<10;$i++)
				{
					if ($i==0) 
					{
						$j=$i+1;
						echo '<td>Adresse '.$j.'</td>';
						echo '<td>'.$ligne[$i].'</td>';
					}
					else
					{
						echo '<td>'.$ligne[$i].'</td>';
					}
				}
					 echo "<td style='text-align:center'>
								<a onclick='return window.confirm('Etes-vous sûr ?')' title='Supprimer' href=''>
								<img title='supprimer' alt='supprimer' src='http://iuted.bugs3.com/projet/Ikonic2/Images/pictoPoubelle.gif' /></a>
							</td>";		
				echo '</tr>';	
				$j=$j+1;
			}
		?>
	</tbody>
</table></center></div>
<p style="margin-top:10px">&raquo;&nbsp;<a href="">Ajouter une adresse</a></p>
</section>
<?php
}
include("../Inclusion/bottom.php"); ?>

</body>
</html>
