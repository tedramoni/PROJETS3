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
		$query4='SELECT * FROM contact WHERE code_client = "'.$code_client.'"';
		$result=mysqli_query($connexion,$query) or die ("Erreur l.19");
		$result2=mysqli_query($connexion,$query2) or die ("Erreur l.20");
		$result3=mysqli_query($connexion,$query3) or die ("Erreur l.20");
		$result4=mysqli_query($connexion,$query4) or die ("Erreur l.21");
	}
?>
<center><h1>Consultation Client</h1></center>
<!-- INFOS CLIENTS -->
<br />
<br />
<?php
			while($ligne=mysqli_fetch_row($result))
			{?>
				<fieldset>
				<legend><strong>COORDONNÉES DU CLIENT</strong></legend>
				<br />
				<p><strong> Code Client :  </strong><?php echo $ligne[0]; ?></p><br />
				<p><strong> Forme Juridique :  </strong><?php  echo $ligne[1]; ?></p><br />
				<p><strong>  Raison Sociale :  </strong><?php  echo $ligne[2]; ?></p><br />
				<p><strong>  Nom Commercial :  </strong><?php  echo $ligne[3];?></p><br />
				<p><strong>  Mode Réglement :  </strong><?php  echo $ligne[4]; ?></p><br />
				<p><strong>  Echance :  </strong><?php  echo $ligne[5];?><?php if($ligne[6]==1) echo ", fin de mois" ?>, le <?php  echo $ligne[7]; ?></p><br />
				<p><strong>  Remise :  </strong><?php  echo $ligne[8]; ?>%</p><br />
				<p><strong>  Infos complémentaires :  </strong><?php echo $ligne[9]; ?></p><br />
				<br />
			</fieldset>
			<?php
			}
		?>
<!-- ADRESSE DE LIVRAISON -->
<br /><br /><br />
<fieldset>
<legend><strong>ADRESSE DE LIVRAISON </strong></legend><br /><br />
<center><div class="CSSTableGenerator" > <table border="0">
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
				for($i=0;$i<11;$i++)
				{
					if ($i==0) 
					{
						echo '<td>Adresse '.$j.'</td>';
						echo '<td>'.$ligne[$i].'</td>';
					}
					else
					{
						if($i==10)
						{				
							echo "<td style='text-align:center'>";
								echo "<a title='Supprimer' href='delete.php?id=".$ligne[11]."'>";
								echo "<img title='supprimer' alt='supprimer' src='http://iuted.bugs3.com/projet/Ikonic2/Images/pictoPoubelle.gif' /></a>";	
							echo "</td>";							
						}
						else { echo '<td>'.$ligne[$i].'</td>'; }
					}
				}
				echo '</tr>	';		
				$j=$j+1;
			}
		?></tr>
	</tbody>
</table></center><br /><br /></fieldset></div>

<!-- ADRESSE DE FACTURATION -->
<br /><br /><br />
<fieldset>
<legend><strong> ADRESSE DE FACTURATION </strong></legend><br /><br />
<center><div class="CSSTableGenerator" > <table border="0">
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
			$x=1;
			while($ligne=mysqli_fetch_row($result3))
			{
				echo '<tr>';
				for($i=0;$i<11;$i++)
				{
					if ($i==0) 
					{
						$j=$i+1;
						echo '<td>Adresse '.$x.'</td>';
						echo '<td>'.$ligne[$i].'</td>';
					}
					else
					{
						if($i==10)
						{				
							echo "<td style='text-align:center'>";
								echo "<a title='Supprimer' href='delete.php?id=".$ligne[11]."'>";
								echo "<img title='supprimer' alt='supprimer' src='http://iuted.bugs3.com/projet/Ikonic2/Images/pictoPoubelle.gif' /></a>";	
							echo "</td>";							
						}
						else { echo '<td>'.$ligne[$i].'</td>'; }
					}
					
				}		
				echo '</tr>';	
				$x++;
			}
		?>
	</tbody>
</table></center><br /><br /></fieldset></div><br /><br />

<!-- INFOS CONTACT -->
<br />
<br />

<?php
			$i=1;
			while($ligne=mysqli_fetch_row($result4))
			{
				?>				
				<fieldset>
				<?php echo'<legend><strong>CONTACT '.$i.'</strong></legend>'; ?>
				<br />
				<p><strong> Code :  </strong><?php echo $ligne[0]; ?></p><br />
				<p><strong> Nom :  </strong><?php  echo $ligne[1]; ?></p><br />
				<p><strong>  Civilite :  </strong><?php  echo $ligne[2]; ?></p><br />
				<p><strong>  Fonction :  </strong><?php  echo $ligne[3];?></p><br />
				<p><strong>  Téléphone Bureau :  </strong><?php  echo $ligne[4]; ?></p><br />
				<p><strong>  Téléphone Mobile :  </strong><?php  echo $ligne[5]; ?></p><br />
				<p><strong>  Fax :  </strong><?php  echo $ligne[6]; ?></p><br />
				<p><strong> Email :  </strong><?php echo $ligne[7]; ?></p><br />
				<br />
			</fieldset><br /><br />
			<?php $i++;		
			}
		?>
<center><p style="margin-top:20px">&raquo;&nbsp;<a href="">Modifier le client</a></p></center>
</section>
<?php
}
include("../Inclusion/bottom.php"); ?>

</body>
</html>
