<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script type="text/javascript" src="Inclusion/ajout_client.js"></script> 

	<title>Ikonic: Update</title>
	<style type="text/css">
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        .prev, .next { background-color:#000; padding:5px 10px; color:#fff; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#000; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:24px; float:left; padding:10px; color:#b0b1b3;}
        #steps li span {font-size:11px; display:block;}
        #steps li.current { color:#000;}
        #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#000;}
    </style>
	<script type="text/javascript" src="Inclusion/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#formu_contact").formToWizard()
        });
    </script>
</head>


<body>


	<section>
		<?php include("Inclusion/gestion.php");  include("Inclusion/header.php"); actif(1); ?><br/><br/>
		<h1 style="padding-top: 55px; text-align:center;">Update</h1><br/>
	
		<?php

		if(isset($_GET['code']))
		{
			$code_client=$_GET['code'];
			$connexion=connexionI() or die ("Connexion Impossible");
			
			// Test : Code client existe ? Sinon, erreur.
			$test1 = "Select code from client ";
			$test1 .= "where code = '$code_client'";
			$actiontest1 = mysqli_query($connexion, $test1);
			$resultattest1 = mysqli_fetch_row($actiontest1);
			if ($resultattest1[0] == $code_client)
			{
			
				$query='SELECT * from client where code = "'.$code_client.'"';
				$query2='SELECT * FROM adresse WHERE type = "L" AND code_client = "'.$code_client.'"';
				$query3='SELECT * FROM adresse WHERE type = "F" AND code_client = "'.$code_client.'"';
				$query4='SELECT * FROM contact WHERE code_client = "'.$code_client.'"';
				$result=mysqli_query($connexion,$query) or die ("Erreur l.19");
				$result2=mysqli_query($connexion,$query2) or die ("Erreur l.20");
				$result3=mysqli_query($connexion,$query3) or die ("Erreur l.20");
				$result4=mysqli_query($connexion,$query4) or die ("Erreur l.21");
			
				?>

				<!-- FORMULAIRE -->
				<div id="formu_contact">
					<?php
							while($ligne=mysqli_fetch_row($result))
							{
					?>
							<form method="post" action="update.php" name="form_contact"><br/>							
							<label for="commercial"><u>Commercial :</u> </label><input type="text" name="commercial" required="required" value="<?php echo $ligne[3];?>" />
							<br/>
							<fieldset>
								<legend>Coordonnées du client</legend><br/>
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
								<textarea name="contenu" rows="17" cols="60"><?php echo $ligne[9]; ?></textarea><br/>
							</fieldset>
							<?php
							}
						?>

				<!-- INFOS CONTACT -->
				<?php
							$i=1;
							while($ligne=mysqli_fetch_row($result4))
							{
								?>				
								<fieldset>
								<?php echo'<legend>Contact '.$i.'</legend>'; ?>
								<br />
								<table><tr><td>
								<label for="code_contact">Code: </label><input type="text" name="code_contact[]" value="<?php echo $ligne[0]; ?>" readonly/><br/>
								<label for="nom_contact">Nom: </label><input type="text" name="nom_contact[]" value="<?php  echo $ligne[1]; ?>" /><br/>
								<label for="civilite">Civilité: </label>
									<select name="civilite[]" required="required" onchange="change_manga(this.value)">
										<option value="<?php  echo $ligne[2]; ?>"><?php  echo $ligne[2]; ?></option>
										<option value="M">M.</option>
										<option value="Mlle">Mlle.</option>
										<option value="MMe">MMe.</option>	
								</select><br/><br/>
								<label for="fonction">Fonction: </label><input type="text" name="fonction[]" required="required" value="<?php  echo $ligne[3];?>"/><br/>
								</td><td>
								<label for="tel_bur">Téléphone de bureau: </label><input type="text" name="tel_bur[]" value="<?php  echo $ligne[5]; ?>"/><br/>
								<label for="tel_mob">Téléphone mobile: </label><input type="text" name="tel_mob[]" required="required" value="<?php  echo $ligne[4]; ?>"/><br/>
								<label for="fax">Fax: </label><input type="text" name="fax[]" value="<?php  echo $ligne[6]; ?>" /><br/>
								<label for="email_contact">Email: </label><input type="text" name="email_contact[]" required="required" value="<?php echo $ligne[7]; ?>" /><br/>
								</td></tr></table>
								<br />
								<?php if($i != 1) echo "<a title='Supprimer' href='delcontact.php?id=".$ligne[0]."'><strong>Supprimer contact</strong></a>";?> <br/>		
							</fieldset>
							<?php $i++;		
							}
						?>					
							<br/>
				<?php
							$i=1;
							while($ligne=mysqli_fetch_row($result2))
							{
								?>				
								<fieldset>
								<?php echo'<legend>Adresse Livraison '.$i.'</legend>'; ?>
								<br />
								<table>
									<tr>
									<td>
									<label for="BX_adr1">Adresse 1: </label>
									<input type="text" class="small"  name="BX_adr1[]" value="<?php  echo $ligne[1]; ?>"/><br/>
									
									<label for="BX_adr2">Adresse 2: </label>				
									<input type="text" class="small"  name="BX_adr2[]" value="<?php  echo $ligne[2]; ?>"/><br/>
									
									<label for="BX_adr3">Adresse 3: </label>
									<input type="text" class="small"  name="BX_adr3[]" value="<?php  echo $ligne[3]; ?>"/><br/>

									<label for="BX_cp">Code Postal: </label>
									<input type="text" class="small"  name="BX_cp[]" value="<?php  echo $ligne[4]; ?>"/><br/>
									
									<label for="BX_ville">Ville: </label>
									<input type="text" class="small"  name="BX_ville[]" value="<?php  echo $ligne[5]; ?>"/><br/>
								</td><td>
									<label for="BX_pays">Pays: </label>
									<input type="text" class="small"  name="BX_pays[]" value="<?php  echo $ligne[6]; ?>"/><br/>

									<label for="BX_tel_bur">Tel. Bureau: </label>
									<input type="text" class="small"  name="BX_tel_bur[]" value="<?php  echo $ligne[7]; ?>" /><br/>

									<label for="BX_email">Email: </label>
									<input type="text" class="small"  name="BX_email[]" value="<?php  echo $ligne[8]; ?>"/><br/>

									<label for="BX_site_web">Site Web: </label>
									<input type="text" class="small"  name="BX_site_web[]" value="<?php  echo $ligne[9]; ?>"/><br/><br/>
								</td></tr></table>
								<br />
							</fieldset>
							<?php $i++;		
							}
						?>
						<br />
				<?php
							$j=1;
							while($ligne=mysqli_fetch_row($result3))
							{
								?>				
								<fieldset>
								<?php echo'<legend>Adresse Facturation '.$j.'</legend>'; ?>
								<br />
								<table><tr><td>
									<label for="BX_adr1">Adresse 1: </label>
									<input type="text" class="small"  name="BX_adr1_2[]" value="<?php  echo $ligne[1]; ?>"/><br/>
									<label for="BX_adr2">Adresse 2: </label>
									
									<input type="text" class="small"  name="BX_adr2_2[]" value="<?php  echo $ligne[2]; ?>"/><br/>
									
									<label for="BX_adr3">Adresse 3: </label>
									<input type="text" class="small"  name="BX_adr3_2[]" value="<?php  echo $ligne[3]; ?>"/><br/>

									<label for="BX_cp">Code Postal: </label>
									<input type="text" class="small"  name="BX_cp2[]" value="<?php  echo $ligne[4]; ?>"/><br/>
										
									<label for="BX_ville">Ville: </label>
									<input type="text" class="small"  name="BX_ville2[]" value="<?php  echo $ligne[5]; ?>"/><br/>
							</td><td>
									<label for="BX_pays">Pays: </label>
									<input type="text" class="small"  name="BX_pays2[]" value="<?php  echo $ligne[6]; ?>"/><br/>

									<label for="BX_tel_bur">Tel. Bureau: </label>
									<input type="text" class="small"  name="BX_tel_bur2[]" value="<?php  echo $ligne[7]; ?>" /><br/>

									<label for="BX_email">Email: </label>
									<input type="text" class="small"  name="BX_email2[]" value="<?php  echo $ligne[8]; ?>"/><br/>

									<label for="BX_site_web">Site Web: </label>
									<input type="text" class="small"  name="BX_site_web2[]" value="<?php  echo $ligne[9]; ?>"/><br/><br/>	

								</td></tr></table><br/>
							</fieldset>
							<?php $j++;		
							}
						?>		
					</div>	
							<center><input type="submit" name="update" value="Modifier" />
							<a title="suppression" href="modif_client.php?id=<?php echo $code_client; ?>"><button type="button">Supprimer client</button></a></center>			
					</form>
				
				<!-- FIN TEST FORMULAIRE -->
				<br /><br />
<?php	
			}// fin du test (si le code client existe bien)
			else
			{
				header( "refresh:5;url=client.php" ); 
				echo "<br>
						<center><p style='color:red;'>Le code client n'existe pas !<br>
						Vous serez redirigé dans 5 secondes. Si cela ne marche pas, <a href='index2.php'>cliquez ici</a>.</p></center>"; 
			}

		}//Fin if (isset($_POST['cc']))
		if(isset($_GET['id']))
		{
			connexion();
			$code=$_GET['id'];
			$sql="DELETE FROM CLIENT WHERE code='$code';";
			mysql_query($sql) or die(mysql_error());
			header('Location:client.php');
		}

?>
	
	
	
	
</section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
