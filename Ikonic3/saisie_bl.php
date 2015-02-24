<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<title>Ikonic: Saisie d'un BL</title>

</head>


<body>
	<section>
		<?php include("Inclusion/gestion.php");  include("Inclusion/header.php"); actif(1); ?><br/><br/>
		<h1 style="padding-top: 55px; text-align:center;">Saisie d'un bon de livraison</h1><br/><br/>	
	
	<?php
	if (isset($_GET['err']))
	{
		if ($_GET['err'] == 'err1')
		{
			echo "<center><p style='color:red;'>Le code client doit être de la forme : 9, puis une lettre, puis 4 chiffres (ex : 9L0015) !</center><br><br>";
		}
		if ($_GET['err'] == 'err2')
		{
			echo "<center><p style='color:red;'>Le code client existe déjà !</center><br><br>";
		}
	}
		$liste=array();
		connexion();
		$sql = 'Select * from client';
		$requete=mysql_query($sql);
		while($result=mysql_fetch_array($requete))
		{
			$liste[]=$result['code'];
		}
	?>
	
	<div id="formu_contact">
		<form method="post" action=".php">
		<br/>
					<label for="numero_bl"><u>N°BL :</u> </label><input type="text" id="numero_bl" name="numero_bl" required="required" />

			<fieldset><br/>
				<legend>Bon de livraison</legend>
				<label for="date">Date : </label><input type="date" name="date" id="date" maxlength="6" required="required" value="<?php echo date('Y-m-d'); ?>" /><br/>
				<label for="ref_client"><u>Référence du client :</u> </label><input type="text" id="ref_client" name="ref_client" required="required" /><br/>
				<label for="ref_fournisseur"><u>Référence du fournisseur :</u> </label><input type="text" id="ref_fournisseur" name="ref_fournisseur" required="required" /><br/>
				
				<label for="code_client"><u>Code Client :</u> </label><input type="text" id="code_client" name="code_client" onkeyup="myFunction()"/><br/>

				<script>
					function myFunction() {
						var x = document.getElementById("code_client");
						x.value = x.value.toUpperCase();
					}

				</script>			

				<script>
					//AUTO-COMPLETION
					$('#code_client').autocomplete();
					var liste = <?php echo json_encode($liste) ?>;
						
					$('#code_client').autocomplete({
						source : liste
					});			
				</script>
		
				<label for="nom_commercial"><u>Nom Commercial :</u> </label><input type="text" id="nom_commercial" name="nom_commercial" required="required" /><br/>
				<label for="mode_reglement"><u>Mode de règlement :</u> </label><input type="text" id="mode_reglement" name="mode_reglement" required="required" /><br/>
				<label for="echeance"><u>Echeance :</u> </label><input type="text" id="echeance" name="echeance" required="required" /><br/>
				<label for="infos"><u>Informations complémentaire :</u> </label><input type="text" id="infos" name="infos" required="required" /><br/>
			</fieldset>
			<fieldset><br/>
				<legend>Adresse Livraison</legend>
				<table id="dataTableAdresseLivraison" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td>					
							<label for="BX_adr1">Adresse 1: </label>
							<input type="text" class="small"  name="BX_adr1"/><br/>
							
							<label for="BX_adr2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2"/><br/>
					
							<label for="BX_adr3">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3"/><br/>

							<label for="BX_cp">Code Postal: </label>
							<input type="text" class="small"  name="BX_cp"/><br/>
						
							<label for="BX_ville">Ville: </label>
							<input type="text" class="small"  name="BX_ville"/><br/><hr>
						</td>
						<td>
							<label for="BX_pays">Pays: </label>
							<input type="text" class="small"  name="BX_pays"/><br/>

							<label for="BX_tel_bur">Tel. Bureau: </label>
							<input type="text" class="small"  name="BX_tel_bur"/><br/>

							<label for="BX_email">Email: </label>
							<input type="text" class="small"  name="BX_email"/><br/>

							<label for="BX_site_web">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web"/><br/><br/>
					     </td>
							</p>
                    </tr>
                    </tbody>
                </table>			
			</fieldset>
			<fieldset><br/>
				<legend>Adresse Facturation</legend>
				<table id="dataTableAdresseFacturation" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td>
							<label for="BX_adr1_2">Adresse 1: </label>
							<input type="text" class="small"  name="BX_adr1_2"/><br />

							<label for="BX_adr2_2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2_2"/><br />

							<label for="BX_adr3_2">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3_2"/><br />

							<label for="BX_cp2">Code Postal: </label>
							<input type="text" class="small"  name="BX_cp2"/><br/>

							<label for="BX_ville2">Ville: </label>
							<input type="text" class="small"  name="BX_ville2"/><br />
							<hr>
						</td>
						<td>
							<label for="BX_pays2">Pays: </label>
							<input type="text" class="small"  name="BX_pays2"/><br />

							<label for="BX_tel_bur2">Tel. Bureau: </label>
							<input type="text" class="small"  name="BX_tel_bur2"/><br />

							<label for="BX_email2">Email: </label>
							<input type="text" class="small"  name="BX_email2"/><br/>

							<label for="BX_site_web2">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web2"/><br/>
							
					     </td>
						</tr>
                    </tbody>
                </table>
				
			</fieldset>
			<fieldset><br/>
				<legend>Livraison</legend>
					<label for="expedition">Expedition: </label>
					<select name="expedition" required="required" onchange="change_manga(this.value)">
						<option value="Retrait">Retrait</option>
						<option value="Chronopost">Chronopost</option>
						<option value="TNT Express">TNT Express</option>	
						<option value="Exapaq">Exapaq</option>
					</select><br/><br/>
					<label for="Poids">Poids (kg) : </label><input type="number"  name="poids" value="0" required="required" /> kg.<br/>
					<label for="Volume">Volume (m3) : à </label><input type="number"  name="volume" value="0" required="required" /> m3.<br/>
			</fieldset>
			<center><input type="submit" name="valider" name="valider" /></center>
				
	</form></section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
