	<?php
		include( "Inclusion/gestion.php");
		
		//Fonction qui permet de changer le format de la date de "d/m/Y" en "Y-m-d" utilisé dans la BDD.
		function change_format_date($dateAchanger)
		{
			$array_date=explode('/', $dateAchanger);
			$date_modifie=$array_date[2]."-".$array_date[1]."-".$array_date[0];
			return $date_modifie;
		}
		if(isset($_POST))
		{
			$numero_bl       =$_POST['numero_bl'];
			$date            =change_format_date($_POST['date']);
			$ref_client      =$_POST['ref_client'];
			$ref_fournisseur =$_POST['ref_fournisseur'];
			$code_client     =$_POST['code_client'];
			$nom_commercial  =$_POST['nom_commercial'];
			$raison_social   =$_POST['raison_social'];
			$acompte         =$_POST['acompte'];
			$mode_reglement  =$_POST['mode_reglement'];
			$echeance        =$_POST['echeance'];
			$fdm             =$_POST['fdm'];
			if($fdm=="on")
			{
				$fdm=1;
			}
			else
			{
				$fdm=0;
			}
			$jour            =$_POST['jour'];
			$info_comp       =$_POST['infos'];
			
			$adr1_L          =$_POST['BX_adr1'];
			$adr2_L          =$_POST['BX_adr2'];
			$adr3_L          =$_POST['BX_adr3'];
			$cp_L            =$_POST['BX_cp']; 
			$ville_L         =$_POST['BX_ville'];
			$pays_L          =$_POST['BX_pays'];
			$tel_bureau_L    =$_POST['BX_tel_bur'];
			$email_L         =$_POST['BX_email'];
			$site_web_L      =$_POST['BX_site_web'];
			
			$adr1_F          =$_POST['BX_adr1_2'];
			$adr2_F          =$_POST['BX_adr2_2'];
			$adr3_F          =$_POST['BX_adr3_2'];
			$cp_F            =$_POST['BX_cp2']; 
			$ville_F         =$_POST['BX_ville2'];
			$pays_F          =$_POST['BX_pays2'];
			$tel_bureau_F    =$_POST['BX_tel_bur2'];
			$email_F         =$_POST['BX_email2'];
			$site_web_F      =$_POST['BX_site_web2'];
			
			$type_expedition      =$_POST['expedition'];
			$nbre_colis           =$_POST['colis'];
			
			//ARRAY Pour les articles
			$arrayNomArticle =$_POST['format'];
			$arrayComment    =$_POST['namearticle'];
			$arrayQte        =$_POST['qarticle'];
			$arrayPrix       =$_POST['prix_article'];
			$arrayRemise      =$_POST['rarticle'];
			$arrayPoids       =$_POST['poids_article'];
			$arrayVolume      =$_POST['volume_article']; 
			$arrayArticleTT   =$_POST['prixtt_article'];
			$arrayTotalPoids  =$_POST['totalp_article'];
			$arrayTotalVolume =$_POST['totalv_article'];
			
			$totalPds        = $_POST['totalPoids'];
			$totalVolume     = $_POST['totalVolume'];
			$totalHT         = $_POST['totalHT'];
			$totalTTC        = $_POST['totalTTC'];
			$totalTVA        = $_POST['totalTVA'];

			$liste_articles="";
		}

		//Test
		$nameArticle=array();
		$j=0;
		foreach ($arrayNomArticle as $i) {
			# code...
			$var=explode("|",$i);
			$nameArticle[$j]=$var[4];
			$j++;
		}
		for ($i=0; $i <sizeof($nameArticle) ; $i++) { 
			$liste_articles.=$arrayRemise[$i]."|".$arrayComment[$i]."|".$arrayQte[$i]."|".$arrayPrix[$i]."|".$nameArticle[$i]."|".$arrayPoids[$i]."|".$arrayVolume[$i]."|".$arrayArticleTT[$i]."|".$arrayTotalPoids[$i]."|".$arrayTotalVolume[$i];
			if($i!=sizeof($nameArticle)-1)
				$liste_articles.="**";
		}
		
		
		//TRAITEMENT BASE DE DONNEE
		$connexion=connexionI();
		$sql= "INSERT INTO bon_livraison(date, ref_client, ref_fournisseur, code_client, nom_commercial, mode_reglement, echeance, fdm, jour, info_comp, type_expedition, nbre_colis, acompte, poids_total, volume_total, adr1_L, adr2_L, adr3_L, cp_L, ville_L, pays_L, tel_bureau_L, email_L, site_web_L, adr1_F, adr2_F, adr3_F, cp_F, ville_F, pays_F, tel_bureau_F, email_F, site_web_F, liste_articles, prix_ttc,prix_ht,raison_sociale,tva) VALUES ('".$date."','".$ref_client."', '".$ref_fournisseur."', '".$code_client."', '".$nom_commercial."', '".$mode_reglement."', 
			'".$echeance."', ".$fdm.", ".$jour.", '".$info_comp."', '".$type_expedition."',".$nbre_colis.", ".$acompte.", ".$totalPds.",".$totalVolume.", 
			'".$adr1_L."', '".$adr2_L."', '".$adr3_L."', ".$cp_L.", 
			'".$ville_L."', '".$pays_L."', '".$tel_bureau_L."', 
			'".$email_L."', '".$site_web_L."', 
			'".$adr1_F."', '".$adr2_F."', '".$adr3_F."', ".$cp_F.", '".$ville_F."', '".$pays_F."', '".$tel_bureau_F."', '".$email_F."', '".$site_web_F."', '".$liste_articles."', '".$totalTTC."', '".$totalHT."','".$raison_social."','".$totalTVA."')";
		mysqli_query($connexion,$sql) or die("Erreur: ".mysqli_error($connexion));
		
		header('Location:bl.php');
	?>
	