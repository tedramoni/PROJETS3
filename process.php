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
				
				/* BLOC MYSQL POUR INSERTION */
				
				$connexion=mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");
				
				$db = "u157965635_ikc";
				mysqli_select_db($connexion, $db);
				
				$req1 = "INSERT INTO client
					values ($code, $forme_juridique, $raison_sociale, $commercial, $mode_paiement, 10, $remise, $contenu)";
				$action = mysqli_query($connexion, $requete);
				
				/* FIN BLOC MYSQL */
				
				
				echo "Nom Commercial : ".$commercial.'<br/>';
				echo "Code Client : ".$code.'<br/>' ;
				echo "Forme Juridique : ".$forme_juridique .'<br/>';
				echo "Raison Sociale : ".$raison_sociale.'<br/><br/>';
				
				for( $i= 0 ; $i < sizeof($BX_code); $i++ )
				{
					echo "Adresse de livraison ".$i."<br/><br/>";
					echo $BX_code[$i].'<br/>';
					echo $BX_adr1[$i].'<br/>';
					echo $BX_adr2[$i].'<br/>';
					echo $BX_adr3[$i]. '<br/>';
					echo $BX_cp[$i]. '<br/>';
					echo $BX_ville[$i]. '<br/>';
					echo $BX_pays[$i]. '<br/>';
					echo $BX_tel_bur[$i]. '<br/>';
					echo $BX_email[$i]. '<br/>';
					echo $BX_site_web[$i]. '<br/>';
					echo $BX_type[$i]. '<br/><br/>';
				}
				
				echo '<br/><br/>';
				
				for( $i= 0 ; $i < sizeof($BX_code2); $i++ )
				{
					echo "Adresse de facturation ".$i."<br/><br/>";
					echo $BX_code2[$i].'<br/>';
					echo $BX_adr1_2[$i].'<br/>';
					echo $BX_adr2_2[$i].'<br/>';
					echo $BX_adr3_2[$i]. '<br/>';
					echo $BX_cp2[$i]. '<br/>';
					echo $BX_ville2[$i]. '<br/>';
					echo $BX_pays2[$i]. '<br/>';
					echo $BX_tel_bur2[$i]. '<br/>';
					echo $BX_email2[$i]. '<br/>';
					echo $BX_site_web2[$i]. '<br/>';
					echo $BX_type2[$i]. '<br/><br/>';
				}
				
				echo '<br/><br/>';	
				
				echo "Mode de paiement : ".$mode_paiement.'<br/>';
				echo "Remise : ".$remise.'<br/>' ;
				echo "Jour : ".$jour.'<br/>';
				echo "Fin de mois : ".$fdm.'<br/>';
				echo "le : ".$jour.'<br/><br/>';

				for( $i= 0 ; $i < sizeof($code_contact); $i++ )
				{
					echo "Contact ".$i."<br/><br/>";
					echo $code_contact[$i].'<br/>';
					echo $civilite[$i].'<br/>';
					echo $nom_contact[$i].'<br/>';
					echo $fonction[$i]. '<br/>';
					echo $tel_bur[$i]. '<br/>';
					echo $tel_mob[$i]. '<br/>';
					echo $BX_pays2[$i]. '<br/>';
					echo $BX_tel_bur2[$i]. '<br/>';
					echo $fax[$i].'<br/><br/>';
				}				
				
				echo '<br/><br/>';	
				
				echo "Infos complémentaires : ".$contenu.'<br/>';	
?>