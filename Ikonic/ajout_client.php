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
	<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="js/ajout_client.js"></script> 
	<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>

<title>Ikonic: Ajout d'un client</title>
</head>


<body>
<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
<nav id="menu">
	<ul>
		<li><a href="discussion.php">Accueil</a></li>
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
				<li class="current_page_item"><a href="configuration.php">Mon compte</a></li>
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
		<li><a href="deconnexion.php">Vous déconnecter</a></li>
		</center>
	</div>
	
	<h1 style="padding-bottom: 15px; text-align:center;">Ajout d'un client</h1>
	
	<?php 
	if (isset($_GET['success']))
	{
		if ($_GET['success']=="ok")
			echo "<h1 style='text-align:center; color:green;'>Ajout effectué</h1>";
		if ($_GET['success']=="err1")
			echo "<h1 style='text-align:center; color:red;'>ERREUR : Code client existant !</h1>";
	}
	?>
<div id="formu_contact">

	<form method="post" action="process.php" name="form_contact">
		
			<label for="commercial"><u>Commercial :</u> </label><input type="text" name="commercial" required="required" />
			<br/>
			<fieldset>
				<legend>Coordonnées du client</legend>
					<label for="code">Code: </label><input type="text" name="code" required="required" /><br/>
					<label for="forme_juridique">Forme juridique: </label>
					<select name="forme_juridique" onchange="change_manga(this.value)"><option value="sa">S.A</option>
						<option value="sarl">S.A.R.L</option>
						<option value="sci">SCI</option>	
						<option value="collectivite">Collectivité</option>
						<option value="particulier">Particulier</option>
					</select><br/><br/>
					<label for="raison_sociale">Raison sociale: </label><input type="text" name="raison_sociale" required="required" />
			</fieldset>
			<br/>
			<fieldset>
				<legend>Adresse Livraison</legend>
				<!---------------------TEST------------------------------------------------>
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowLivraison('dataTableAdresseLivraison')">Ajouter adresse</button>
				<button class="button-error pure-button" type="button" onClick="deleteRow('dataTableAdresseLivraison')">Supprimer adresse</button>
					<p>(Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées.)</p>
				</p>
				<table id="dataTableAdresseLivraison" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" checked="checked" required="required" name="chk[]" /></td>
						<td>
					
							<label for="BX_adr1">Adresse 1: </label>
							<input type="text" required="required" class="small"  name="BX_adr1[]"/><br/>
							
							<label for="BX_adr2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2[]"/><br/>
					
							<label for="BX_adr3">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3[]"/><br/>

							<label for="BX_cp">Code Postal: </label>
							<input type="text" required="required" class="small"  name="BX_cp[]"/><br/>
						
							<label for="BX_ville">Ville: </label>
							<input type="text" required="required" class="small"  name="BX_ville[]"/><br/><hr>
						</td>
						<td>
							<label for="BX_pays">Pays: </label>
							<input type="text" required="required" class="small"  name="BX_pays[]"/><br/>

							<label for="BX_tel_bur">Tel. Bureau: </label>
							<input type="text" required="required" class="small"  name="BX_tel_bur[]"/><br/>

							<label for="BX_email">Email: </label>
							<input type="text" required="required" class="small"  name="BX_email[]"/><br/>

							<label for="BX_site_web">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web[]"/><br/><br/>
					     </td>
							</p>
                    </tr>
                    </tbody>
                </table>			
			</fieldset>
			<br /><br />
			<fieldset>
				<legend>Adresse Facturation</legend>
				<!---------------------TEST------------------------------------------------>
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowFacturation('dataTableAdresseFacturation')">Ajouter adresse</button>
				<button class="button-error pure-button" type="button" onClick="deleteRow('dataTableAdresseFacturation')">Supprimer adresse</button>
					<p>(Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées.)</p>
				</p>
				<table id="dataTableAdresseFacturation" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" checked="checked" required="required" name="chk2[]" /></td>
						<td>
							<label for="BX_adr1_2">Adresse 1: </label>
							<input type="text" required="required" class="small"  name="BX_adr1_2[]"/><br />

							<label for="BX_adr2_2">Adresse 2: </label>
							<input type="text" class="small"  name="BX_adr2_2[]"/><br />

							<label for="BX_adr3_2">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3_2[]"/><br />

							<label for="BX_cp2">Code Postal: </label>
							<input type="text" required="required" class="small"  name="BX_cp2[]"/><br/>

							<label for="BX_ville2">Ville: </label>
							<input type="text" required="required" class="small"  name="BX_ville2[]"/><br />
							<hr>
						</td>
						<td>
							<label for="BX_pays2">Pays: </label>
							<input type="text" required="required" class="small"  name="BX_pays2[]"/><br />

							<label for="BX_tel_bur2">Tel. Bureau: </label>
							<input type="text" required="required" class="small"  name="BX_tel_bur2[]"/><br />

							<label for="BX_email2">Email: </label>
							<input type="text" required="required" class="small"  name="BX_email2[]"/><br/>

							<label for="BX_site_web2">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web2[]"/><br/>
							
					     </td>
						</tr>
                    </tbody>
                </table>
				
			</fieldset>
			<br/><br/>
			<fieldset>
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
					<label for="jour">le:  </label><input type="number"  name="jour" min="1" max="31" value="1" required="required" />
			</fieldset>
			<br/><br/>			
			<fieldset>
				<legend>Contact</legend>				
				<p> 
				<button class="button-success pure-button" type="button" onClick="addRowContact('dataTableContact')">Ajouter contact</button>
				<button class="button-error pure-button" type="button" onClick="deleteRowContact('dataTableContact')">Supprimer contact</button>
					<p>(Les actions ne s'appliqueront uniquement aux adresses dont les cases sont cochées.)</p>
				</p>
				<table id="dataTableContact" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<br/>
						<td><input type="checkbox" checked="checked" required="required" name="chk3[]" /></td>
						<td>
							<label for="code_contact">Code: </label><input type="text" name="code_contact[]" required="required" /><br/>
							<label for="civilite" required="required" >Civilité: </label>
							<select name="civilite[]" required="required" onchange="change_manga(this.value)">
								<option value="M">M.</option>
								<option value="Mlle">Mlle.</option>
								<option value="MMe">MMe.</option>	
							</select><br/><br/>
							<label for="tel_mob">Téléphone mobile: </label><input type="text" name="tel_mob[]" required="required" /><br/>
							<label for="fax">Fax: </label><input type="text" name="fax[]"  /><br/><hr>

						</td>
						<td>
							<label for="fonction">Fonction: </label><input type="text" name="fonction[]" required="required" /><br/>
							<label for="nom_contact">Nom: </label><input type="text" name="nom_contact[]" required="required" /><br/>
							<label for="tel_bur">Téléphone de bureau: </label><input type="text" name="tel_bur[]" /><br/>
							<label for="email_contact">Email: </label><input type="text" name="email_contact[]" required="required" /><br/>
					     </td>							 
							</p>
                    </tr>
                    </tbody>
                </table>							
			</fieldset>
			<br/><br/>

			<fieldset>
				<legend>Informations complémentaires</legend>
				<br/>
				<textarea name="contenu" rows="17" cols="60"></textarea>
			</fieldset>
			<br/><br/>
			<center><input type="submit" name="valider" /></center>
				
	</form>
</div>
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
