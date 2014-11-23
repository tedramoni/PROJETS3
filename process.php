<?php if(isset($_POST)==true && empty($_POST)==false) 	
				
				$commercial = $_POST['commercial']; 
				$code = $_POST['code'];
				$forme_juridique = $_POST['forme_juridique'];
				$raison_sociale = $_POST['raison_sociale'];
				$chk = $_POST['chk'];
				
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
				
				// Adresse Facturation
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
				
				$mode_paiement = $_POST['mode_paiement'];
				$remise = $_POST['remise'];
				$jour = $_POST['jour'];
				$fdm = $_POST['fdm'];
				$jour = $_POST['jour'];
				$code_contact = $_POST['code_contact'];
				$civilite = $_POST['civilite'];
				$nom_contact = $_POST['nom_contact'];
				$fonction = $_POST['fonction'];
				$tel_bur = $_POST['tel_bur'];
				$tel_mob = $_POST['tel_mob'];
				$fax = $_POST['fax'];
				$contenu = $_POST['contenu'];	

				echo $commercial.'<br/>';
				echo $code.'<br/>' ;
				echo $forme_juridique .'<br/>';
				echo $raison_sociale.'<br/><br/>';
				
				print_r($BX_code);echo '<br/>';
				print_r($BX_adr1);echo '<br/>';
				print_r($BX_adr2);echo '<br/>';
				print_r($BX_adr3);echo '<br/>';
				print_r($BX_cp);echo '<br/>';
				print_r($BX_ville);echo '<br/>';
				print_r($BX_pays);echo '<br/>';
				print_r($BX_tel_bur);echo '<br/>';
				print_r($BX_email);echo '<br/>';
				print_r($BX_site_web);echo '<br/>';
				print_r($BX_type);echo '<br/>';
				
				print_r($BX_code2);echo '<br/>';
				print_r($BX_adr1_2);echo '<br/>';
				print_r($BX_adr2_2);echo '<br/>';
				print_r($BX_adr3_2);echo '<br/>';
				print_r($BX_cp2);echo '<br/>';
				print_r($BX_ville2);echo '<br/>';
				print_r($BX_pays2);echo '<br/>';
				print_r($BX_tel_bur2);echo '<br/>';
				print_r($BX_email2);echo '<br/>';
				print_r($BX_site_web2);echo '<br/>';
				print_r($BX_type2);echo '<br/>';
				
				echo $mode_paiement.'<br/>';
				echo $remise.'<br/>' ;
				echo $jour.'<br/>';
				echo $fdm.'<br/>';
				echo $jour.'<br/>';
				echo $code_contact.'<br/>';
				echo $civilite.'<br/>';
				echo $nom_contact.'<br/>';
				echo $fonction.'<br/>';
				echo $tel_bur.'<br/>';
				echo $tel_mob.'<br/>';
				echo $fax.'<br/>';
				echo $contenu.'<br/>';	
?>