<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	<title>Ikonic: Ajout d'un article</title>
</head>

<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <!-- inclusion des librairies jQuery et jQuery UI (fichier principal et plugins) -->

<section>
		<?php include("Inclusion/header.php"); actif(2); include("Inclusion/gestion.php");?>

		<h1 style="padding-top: 65px; text-align:center;">Ajout d'un article</h1><br/><br/>
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
			&& !empty($_POST['tva']) && !empty($_POST['nbre_stock']))
			{
				//Si elles ne sont pas vide non plus, alors on sécrurise les données pour pas que l'utilisateur entre du SQL ou du HTML dans la BD
				$reference=htmlentities($_POST['reference']);
				$libelle=htmlentities($_POST['libelle']);
				$famille=$_POST['famille'];
				$prix_vente_ht=htmlentities($_POST['prix_vente_ht']);
				$tva=htmlentities($_POST['tva']);
				$prix_achat=htmlentities($_POST['prix_achat']);
				$nbre_stock=htmlentities($_POST['nbre_stock']);
				$dateE=htmlentities($_POST['dateE']);
				$volume=htmlentities($_POST['volume']);
				$poids=htmlentities($_POST['poids']);
				//Test si la reference existe déja dans la BD
				connexion();
				$sql="SELECT count(ref) from article where ref='{$reference}'";
				$test=mysql_fetch_array(mysql_query($sql)) or die("Erreur au count(ref)".mysql_error());
				if($test[0]==1)
				{
					echo "<center><p style='color:red;'>Cette référence existe déjà dans la base de donnée.</p></center><br/>";
				}
				else
				{
				//On se connecte à la BD
				$connexion=connexionI();
				//On prépare notre requête
				$requete="INSERT INTO article(ref,libelle,famille,prix_ht,tva,prix_achat,nbre_stock,volume,poids) values(?,?,?,?,?,?,?,?,?);";
				$prepa = mysqli_stmt_init($connexion);
				// Préparation de la requête : envoi à la base
				mysqli_stmt_prepare($prepa, $requete);
				mysqli_stmt_bind_param($prepa, 'sssdddidd', $reference,$libelle,$famille,$prix_vente_ht,$tva,$prix_achat,$nbre_stock,$volume,$poids);
				$resultat = mysqli_stmt_execute($prepa);
				// Fermeture de la requête
				mysqli_stmt_close($prepa);
				
				$requete="INSERT INTO stock(ref,date,nbre_entree,nbre_stock) VALUES('{$reference}','{$dateE}',{$nbre_stock},{$nbre_stock})";
				connexion();
				mysql_query($requete) or die(mysql_error());
				echo "<center><p style=\"color:green;\"><img src='images/ok.png' />  L'article a bien été enregistré.</p><br/></center>";
				}
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
					<label for="ttc">Prix de vente TTC: </label><input type="number" name="ttc" id="ttc" min="0" step="any" disabled="disabled" /> €<br/>
					<label for="prix_achat">Prix d'achat: </label><input type="number" name="prix_achat" min="0" step="any" /> €<br/>
					<label for="nbre_stock">Nombre en stock: </label><input type="number" name="nbre_stock" required="required" min="0" step="any" />
					 au <input type="date" name="dateE" required="required"/>
					
					<br/>
					<label for="volume">Volume: </label><input type="number" name="volume" min="0" step="any" /> m<sup>3</sup><br/>
					<label for="poids">Poids: </label><input type="number" name="poids" min="0" step="any"/> kg<br/>
			</fieldset>

			<center><input type="submit" name="valider" /></center>
				
	</form>
</div>
</section>

<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
