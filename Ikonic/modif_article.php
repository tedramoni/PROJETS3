<?php
session_start();
$form=true;
if(!$_SESSION['pseudo'])
{
	header('Location:index.php');
}
if(isset($_GET['ref'])) {
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
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />

	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="Images/favicon.ico" />
	<meta charset="utf-8" />
	<style>
		#formu_contact input[type="number"] {
				width:50px;
			}
	</style>
			<script>
			function test()
			{
				document.getElementById("contentArea").innerHTML ="<label>Nombre en stock: </label> <input type='number' name='nbre_stock' required='required'  min='0' step='any' />";
				document.getElementById("contentArea").innerHTML+=" au <input type='date' name='date' value='01/01/2015'/>";
			}
		</script>

<title>Ikonic: Modification d'un article</title>
</head>


<body>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <!-- inclusion des librairies jQuery et jQuery UI (fichier principal et plugins) -->

	<?php include("Inclusion/header.php"); include("Inclusion/gestion.php");?>
	<nav id="menu">
		<ul>
			<li><a href="discussion.php">Accueil</a></li>
			<li><a href="info.php">Info'</a></li>
			<li><a href="lien.php">Liens</a></li>
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

		<div id="menu_c">
		<center>
		<li><?php echo $_SESSION['pseudo'];?></li>
		<li>Administrateur</li>
		<li><?php echo $_SERVER["REMOTE_ADDR"]; ?></li>
		<li><a href="deconnexion.php">Vous déconnecter</a></li>
		</center>
	</div>
	
	<h1 style="padding-bottom: 15px; text-align:center;">Modifier un article</h1>

		<br/><p><a href="configuration.php">Configuration</a> >> <a href="gestion_stock.php">Gestion de stock</a> >> Modification d'article</p><br/>
	<?php	
	//--------------------------------------GESTION DE LA MODIFICATION D'UN ARTICLE DANS LA BD-----------------------------------------------------------------//
	if(isset($_POST['Envoyer']))
	{
	//Si clique sur le bonton envoyer
	if(isset($_POST['reference']) && isset($_POST['libelle']) && isset($_POST['famille']) && isset($_POST['prix_vente_ht'])
		&& isset($_POST['tva']) && isset($_POST['prix_achat']) && isset($_POST['nbre_stock']) && isset($_POST['volume']) && isset($_POST['poids']))
		{
			//Si toutes les variables existent, on vérifie qu'elles ne sont pas vide
			if(!empty($_POST['reference']) && !empty($_POST['libelle']) && !empty($_POST['famille']) && !empty($_POST['prix_vente_ht'])
			&& !empty($_POST['tva']) && !empty($_POST['prix_achat']) && !empty($_POST['nbre_stock']) && !empty($_POST['volume']) && !empty($_POST['poids']))
			{
				//Si elles ne sont pas vide non plus, alors on sécrurise les données pour pas que l'utilisateur entre du SQL ou du HTML dans la BD
				$reference=htmlentities($_POST['reference']);
				$libelle=htmlentities($_POST['libelle']);
				$famille=utf8_encode(htmlentities($_POST['famille']));
				$prix_vente_ht=htmlentities($_POST['prix_vente_ht']);
				$tva=htmlentities($_POST['tva']);
				$prix_achat=htmlentities($_POST['prix_achat']);
				$nbre_stock=htmlentities($_POST['nbre_stock']);
				$dateE=htmlentities($_POST['date']);
				$volume=htmlentities($_POST['volume']);
				$poids=htmlentities($_POST['poids']);
				
				//On se connecte à la BD
				$connexion = mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");
				//On prépare notre requête
				$requete="UPDATE article SET libelle=?,famille=?,prix_ht=?,tva=?,prix_achat=?,nbre_stock=?,volume=?,poids=? WHERE ref=?;";
				$prepa = mysqli_stmt_init($connexion);
				// Préparation de la requête : envoi à la base
				mysqli_stmt_prepare($prepa, $requete);
				mysqli_stmt_bind_param($prepa,'ssdddidds',$libelle,$famille,$prix_vente_ht,$tva,$prix_achat,$nbre_stock,$volume,$poids,$reference);
				$resultat = mysqli_stmt_execute($prepa) or die("errrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrreyr");
				// Fermeture de la requête
				mysqli_stmt_close($prepa);
				echo "<center><p style=\"color:green;\"><img src='Images/ok.png' />  L'article a bien été modifié.</p><br/></center>";
			
			if(isset($_POST['nbre_stock']) && isset($_POST['date']))
			{
				if(!empty($_POST['nbre_stock']) && !empty($_POST['date']))
				{
					
					$requete="INSERT INTO STOCK(ref,date,nbre_entree) VALUES('{$reference}','{$dateE}',{$nbre_stock})";
					connexion();
					mysql_query($requete) or die(mysql_error());
				}
			}
		
		}
	}
	}
