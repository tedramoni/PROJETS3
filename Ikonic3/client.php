<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	<title>Ikonic: Interface client</title>
</head>


<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    <!-- inclusion des librairies jQuery et jQuery UI (fichier principal et plugins) -->
	<section>
		<?php include("Inclusion/gestion.php");  include("Inclusion/header.php"); actif(1); ?><br/><br/>
		<h1 style="padding-top: 55px; text-align:center;">Gestion des clients</h1>
	
	<?php
		//Recupération des valeurs de référence dans un array
		$liste=array();
		$liste2=array();
		$liste3=array();
		connexion();
		$sql = 'Select * from client';
		$requete=mysql_query($sql);
		while($result=mysql_fetch_array($requete))
		{
			$liste[]=$result['code'];
			$liste2[]=$result['nom_commercial'];
			$liste3[]=$result['raison_sociale'];
		}		
	?>
	<br/><br/>
	<center>
		<form method="post" action="">
		<input type="text" id="recherche_code" name="recherche_code" placeholder="Code client" onkeyup="myFunction('code')"/>
		<input type="text" id="recherche_commercial" name="recherche_commercial" placeholder="Commercial" onkeyup="myFunction('commercial')"/>
		<input type="text" id="recherche_raison" name="recherche_raison" placeholder="Raison sociale" onkeyup="myFunction('raison')"/>
		<input type="submit" name="ok" />
		</form>
	</center>
	
	<script>
	function myFunction(type) {
		switch(type)
		{
			case (type == 'code') :
				var x = document.getElementById("recherche_code");
				x.value = x.value.toUpperCase();
				break;
				
			case (type == 'commercial') :
				var x = document.getElementById("recherche_commercial");
				x.value = x.value.toUpperCase();
				break;
				
			case (type == 'raison') :
				var x = document.getElementById("recherche_raison");
				x.value = x.value.toUpperCase();
				break;
		}
	}
	</script>			

	<script>
		//AUTO-COMPLETION
		$('#recherche_code').autocomplete();
		var liste = <?php echo json_encode($liste) ?>;
			
		$('#recherche_code').autocomplete({
			source : liste
		});
		
		$('#recherche_commercial').autocomplete();
		var liste2 = <?php echo json_encode($liste2) ?>;
			
		$('#recherche_commercial').autocomplete({
			source : liste2
		});
		
		$('#recherche_raison').autocomplete();
		var liste3 = <?php echo json_encode($liste3) ?>;
			
		$('#recherche_raison').autocomplete({
			source : liste3
		});		
	</script>

			<br/><br/><br/>
			<center>
			<?php
				connexion();
				if(!isset($_POST['ok']))
				{
					$sql ="Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE adresse.code_client=client.code group by code order by code";
					$sql2="SELECT code, raison_sociale, nom_commercial FROM client WHERE code NOT IN (SELECT code_client FROM adresse) GROUP BY code ORDER BY code";
				}
				else
				{
					$code=$_POST['recherche_code'];
					$rs=$_POST['recherche_raison'];
					$com=$_POST['recherche_commercial'];
					$sql ="Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE adresse.code_client=client.code AND code like '$code%' AND raison_sociale like '$rs%' AND nom_commercial like '$com%'	 group by code order by code";
					$sql2="SELECT code, raison_sociale, nom_commercial FROM client WHERE code NOT IN (SELECT code_client FROM adresse) AND code like '$code%' AND raison_sociale like '$rs%' AND nom_commercial like '$com%' GROUP BY code ORDER BY code";
				}
			?>
			
		<div class="CSSTableGenerator" >
		<table id="tab_article">
			<tr class="tab_article_couleur">
				<td>Code Client</td>
				<td>Raison Sociale</td>
				<td>Code Postal</td>
				<td>Ville</td>
				<td>Nom Commercial</td>
			</tr>
			
			<?php
				$execute=mysql_query("$sql") or die('Erreur au niveau de la requete'.mysql_error());
				while($data=mysql_fetch_array($execute))
				{
					echo "<tr><td><strong><a href='modif_client.php?code={$data['code']}'>{$data['code']}</a></strong></td>
					<td>{$data['raison_sociale']}</td>
					<td>{$data['cp']}</td>
					<td>{$data['ville']}</td>
					<td>{$data['nom_commercial']}</td>
					</tr>";
				}
				$execute2=mysql_query("$sql2") or die('Erreur au niveau de la requete'.mysql_error());
				while($data=mysql_fetch_array($execute2))
				{
					echo "<tr><td><strong><a href='modif_client.php?code={$data['code']}'>{$data['code']}</a></strong></td>
					<td>{$data['raison_sociale']}</td>
					<td>Non renseigné</td>
					<td>Non renseignée</td>
					<td>{$data['nom_commercial']}</td>
					</tr>";
				}
				echo "</table>";
			?>
		
		</center>
		</div>
		<br/><br /><br />
		
		<center><a href="ajout_client.php"><button type="button" onClick="">Ajouter un nouveau client</button></a></center>
</section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
