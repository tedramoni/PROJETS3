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
<center><h1>Modifier Client</h1></center>
<br />
<br />

<!-- FORMULAIRE -->
<div id="formu_contact">
	<?php
			while($ligne=mysqli_fetch_row($result))
			{?>
			<form method="post" action="update.php" name="form_contact">	
			<label for="commercial"><u>Commercial :</u> </label><input type="text" name="commercial" required="required" value="<?php echo $ligne[3];?>" />
			<br/>
			<fieldset>
				<legend>Coordonnée du client</legend>
					<label for="code">Code: </label><input type="text" name="code" required="required"  value="<?php echo $ligne[0]; ?>" readonly/><br/>
					<label for="forme_juridique">Forme juridique: </label>
					<select name="forme_juridique" onchange="change_manga(this.value)">
						<option value="<?php echo $ligne[1]; ?>"><?php echo $ligne[1]; ?></option>
						<option value="sa">S.A</option>
						<option value="sarl">S.A.R.L</option>
						<option value="sci">SCI</option>	
						<option value="collectivite">Collectivité</option>
						<option value="particulier">Particulier</option>
					</select><br/><br/>
					<label for="raison_sociale">Raison sociale: </label><input type="text" name="raison_sociale" required="required" value="<?php  echo $ligne[2]; ?>"/>
			</fieldset>
			<br/>
			<fieldset>
				<legend>Paiement</legend>
					<label for="mode_paiement">Mode de règlement: </label>
					<select name="mode_paiement" required="required" onchange="change_manga(this.value)">
						<option value="<?php  echo $ligne[4]; ?>"><?php  echo $ligne[4]; ?></option>
						<option value="cb">Carte bancaire</option>
						<option value="virement">Virement</option>
						<option value="cheque">Chèque</option>	
						<option value="traite">Traite</option>
						<option value="especes">Espèces</option>
					</select><br/><br/>
					<label for="remise">Remise: </label><input type="number"  name="remise" min="0" max="100" value="<?php  echo $ligne[8]; ?>" required="required" /> %<br/>
					<label for="echeance">Echeance: à </label><input type="number"  name="echeance" min="0" max="100" value="<?php  echo $ligne[5];?>" required="required" /> jours.<br/>
					<label for="fdm">F.D.M: </label><input type="checkbox" name="fdm" <?php if($ligne[6]==1) echo 'checked="checked"' ?> /><br/>
					<label for="jour">le:  </label><input type="number"  name="jour" min="0" max="31" value="<?php  echo $ligne[7]; ?>" required="required" />
			</fieldset>
			<fieldset>
				<legend>Informations complémentaires</legend>
				<br/>
				<textarea name="contenu" rows="17" cols="60"><?php echo $ligne[9]; ?></textarea>
			</fieldset>
			<br/><br/>
			<?php
			}
		?>

<!-- INFOS CONTACT -->
<br />
<center><p> Modifier un contact existant ou en <a href="'<?php echo "add_infos.php?type=contact&id=".$code_client?>" onclick="window.open('<?php echo "add_infos.php?type=contact&id=".$code_client?>', 'newwindow', 'width=400, height=350, menubar=no, resizable=no, scrollbars=no, toolbar=no'); return false;"><strong>ajouter un nouveau </strong></a>(cliquer sur les mots en gras pour ouvrir un formulaire).</center> <br/><br/>
<?php
			$i=1;
			while($ligne=mysqli_fetch_row($result4))
			{
				?>				
				<fieldset>
				<?php echo'<legend><strong>CONTACT '.$i.'</strong></legend>'; ?>
				<br />
				<label for="code_contact">Code: </label><input type="text" name="code_contact[]" required="required" value="<?php echo $ligne[0]; ?>" readonly/><br/>
				<label for="nom_contact">Nom: </label><input type="text" name="nom_contact[]" required="required" value="<?php  echo $ligne[1]; ?>" /><br/>
				<label for="civilite" required="required" >Civilité: </label>
					<select name="civilite[]" required="required" onchange="change_manga(this.value)">
						<option value="<?php  echo $ligne[2]; ?>"><?php  echo $ligne[2]; ?></option>
						<option value="M">M.</option>
						<option value="Mlle">Mlle.</option>
						<option value="MMe">MMe.</option>	
				</select><br/><br/>
				<label for="fonction">Fonction: </label><input type="text" name="fonction[]" required="required" value="<?php  echo $ligne[3];?>"/><br/>
				<label for="tel_mob">Téléphone mobile: </label><input type="text" name="tel_mob[]" required="required" value="<?php  echo $ligne[5]; ?>"/><br/>
				<label for="tel_bur">Téléphone de bureau: </label><input type="text" name="tel_bur[]" value="<?php  echo $ligne[4]; ?>"/><br/>
				<label for="fax">Fax: </label><input type="text" name="fax[]" value="<?php  echo $ligne[6]; ?>" /><br/>
				<label for="email_contact">Email: </label><input type="text" name="email_contact[]" required="required" value="<?php echo $ligne[7]; ?>" /><br/>
				<br />
				<?php if($i != 1) echo "<a title='Supprimer' href='delcontact.php?id=".$ligne[0]."'><strong>Supprimer contact</strong></a>";?> <br/>		
			</fieldset><br /><br />
			<?php $i++;		
			}
		?>					
			<br/>