?>
		<?php
			if(isset($_GET['supp']))
			{
				connexion();
				$sql="DELETE FROM article WHERE ref='{$_GET['supp']}';";
				echo $sql;
				mysql_query($sql);
				echo "<script>alert('L\'article {$_GET['supp']} a bien été supprimé.'); window.location.href='modif_article.php';</script>";
				
			}
		
		?>
	<?php
		if($form)
		{
	?>
		<?php
			//Recupération des valeurs de référence dans un array
			$liste=array();
			connexion();
			$sql="SELECT*FROM article";
			$requete=mysql_query($sql);
			while($result=mysql_fetch_array($requete))
			{
				$liste[]=$result['ref'];
				
			}
			//print_r($liste);
		
		?>
		<br/>
	<form name="form_contact" method="POST" action="">
		
			 <center>Veuillez entrer la référence de l'article : <input type="text" id="recherche" name="recherche" onkeyup="myFunction()" /><br/><br/>
			<div id="formu_contact"><input type="submit" name="valider" /></center></div>
				<script>
	function myFunction() {
		var x = document.getElementById("recherche");
		x.value = x.value.toUpperCase();
	}
	</script>			
				
	</form>
		<script>
		//AUTO-COMPLETION
		$('#recherche').autocomplete();
		var liste = <?php echo json_encode($liste) ?>;
			
		$('#recherche').autocomplete({
			source : liste
		});
		</script>

	<?php
	}
	else
		{
			if(isset($_GET['ref']))
			{
				if(isset($_GET['ref']) && !empty($_GET['ref']))
				{
					connexion();
					$reference=$_GET['ref'];
					$sql="SELECT COUNT(id) FROM article WHERE ref='".$reference."'";
					$result=mysql_query($sql);
					$data=mysql_fetch_array($result);
					if($data[0]==0)
					{
						echo "<script language='JAVASCRIPT'>alert('La référence $reference n\'existe pas dans notre BDD.');";
						echo "document.location.href = 'modif_article.php';</script>";
						exit(0);
					
					}
					$sql='SELECT * FROM article WHERE ref="'.$reference.'"';
					$execute=mysql_query("$sql") or die('Erreur au niveau de la requete SQL'.mysql_error());
					$data=mysql_fetch_array($execute);
					echo "<br/><center><a href='gestion_stock.php' style='border-bottom:1px dotted black;'>Revenir à la page précédente.</a><br/><br/>";
	?>
	<script>
		function verif()
		{
			var a=confirm('Etes vous sûr de supprimer cette article?'); 
			if(a==true){
				window.location.href ="modif_article.php?supp=<?php echo $reference; ?>";
			}
			else
			{
				alert('Votre demande n\'a pas été traitée.');
			}
		}
	</script>
	<a href="#" style="border-bottom:1px dotted red;color:red;" onclick="verif();"> Voulez-vous supprimer cet article?</a></center><br/>

		<div id="formu_contact">
	<form method="post" action="" name="form_contact">
		
			<label for="reference" ><u>Reference :</u> </label><input type="text" id="reference" onkeyup="myFunction()" name="reference" value="<?php echo $data['ref']; ?>" required="required" />
			<br/>
		<script>
		function myFunction() {
			var x = document.getElementById("reference");
			x.value = x.value.toUpperCase();
		}
				function calculTTC()
				{
					var ht=document.getElementById("prix_vente_ht").value;
					var tva=document.getElementById("tva").value;
					tva=tva/100;
					var ttc=parseFloat(ht);
					var ttc=parseFloat(ttc+(ht*tva));
					document.getElementById("ttc").value=ttc;
				}
			</script>
		</script>
			<fieldset>
				<legend>Information sur l'article</legend>
					<label for="libelle">Libelle: </label><input type="text" name="libelle" value="<?php echo $data['libelle']; ?>" required="required" /><br/>
					<label for="famille">Famille: </label>
					<select name="famille" onchange="change_famille(this.value)">
						<option value="<?php echo $data['famille']; ?>"><?php echo $data['famille']; ?></option>
						<?php
							$tab_famille=array('Caméra analogique','Caméra IP','DVR','NVR','Accessoire','Speed Dome','DVR HD-CVI','Caméra HD-CVI','Micro','DVR - PC - CARTE','Fibre optique','Caisson support','Logiciel','Objectif','Kits Ikonic');
							
							foreach($tab_famille as $famille)
							{
								if(str_replace("é", "&eacute;", $famille)!=$data['famille'])
								{
									echo "<option value=\"{$famille}\">{$famille}</option>";
								}
						
							}
						?>
						
					</select><br/><br/>
					<label for="prix_vente_ht">Prix de vente HT: </label><input type="number"  onkeyup="calculTTC()" id="prix_vente_ht" onclick="calculTTC()" name="prix_vente_ht" value="<?php echo $data['prix_ht']; ?>" required="required"  min="0" step="any" /> €<br/>
					<label for="tva">TVA: </label><input type="number" name="tva"  onkeyup="calculTTC()" id="tva" onclick="calculTTC()" value="<?php echo $data['tva']; ?>" required="required"  min="0" step="any" /> %<br/>
					<label for="ttc">Prix de vente TTC: </label><input type="number" value="<?php echo ($data['prix_ht']*$data['tva']/100)+$data['prix_ht']; ?>" name="ttc" id="ttc"disabled="disabled" required="required"  min="0" step="any" /> €<br/>
					<label for="prix_achat">Prix d'achat: </label><input type="number" name="prix_achat" value="<?php echo $data['prix_achat']; ?>" required="required"  min="0" step="any" /> €<br/>
					<label for="nbre_stock">Stock: </label><button type="button" onclick="test()">Entrez stock </button><br/><br/>
					<div id="contentArea"> </div>
					<label for="volume">Volume: </label><input type="number" name="volume" value="<?php echo $data['volume']; ?>" required="required"  min="0" step="any" /> m<sup>3</sup><br/>
					<label for="poids">Poids: </label><input type="number" name="poids" value="<?php echo $data['poids']; ?>" required="required"  min="0" step="any" /> kg<br/>
			</fieldset>

			<center><input type="submit" name="Envoyer" /></center>
				
	</form>
</div>

	<?php
					
				}
			}
		}
	?>

</section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
