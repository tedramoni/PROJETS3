<?php
session_start();
include("../Inclusion/gestion.php");
if(isset($_SESSION['pseudo']))
{
		connexion();
		$user=$_SESSION['pseudo'];
		$sql='SELECT email FROM membre WHERE pseudo="'.$user.'"';
		$email_user=mysql_query("$sql") or die('Erreur au niveau du mail'.mysql_error());
		$data=mysql_fetch_array($email_user);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="../style/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="../style/TableCSSCode.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur" href="../style/couleur1.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur2" href="../style/couleur2.css" />
	<link rel="alternate stylesheet" media="screen" type="text/css" title="couleur3" href="../style/couleur3.css" />
	<script type="text/javascript" src="../Inclusion/styleswitcher.js"></script>
	<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
	<link rel="icon" type="image/ico" href="../Images/favicon.ico" />
	<meta charset="utf-8"/>
	<title>Ikonic: Contact</title>
</head>


<body>

<?php include("../Inclusion/header.php");?>
<nav id="menu">
	<ul>
		<li><a href="../discussion.php">Accueil</a></li>
		<li><a href="../info.php">Info'</a></li>
		<li><a href="../lien.php">Liens</a></li>
		<!-- C DUR -------------------------------!-->
		<?php
			if(!isset($_SESSION['pseudo']))
			{
		?>
				<li><a href="../index.php">Se Connecter</a></li>
		<?php
			}
			else
			{
		?>
				<li class="current_page_item"><a href="../configuration.php">Mon compte</a></li>
			<?php }?>
		
		<li><a href="../contact.php">Contact</a></li>
	</ul>
</nav>


<section>
<?php
if(isset($_SESSION['pseudo']))
{
?>
	<div id="menu_c">
		<center>
		<li><?php echo $_SESSION['pseudo'];?></li>
		<li>Administrateur</li>
		<li><?php echo $_SERVER["REMOTE_ADDR"]; ?></li>
		<li><a href="../deconnexion.php">Vous déconnectez</a></li>
		</center>
	</div><br /> <br />
<?php if(isset($_POST)==true && empty($_POST)==false)
{
				//Connexion à la base de données
				
				$connexion=mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");				
				$db = "u157965635_ikc";
				mysqli_select_db($connexion, $db);
				
				// Test - Code existant ?
				
				$code = $_POST['code'];
					
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
					$index = $_POST['index'];
					
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
					$index2 = $_POST['index2'];
					
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
					$req1 = "UPDATE client ";
					$req1 .= "SET ";
					$req1 .= "forme_juridique = '".$forme_juridique."', ";
					$req1 .= "raison_sociale = '".$raison_sociale."', ";
					$req1 .= "nom_commercial = '".$commercial."', ";
					$req1 .= "mode_reglement = '".$mode_paiement."', ";
					$req1 .= "echeance = '".$echeance."', ";
					$req1 .= "fdm = '".$bool_fdm."', ";
					$req1 .= "jour = '".$jour."', ";
					$req1 .= "remise = '".$remise."', ";
					$req1 .= "info_comp = '".$contenu."' ";
					$req1 .= "WHERE code = '".$code."';";
					$action1 = mysqli_query($connexion, $req1) or die(mysqli_error($connexion));
					
						//Insertion adresses de livraison (table adresse)
					for($i=0;$i<sizeof($BX_adr1);$i++)
					{				
						$req2 = "UPDATE adresse ";
						$req2 .= "SET ";
						$req2 .= "adr1 ='".$BX_adr1[$i]."',";
						$req2 .= "adr2 ='".$BX_adr2[$i]."',";
						$req2 .= "adr3 ='".$BX_adr3[$i]."',";
						$req2 .= "cp ='".$BX_cp[$i]."',";
						$req2 .= "ville ='".$BX_ville[$i]."',";
						$req2 .= "pays ='".$BX_pays[$i]."',";
						$req2 .= "tel_bur ='".$BX_tel_bur[$i]."',";
						$req2 .= "email ='".$BX_email[$i]."',";
						$req2 .= "site_web ='".$BX_site_web[$i]."' ";
						$req2 .= "WHERE `index` = ".$index[$i].";";
						$action2 = mysqli_query($connexion, $req2) or die(mysqli_error($connexion));						
					}
					
						//Insertion adresses de facturation (table adresse)
					for($i=0;$i<sizeof($BX_adr1_2);$i++)
					{
						$req3 = "UPDATE adresse ";
						$req3 .= "SET ";
						$req3 .= "adr1 ='".$BX_adr1_2[$i]."',";
						$req3 .= "adr2 ='".$BX_adr2_2[$i]."',";
						$req3 .= "adr3 ='".$BX_adr3_2[$i]."',";
						$req3 .= "cp ='".$BX_cp2[$i]."',";
						$req3 .= "ville ='".$BX_ville2[$i]."',";
						$req3 .= "pays ='".$BX_pays2[$i]."',";
						$req3 .= "tel_bur ='".$BX_tel_bur[$i]."',";
						$req3 .= "email ='".$BX_email2[$i]."',";
						$req3 .= "site_web ='".$BX_site_web2[$i]."' ";
						$req3 .= "WHERE `index` =".$index2[$i].";";
						$action3 = mysqli_query($connexion, $req3) or die(mysqli_error($connexion));		
					}
					
						//Insertion contacts (table contact)
					for($i=0;$i<sizeof($code_contact);$i++)
					{					
						$req4 = "UPDATE contact ";
						$req4 .= "SET ";
						$req4 .= "nom ='".$nom_contact[$i]."',";
						$req4 .= "civilite ='".$civilite[$i]."',";
						$req4 .= "fonction ='".$fonction[$i]."',";
						$req4 .= "tel_bur ='".$tel_bur[$i]."',";
						$req4 .= "tel_mob ='".$tel_mob[$i]."',";
						$req4 .= "email ='".$email_contact[$i]."',";
						$req4 .= "fax ='".$fax[$i]."' ";
						$req4 .= "WHERE code ='".$code_contact[$i]."';";
						$action4 = mysqli_query($connexion, $req4) or die(mysqli_error($connexion));		
					}								
				/* FIN BLOC MYSQL */
				if ($action1 && $action2 && $action3 && $action4)
				{
					header("Location: modifier_client.php?envoie=ok&cc=".$code);
					exit();
				}	
				else 
				{ 
					header("Location: update.php?state=error");
					exit();				
				}
}		
else
{
	 if(isset($_GET['state']))
	 {
		echo '<h1 style="padding-bottom: 40px; text-align:center;"> Erreur lors de la modification du client ! </h1>';
		echo 'Retourner à la page de <a href="http://iuted.bugs3.com/projet/Ikonic2/search/index2.php">modification</a> ou <a href="http://iuted.bugs3.com/projet/Ikonic2/search/index.php">consultation</a>'; 		
	 }
}
}
?>
</section>
<?php include("../Inclusion/bottom.php"); ?>
</body>
</html>
