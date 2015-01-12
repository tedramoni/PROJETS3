<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script type="text/javascript" src="Inclusion/ajout_client.js"></script> 
	<title>Ikonic: Ajout d'un client</title>
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
            $("#form_contact2").formToWizard()
        });
    </script>
	
</head>


<body>
	<section>
		<?php include("Inclusion/gestion.php");  include("Inclusion/header.php"); actif(1); ?><br/><br/>
		<h1 style="padding-top: 55px; text-align:center;">Ajout d'un client</h1><br/><br/>	
	
	<?php
	if isset($_GET['err'])
	{
		if ($_GET['err'] == 'err1')
		{
			echo "<br>
						<center><p style='color:red;'>Le code client doit être de la forme : 9, puis une lettre, puis 4 chiffres (ex : 9L0015) !<br>"
		}
		if ($_GET['err'] == 'err2')
		{
			echo "<br>
						<center><p style='color:red;'>Le code client existe déjà !<br>"
		}
	}
	
	
	?>

	
	<div id="formu_contact">
		<form method="post" action="process.php" id="form_contact2">
		<br/>
					<label for="commercial"><u>Commercial :</u> </label><input type="text" id="commercial" name="commercial" required="required"  onkeyup="myFunction()"/>

			<fieldset><br/>
				<legend>Coordonnée du client</legend>
				<label for="code">Code: </label><input type="text" name="code" id="code" maxlength="6" required="required" onkeyup="myFunction()" /><br/>
				<script>
				function myFunction() {
					var x = document.getElementById("commercial");
					var y = document.getElementById("code");
					x.value = x.value.toUpperCase();
					y.value = y.value.toUpperCase();
				}
				</script>
				<label for="forme_juridique">Forme juridique: </label>
				<select name="forme_juridique" onchange="change_manga(this.value)"><option value="sa">S.A</option>
					<option value="sarl">S.A.R.L</option>
					<option value="sci">SCI</option>	
					<option value="collectivite">Collectivité</option>
					<option value="particulier">Particulier</option>
				</select><br/><br/>
				<label for="raison_sociale">Raison sociale: </label><input type="text" name="raison_sociale" required="required" />
			</fieldset>
			<fieldset><br/>
				<legend>Adresse Livraison</legend>
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowLivraison('dataTableAdresseLivraison')">Ajouter adresse</button>
				<button class="button-error pure-button" type="button" onClick="deleteRow('dataTableAdresseLivraison')">Supprimer adresse</button>
					<span data-tip="Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées."><img src="images/info.png" alt="?"/></span>
				</p>
				<table id="dataTableAdresseLivraison" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" name="chk[]" /></td>
						<td>
					
							<label for="BX_adr1">Adresse 1: </label>
							<input type="text" class="small"  name="BX_adr1[]"/><br/>
							
							<label for="BX_adr2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2[]"/><br/>
					
							<label for="BX_adr3">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3[]"/><br/>

							<label for="BX_cp">Code Postal: </label>
							<input type="text" class="small"  name="BX_cp[]"/><br/>
						
							<label for="BX_ville">Ville: </label>
							<input type="text" class="small"  name="BX_ville[]"/><br/><hr>
						</td>
						<td>
							<label for="BX_pays">Pays: </label>
							<input type="text" class="small"  name="BX_pays[]"/><br/>

							<label for="BX_tel_bur">Tel. Bureau: </label>
							<input type="text" class="small"  name="BX_tel_bur[]"/><br/>

							<label for="BX_email">Email: </label>
							<input type="text" class="small"  name="BX_email[]"/><br/>

							<label for="BX_site_web">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web[]"/><br/><br/>
					     </td>
							</p>
                    </tr>
                    </tbody>
                </table>			
			</fieldset>
			<fieldset><br/>
				<legend>Adresse Facturation</legend>
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowFacturation('dataTableAdresseFacturation')">Ajouter adresse</button>
				<button class="button-error pure-button" type="button" onClick="deleteRow('dataTableAdresseFacturation')">Supprimer adresse</button>
					<span data-tip="Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées."><img src="images/info.png" alt="?"/></span>
				</p>
				<table id="dataTableAdresseFacturation" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" name="chk2[]" /></td>
						<td>
							<label for="BX_adr1_2">Adresse 1: </label>
							<input type="text" class="small"  name="BX_adr1_2[]"/><br />

							<label for="BX_adr2_2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2_2[]"/><br />

							<label for="BX_adr3_2">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3_2[]"/><br />

							<label for="BX_cp2">Code Postal: </label>
							<input type="text" class="small"  name="BX_cp2[]"/><br/>

							<label for="BX_ville2">Ville: </label>
							<input type="text" class="small"  name="BX_ville2[]"/><br />
							<hr>
						</td>
						<td>
							<label for="BX_pays2">Pays: </label>
							<input type="text" class="small"  name="BX_pays2[]"/><br />

							<label for="BX_tel_bur2">Tel. Bureau: </label>
							<input type="text" class="small"  name="BX_tel_bur2[]"/><br />

							<label for="BX_email2">Email: </label>
							<input type="text" class="small"  name="BX_email2[]"/><br/>

							<label for="BX_site_web2">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web2[]"/><br/>
							
					     </td>
						</tr>
                    </tbody>
                </table>
				
			</fieldset>
			<fieldset><br/>
				<legend>Paiement</legend>
					<label for="mode_paiement">Mode de règlement: </label>
					<select name="mode_paiement" required="required" onchange="change_manga(this.value)"><option value="cb">Carte bancaire</option>
						<option value="virement">Virement</option>
						<option value="cheque">Chèque</option>	
						<option value="traite">Traite</option>
						<option value="especes">Espèces</option>
					</select><br/><br/>
					<label for="remise">Remise: </label><input type="number"  name="remise" min="0" max="100" value="0" required="required" /> %<br/>
					<label for="echeance">Echeance: à </label><input type="number"  name="echeance" min="0" max="100" value="0" required="required" /> jours.<br/>
					<label for="fdm">F.D.M: </label><input type="checkbox" name="fdm" /><br/>
					<label for="jour">le:  </label><input type="number"  name="jour" min="0" max="31" value="0" required="required" />
			</fieldset>
			<fieldset><br/>
				<legend>Contact</legend>				
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowContact('dataTableContact')">Ajouter contact</button>
				<button class="button-error pure-button" type="button" onClick="deleteRow('dataTableContact')">Supprimer contact</button>
					<span data-tip="Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées."><img src="images/info.png" alt="?"/></span>
				</p>
				<table id="dataTableContact" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" name="chk3[]" /></td>
						<td>
							<label for="code_contact">Code: </label><input type="text" name="code_contact[]" /><br/>
							<label for="civilite" >Civilité: </label>
							<select name="civilite[]" onchange="change_manga(this.value)">
								<option value="M">M.</option>
								<option value="Mlle">Mlle.</option>
								<option value="MMe">MMe.</option>	
							</select><br/><br/>
							<label for="tel_mob">Téléphone mobile: </label><input type="text" name="tel_mob[]" /><br/>
							<label for="fax">Fax: </label><input type="text" name="fax[]"  /><br/><hr>

						</td>
						<td>
							<label for="fonction">Fonction: </label><input type="text" name="fonction[]" /><br/>
							<label for="nom_contact">Nom: </label><input type="text" name="nom_contact[]" /><br/>
							<label for="tel_bur">Téléphone de bureau: </label><input type="text" name="tel_bur[]" /><br/>
							<label for="email_contact">Email: </label><input type="text" name="email_contact[]" /><br/>
					     </td>							 
							</p>
                    </tr>
                    </tbody>
                </table>							
			</fieldset>
			<fieldset><br/>
				<legend>Informations complémentaires</legend>
				<textarea name="contenu" rows="17" cols="60"></textarea>
			</fieldset>
			<center><input type="submit" name="valider" name="valider" /></center>
				
	</form></section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
