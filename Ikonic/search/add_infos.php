<?php
	session_start();
	if(!isset($_SESSION['pseudo']))
	{
	?>
		<li><a href="../index.php">Se Connecter</a></li>	
	<?php 
	} 
	else
	{
		if (isset($_GET["type"]) && isset($_GET["id"]) && $_GET["type"]=="livraison" )
		{ ?>
			<fieldset>
				<?php echo'<legend><strong>ADRESSE LIVRAISON </strong></legend>'; ?>
					<form method="post" action="" name="form_adr_l">
							<br />
							<input type="hidden" name="code_client" value="<?php echo $_GET['id']; ?>">
							
							<label for="BX_adr1">Adresse 1: </label>
							<input type="text" required="required" class="small"  name="BX_adr1"/><br/>
							
							<label for="BX_adr2">Adresse 2: </label>				
							<input type="text" class="small"  name="BX_adr2" /><br/>
							
							<label for="BX_adr3">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3" /><br/>

							<label for="BX_cp">Code Postal: </label>
							<input type="text" required="required" class="small"  name="BX_cp" /><br/>
								
							<label for="BX_ville">Ville: </label>
							<input type="text" required="required" class="small"  name="BX_ville"/><br/>

							<label for="BX_pays">Pays: </label>
							<input type="text" required="required" class="small"  name="BX_pays"/><br/>

							<label for="BX_tel_bur">Tel. Bureau: </label>
							<input type="text" required="required" class="small"  name="BX_tel_bur"/><br/>

							<label for="BX_email">Email: </label>
							<input type="text" required="required" class="small"  name="BX_email"/><br/>

							<label for="BX_site_web">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web" /><br/><br/>							
							<br />
							<center><input type="submit"  name="livraison" value="Ajouter" /></center>				
					</form>
			</fieldset>
		<?php 
		} 
		if (isset($_GET["type"]) && isset($_GET["id"]) && $_GET["type"]=="facturation" )
		{ ?>
			<fieldset>
				<?php echo'<legend><strong>ADRESSE FACTURATION </strong></legend>'; ?>
					<form method="post" action="" name="form_adr_f">
							<br />
							<input type="hidden" name="code_client" value="<?php echo $_GET['id']; ?>">
							
							<label for="BX_adr1_2">Adresse 1: </label>
							<input type="text" required="required" class="small"  name="BX_adr1_2"/><br/>
							
							<label for="BX_adr2_2">Adresse 2: </label>				
							<input type="text" class="small"  name="BX_adr2_2" /><br/>
							
							<label for="BX_adr3_2">Adresse 3: </label>
							<input type="text" class="small"  name="BX_adr3_2" /><br/>

							<label for="BX_cp2">Code Postal: </label>
							<input type="text" required="required" class="small"  name="BX_cp2" /><br/>
								
							<label for="BX_ville2">Ville: </label>
							<input type="text" required="required" class="small"  name="BX_ville2"/><br/>

							<label for="BX_pays2">Pays: </label>
							<input type="text" required="required" class="small"  name="BX_pays2"/><br/>

							<label for="BX_tel_bur2">Tel. Bureau: </label>
							<input type="text" required="required" class="small"  name="BX_tel_bur2"/><br/>

							<label for="BX_email2">Email: </label>
							<input type="text" required="required" class="small"  name="BX_email2"/><br/>

							<label for="BX_site_web2">Site Web: </label>
							<input type="text" class="small"  name="BX_site_web2" /><br/><br/>							
							<br />
							<center><input type="submit"  name="facturation" value="Ajouter" /></center>				
					</form>
			</fieldset>
		<?php 
		} 
		if (isset($_GET["type"]) && isset($_GET["id"]) && $_GET["type"]=="contact" )
		{ ?>
			<fieldset>
					<legend><strong>CONTACT</strong></legend>
					<form method="post" action="" name="form_contact">
						<br />
						<label for="code_contact">Code: </label><input type="text" name="code_contact" required="required" /><br/>
						<label for="nom_contact">Nom: </label><input type="text" name="nom_contact" required="required" /><br/>
						<label for="civilite" required="required" >Civilité: </label>
							<select name="civilite" required="required" onchange="change_manga(this.value)">
								<option value="M">M.</option>
								<option value="Mlle">Mlle.</option>
								<option value="MMe">MMe.</option>	
						</select><br/><br/>
						<label for="fonction">Fonction: </label><input type="text" name="fonction" required="required" /><br/>
						<label for="tel_mob">Téléphone mobile: </label><input type="text" name="tel_mob" required="required" /><br/>
						<label for="tel_bur">Téléphone de bureau: </label><input type="text" name="tel_bur" /><br/>
						<label for="fax">Fax: </label><input type="text" name="fax" /><br/>
						<label for="email_contact">Email: </label><input type="text" name="email_contact" required="required" /><br/>
						<br />
						<center><input type="submit" name="contact" value="Ajouter" /></center>				
					</form>
			</fieldset>
		<?php 
		}
	}