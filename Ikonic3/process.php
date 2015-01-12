<?php if(isset($_POST)==true && empty($_POST)==false)
{
				//Connexion à la base de données
				include("Inclusion/gestion.php");
				connexion();
				// Test - Code existant ?
				$code = $_POST['code'];
				
				$test1 = "Select code from client ";
				$test1 .= "where code ='$code'";
				$actiontest1 = mysql_query($test1) or die(mysql_error());
				$resultattest1 = mysql_fetch_row($actiontest1);
				if ($resultattest1[0] == $code)
				{
					header('location: ajout_client.php?success=err1');
				}
				else
				{
								
					$commercial = $_POST['commercial']; 
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
					
					// Paiements
					$mode_paiement = $_POST['mode_paiement'];
					$remise = $_POST['remise'];
					$echeance = $_POST['echeance'];
					$fdm = $_POST['fdm'];
					$bool_fdm = 0;
					if ($fdm == 'on')
					{
						$bool_fdm = 1;
					}
					$jour = $_POST['jour'];
					
					// Contacts
					$code_contact = $_POST['code_contact'];
					$civilite = $_POST['civilite'];
					$nom_contact = $_POST['nom_contact'];
					$fonction = $_POST['fonction'];
					$tel_bur = $_POST['tel_bur'];
					$tel_mob = $_POST['tel_mob'];
					$fax = $_POST['fax'];
					$email_contact = $_POST['email_contact'];
					
					// Commentaires
					$contenu = $_POST['contenu'];	
					
					/* BLOC MYSQL POUR INSERTION */
					
						// Insertion client (table client)
						
					$req1 = "INSERT INTO client";
					$req1 .=" values ('$code', '$forme_juridique', '$raison_sociale', '$commercial', '$mode_paiement', $echeance, $bool_fdm, $jour, $remise, '$contenu')";
					$action1 = mysql_query($req1) or die(mysql_error());
					echo $BX_adr1;
					
					
					//Insertion adresses de livraison (table adresse)
					for($i=0;$i<sizeof($BX_adr1);$i++)
					{
						$req2 = "INSERT INTO adresse (code_client, adr1, adr2, adr3, cp, ville, pays, tel_bur, email, site_web, type)";
						$req2.= " values ('$code', '$BX_adr1[$i]', '$BX_adr2[$i]', '$BX_adr3[$i]', '$BX_cp[$i]', '$BX_ville[$i]', '$BX_pays[$i]',
										'$BX_tel_bur[$i]', '$BX_email[$i]', '$BX_site_web[$i]', 'L')";
						echo $req2;
						$action2 = mysql_query($req2) or die(mysql_error());
					}
					
				
					//Insertion adresses de facturation (table adresse)
					for($i=0;$i<sizeof($BX_adr1_2);$i++)
					{
						$req3 = "INSERT INTO adresse (code_client, adr1, adr2, adr3, cp, ville, pays, tel_bur, email, site_web, type)";
						$req3.= " values ('$code', '$BX_adr1_2[$i]', '$BX_adr2_2[$i]', '$BX_adr3_2[$i]', '$BX_cp2[$i]', '$BX_ville2[$i]', '$BX_pays2[$i]',
										'$BX_tel_bur2[$i]', '$BX_email2[$i]', '$BX_site_web2[$i]', 'F')";
						echo $req3;
						$action3 = mysql_query($req3) or die(mysql_error());
					}
					
					//Insertion contacts (table contact)
					for($i=0;$i<sizeof($code_contact);$i++)
					{
						$req4 = "INSERT INTO contact ";
						$req4.= " values('$code_contact[$i]', '$nom_contact[$i]', '$civilite[$i]', '$fonction[$i]', '$tel_bur[$i]', '$tel_mob[$i]',
									'$fax[$i]', '$email_contact[$i]', '$code')";
						echo $req4;
						$action4 = mysql_query($req4) or die(mysql_error());
					}
				
					header('location: client.php');
					
				}// Fin else test code client existant
				
				
			
}
else
{
	header('location: ajout_client.php');
}			
?>