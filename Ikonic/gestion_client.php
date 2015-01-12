<?php
session_start();
if(isset($_POST['valid_tri'])) {
setcookie('famille',$_POST['famille'],time()+3600);
setcookie('choix',$_POST['choix'],time()+3600);
setcookie('type',$_POST['type'],time()+3600);
}
if(!isset($_SESSION['pseudo']))
{
	header('Location:index.php');
}

$form=true;
if(isset($_POST['valider'])) {
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
	<link rel="stylesheet" type="text/css" href="style/TableCSSCode.css" />
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />

	<script type="text/javascript" src="Inclusion/styleswitcher.js"></script>
	<link rel="icon" type="image/ico" href="Images/favicon.ico" />
	<meta charset="utf-8" />



<title>Ikonic: Consultation Client</title>
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
	
	<h1 style="padding-bottom: 15px; text-align:center;">Gestion des clients</h1>
	
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
			//print_r($liste);
		
		?>
		<br/>
	<form name="form_contact" method="POST" action="gestion_client.php">
		Code : <input type="text" id="recherche_code" name="recherche_code" onkeyup="myFunction('code')"/>
		<input type="submit" name="valider" /><br/><br/>			
	</form>	

	<form name="form_contact" method="POST" action="gestion_client.php">
		Commercial: <input type="text" id="recherche_commercial" name="recherche_commercial" onkeyup="myFunction('commercial')"/>
		<input type="submit" name="valider2" /><br/><br/>				
	</form>	

	<form name="form_contact" method="POST" action="gestion_client.php">
		Raison sociale : <input type="text" id="recherche_raison" name="recherche_raison" onkeyup="myFunction('raison')"/>
		<input type="submit" name="valider3" />			
	</form>		
	
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

			<br/><br/>
			<center>
			<h3>Liste des clients</h3>
			<br/>
						<?php

				connexion();
				$requete=mysql_fetch_array(mysql_query("SELECT COUNT(code) FROM client;"));
				$nbreArt=$requete[0];

				$sql = 'Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE client.code = adresse.code_client group by code order by code';
				if(isset($_POST['valider']))
				{
					$code=$_POST['recherche_code'];
					$sql ="Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE client.code like '".$code."%' and client.code = adresse.code_client group by code order by code";
				}
				if(isset($_POST['valider2']))
				{
					$commercial=$_POST['recherche_commercial'];
					$sql ="Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE client.nom_commercial like '".$commercial."%' and client.code = adresse.code_client group by code order by code";
				}
				if(isset($_POST['valider3']))
				{
					$raison=$_POST['recherche_raison'];
					$sql ="Select code,raison_sociale,cp,ville,nom_commercial from client,adresse WHERE client.raison_sociale like '".$raison."%' and client.code = adresse.code_client group by code order by code";
				}
	else
	{
		echo "<a href='gestion_client.php' style='border-bottom:1px dotted black;'>Revenir au listing général ici.</a><br/>";
	}
	
	?>
			<br/>
		<div class="CSSTableGenerator" >
		<table id="tab_article">
			<tr class="tab_article_couleur">
				<td>Code_client</td>
				<td>Raison Sociale</td>
				<td>Code Postal</td>
				<td>Ville</td>
				<td>Nom Commercial</td>
			</tr>
			
			<?php
				$execute=mysql_query("$sql") or die('Erreur au niveau de la requete'.mysql_error());
				
				while($data=mysql_fetch_array($execute))
				{
					echo "<tr><td><strong><a href='search/modifier_client.php?envoie=ok&cc={$data['code']}'>{$data['code']}</a></strong></td>
					<td>{$data['raison_sociale']}</td>
					<td>{$data['cp']}</td>
					<td>{$data['ville']}</td>
					<td>{$data['nom_commercial']}</td>
					</tr>";
			
				}
				echo "</table><br/>";
			?>
		
		</center>
		</div>
		<br /><br />
		<a href="ajout_client.php"><button class="button-success pure-button" type="button" onClick="">Ajouter un nouveau client</button></a>
</section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
