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
		<style>
			#formu_contact input[type="number"] {
					width:50px;
				}
		</style>

<title>Ikonic: Ajout d'un article</title>
</head>


<body>
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
	
	<h1 style="padding-bottom: 15px; text-align:center;">Ajout d'un article</h1>

		<br/><p><a href="configuration.php">Configuration</a> >> <a href="gestion_stock.php">Gestion de stock</a> >> Ajout d'article</p><br/>

	<?php
//--------------------------------------GESTION DE L'AJOUT D'UN ARTICLE DANS LA BD-----------------------------------------------------------------//
	if(isset($_POST['valider']))
	{
	//Si clique sur le bonton valider
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
				$volume=htmlentities($_POST['volume']);
				$poids=htmlentities($_POST['poids']);
				
				//On se connecte à la BD
				$connexion = mysqli_connect("localhost", "root", "", "membre");
				//On prépare notre requête
				$requete="INSERT INTO article(ref,libelle,famille,prix_ht,tva,prix_achat,nbre_stock,volume,poids) values(?,?,?,?,?,?,?,?,?);";
				$prepa = mysqli_stmt_init($connexion);
				// Préparation de la requête : envoi à la base
				mysqli_stmt_prepare($prepa, $requete);
				mysqli_stmt_bind_param($prepa, 'sssdddidd', $reference,$libelle,$famille,$prix_vente_ht,$tva,$prix_achat,$nbre_stock,$volume,$poids);
				$resultat = mysqli_stmt_execute($prepa);
				// Fermeture de la requête
				mysqli_stmt_close($prepa);
				echo "<center><p style=\"color:green;\"><img src='Images/ok.png' />  L'article a bien été enregistré.</p><br/></center>";
			}
		
		}
	}
?>
<div id="formu_contact">
	<form method="post" action="" name="form_contact">
		
			<label for="reference"><u>Reference :</u> </label><input type="text" id="reference" onkeyup="myFunction()" name="reference" required="required" />
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
			<br/>
			<fieldset>
				<legend>Information de l'article</legend>
					<label for="libelle">Libelle: </label><input type="text" name="libelle" required="required" /><br/>
					<label for="famille">Famille: </label>
					<select name="famille" onchange="change_famille(this.value)"><option value="Caméra analogique">Caméra analogique</option>
						<option value="Caméra IP">Caméra IP</option>
						<option value="DVR">DVR</option>	
						<option value="NVR">NVR</option>
						<option value="Accessoire">Accessoire</option>
						<option value="Speed Dome">Speed Dome</option>
						<option value="DVR HD-CVI">DVR HD-CVI</option>
						<option value="Caméra HD-CVI">Caméra HD-CVI</option>
						<option value="Micro">Micro</option>
						<option value="DVR - PC - CARTE">DVR - PC - CARTE</option>
						<option value="Fibre optique">Fibre optique</option>
						<option value="Caisson support">Caisson support</option>
						<option value="Logiciel">Logiciel</option>
						<option value="Objectif">Objectif</option>
						<option value="Kits Ikonic">Kits Ikonic</option>
					</select><br/><br/>
					<label for="prix_vente_ht">Prix de vente HT: </label><input type="number" onkeyup="calculTTC()" id="prix_vente_ht" onclick="calculTTC()" name="prix_vente_ht" required="required" min="0" step="any" /> €<br/>
					<label for="tva">TVA: </label><input type="number" onkeyup="calculTTC()" onclick="calculTTC()" id="tva" name="tva" required="required" min="0" step="any" /> %<br/>
					<label for="ttc">Prix de vente TTC: </label><input type="number" name="ttc" id="ttc" required="required" min="0" step="any" disabled="disabled" /> €<br/>
					<label for="prix_achat">Prix d'achat: </label><input type="number" name="prix_achat" required="required" min="0" step="any" /> €<br/>
					<label for="nbre_stock">Nombre en stock: </label><input type="number" name="nbre_stock" required="required" min="0" step="any" /><br/>
					<label for="volume">Volume: </label><input type="number" name="volume" required="required" min="0" step="any" /> m<sup>3</sup><br/>
					<label for="poids">Poids: </label><input type="number" name="poids" required="required" min="0" step="any"/> kg<br/>
			</fieldset>

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