<center><p> Modifier une adresse de livraison existante ou en <a href="'<?php echo "add_infos.php?type=livraison&id=".$code_client?>" onclick="window.open('<?php echo "add_infos.php?type=livraison&id=".$code_client?>', 'newwindow', 'width=400, height=350, menubar=no, resizable=no, scrollbars=no, toolbar=no'); return false;"><strong>ajouter une nouvelle </strong></a>(cliquer sur les mots en gras pour ouvrir un formulaire).</center> <br/><br/>
<?php
			$i=1;
			while($ligne=mysqli_fetch_row($result2))
			{
				?>				
				<fieldset>
				<?php echo'<legend><strong>ADRESSE LIVRAISON '.$i.'</strong></legend>'; ?>
				<br />
					<label for="BX_adr1">Adresse 1: </label>
					<input type="text" required="required" class="small"  name="BX_adr1[]" value="<?php  echo $ligne[1]; ?>"/><br/>
					
					<label for="BX_adr2">Adresse 2: </label>				
					<input type="text" class="small"  name="BX_adr2[]" value="<?php  echo $ligne[2]; ?>"/><br/>
					
					<label for="BX_adr3">Adresse 3: </label>
					<input type="text" class="small"  name="BX_adr3[]" value="<?php  echo $ligne[3]; ?>"/><br/>

					<label for="BX_cp">Code Postal: </label>
					<input type="text" required="required" class="small"  name="BX_cp[]" value="<?php  echo $ligne[4]; ?>"/><br/>
						
					<label for="BX_ville">Ville: </label>
					<input type="text" required="required" class="small"  name="BX_ville[]" value="<?php  echo $ligne[5]; ?>"/><br/>

					<label for="BX_pays">Pays: </label>
					<input type="text" required="required" class="small"  name="BX_pays[]" value="<?php  echo $ligne[6]; ?>"/><br/>

					<label for="BX_tel_bur">Tel. Bureau: </label>
					<input type="text" required="required" class="small"  name="BX_tel_bur[]" value="<?php  echo $ligne[7]; ?>" /><br/>

					<label for="BX_email">Email: </label>
					<input type="text" required="required" class="small"  name="BX_email[]" value="<?php  echo $ligne[8]; ?>"/><br/>

					<label for="BX_site_web">Site Web: </label>
					<input type="text" class="small"  name="BX_site_web[]" value="<?php  echo $ligne[9]; ?>"/><br/><br/>

					<input type="hidden" class="small"  name="index[]" value="<?php  echo $ligne[11]; ?>"/><br/><br/>					
				<br />
				<?php if($i != 1) echo "<a title='Supprimer' href='deladresse.php?id=".$ligne[11]."'><strong>Supprimer adresse</strong></a>";?> <br/>	
			</fieldset><br /><br />
			<?php $i++;		
			}
		?>
		<br />
<center><p> Modifier une adresse de facturation existante ou en <a href="'<?php echo "add_infos.php?type=facturation&id=".$code_client?>" onclick="window.open('<?php echo "add_infos.php?type=facturation&id=".$code_client?>', 'newwindow', 'width=450, height=400, menubar=no, resizable=no, scrollbars=no, toolbar=no'); return false;"><strong>ajouter une nouvelle </strong></a>(cliquer sur les mots en gras pour ouvrir un formulaire).</center> <br/><br/>
<?php
			$j=1;
			while($ligne=mysqli_fetch_row($result3))
			{
				?>				
				<fieldset>
				<?php echo'<legend><strong>ADRESSE FACTURATION '.$j.'</strong></legend>'; ?>
				<br />
					<label for="BX_adr1">Adresse 1: </label>
					<input type="text" required="required" class="small"  name="BX_adr1_2[]" value="<?php  echo $ligne[1]; ?>"/><br/>
					<label for="BX_adr2">Adresse 2: </label>
					
					<input type="text" class="small"  name="BX_adr2_2[]" value="<?php  echo $ligne[2]; ?>"/><br/>
					
					<label for="BX_adr3">Adresse 3: </label>
					<input type="text" class="small"  name="BX_adr3_2[]" value="<?php  echo $ligne[3]; ?>"/><br/>

					<label for="BX_cp">Code Postal: </label>
					<input type="text" required="required" class="small"  name="BX_cp2[]" value="<?php  echo $ligne[4]; ?>"/><br/>
						
					<label for="BX_ville">Ville: </label>
					<input type="text" required="required" class="small"  name="BX_ville2[]" value="<?php  echo $ligne[5]; ?>"/><br/>

					<label for="BX_pays">Pays: </label>
					<input type="text" required="required" class="small"  name="BX_pays2[]" value="<?php  echo $ligne[6]; ?>"/><br/>

					<label for="BX_tel_bur">Tel. Bureau: </label>
					<input type="text" required="required" class="small"  name="BX_tel_bur2[]" value="<?php  echo $ligne[7]; ?>" /><br/>

					<label for="BX_email">Email: </label>
					<input type="text" required="required" class="small"  name="BX_email2[]" value="<?php  echo $ligne[8]; ?>"/><br/>

					<label for="BX_site_web">Site Web: </label>
					<input type="text" class="small"  name="BX_site_web2[]" value="<?php  echo $ligne[9]; ?>"/><br/><br/>	

					<input type="hidden" class="small"  name="index2[]" value="<?php  echo $ligne[11]; ?>"/><br/><br/>					
				<br />
				<?php if($j != 1) echo "<a title='Supprimer' href='deladresse.php?id=".$ligne[11]."'><strong>Supprimer adresse</strong></a>";?> <br/>				
			</fieldset><br /><br />
			<?php $j++;		
			}
		?>		
		
			<center><input type="submit" name="update" value="Modifier" /> <strong> OU </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="suppression" href="delete.php?id=<?php echo $code_client; ?>"><button class="button-error pure-button" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supprimer client&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a></center>			
	</form>
</div>
<!-- FIN TEST FORMULAIRE -->
<br /><br />		
</section>
<?php
}
include("../Inclusion/bottom.php"); ?>

</body>
</html>
