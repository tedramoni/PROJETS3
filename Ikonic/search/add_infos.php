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
		$connexion=mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");				
		$db = "u157965635_ikc";
		mysqli_select_db($connexion, $db);
		$code_client=$_GET['id'];
		
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
		if(isset($_POST['contact']))
		{
			// Contacts
			$code_contact = $_POST['code_contact'];
			$civilite = $_POST['civilite'];
			$nom_contact = $_POST['nom_contact'];
			$fonction = $_POST['fonction'];
			$tel_bur = $_POST['tel_bur'];
			$tel_mob = $_POST['tel_mob'];
			$fax = $_POST['fax'];
			$email_contact = $_POST['email_contact'];
			
			$req4 = "INSERT INTO contact ";
			$req4.= " values('$code_contact', '$nom_contact', '$civilite', '$fonction', '$tel_bur', '$tel_mob',
					'$fax', '$email_contact', '$code_client')";								
			$action4 = mysqli_query($connexion, $req4) or die("erreur dans l'ajout");
			
			echo 'Ajout du contact réussi, vous pouvez maintenant fermer la page';
		}
		?>
		
		<?php if(isset($_POST['livraison']))
		{
			// Adresse Livraison
			$BX_code = $_POST['BX_code'];
			$BX_adr1 = $_POST['BX_adr1'];
			$BX_adr2 = $_POST['BX_adr2'];
			$BX_adr3 = $_POST['BX_adr3'];
			$BX_cp = $_POST['BX_cp'];
			$BX_ville = $_POST['BX_ville'];
			$BX_pays = $_POST['BX_pays'];
			$BX_tel_bur = $_POST['BX_tel_bur'];
			$BX_email = $_POST['BX_email'];
			$BX_site_web = $_POST['BX_site_web'];
			$BX_type = $_POST['BX_type'];
			
			$req2 = "INSERT INTO adresse (code_client, adr1, adr2, adr3, cp, ville, pays, tel_bur, email, site_web, type)";
			$req2.= " values ('$code_client', '$BX_adr1', '$BX_adr2', '$BX_adr3', '$BX_cp', '$BX_ville', '$BX_pays',
					'$BX_tel_bur', '$BX_email', '$BX_site_web', 'L')";						
			$action2 = mysqli_query($connexion, $req2);
			
			echo 'Ajout de l\'adresse de livraison réussi, vous pouvez maintenant fermer la page';
						
		}
		?>		
		
		<?php if(isset($_POST['facturation']))
		{
			//Adresse Facturation
			$BX_code2 = $_POST['BX_code2'];
			$BX_adr1_2 = $_POST['BX_adr1_2'];
			$BX_adr2_2 = $_POST['BX_adr2_2'];
			$BX_adr3_2 = $_POST['BX_adr3_2'];
			$BX_cp2 = $_POST['BX_cp2'];
			$BX_ville2 = $_POST['BX_ville2'];
			$BX_pays2 = $_POST['BX_pays2'];
			$BX_tel_bur2 = $_POST['BX_tel_bur2'];
			$BX_email2 = $_POST['BX_email2'];
			$BX_site_web2 = $_POST['BX_site_web2'];
			$BX_type2 = $_POST['BX_type2'];
			
			$req3 = "INSERT INTO adresse (code_client, adr1, adr2, adr3, cp, ville, pays, tel_bur, email, site_web, type)";
			$req3.= " values ('$code_client', '$BX_adr1_2', '$BX_adr2_2', '$BX_adr3_2', '$BX_cp2', '$BX_ville2', '$BX_pays2',
					'$BX_tel_bur2', '$BX_email2', '$BX_site_web2', 'F')";						
			$action3 = mysqli_query($connexion, $req3);
			
			echo '<br /> <strong>Ajout de l\'adresse de facturation réussi, vous pouvez maintenant fermer la page </strong>';
		}
	}
		?>