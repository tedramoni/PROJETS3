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



<title>Ikonic: Consultation d'article</title>
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
	
	<h1 style="padding-bottom: 15px; text-align:center;">Consulter un article</h1>

		<br/><p><a href="configuration.php">Configuration</a> >> <a href="gestion_stock.php">Gestion de stock</a> >> Consultation d'article</p><br/>
	
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
	<form name="form_contact" method="POST" action="consult_article.php">
		
			 <center>Veuillez entrer la référence de l'article : <input type="text" id="recherche" name="recherche" onkeyup="myFunction()"/><br/><br/>
	<script>
	function myFunction() {
		var x = document.getElementById("recherche");
		x.value = x.value.toUpperCase();
	}
	</script>			
			<div id="formu_contact"><input type="submit" name="valider" /></center></div>

				
	</form>
		<script>
		//AUTO-COMPLETION
		$('#recherche').autocomplete();
		var liste = <?php echo json_encode($liste) ?>;
			
		$('#recherche').autocomplete({
			source : liste
		});
		</script>

			<br/><br/>
			<center>
			<h3>Liste des articles</h3>
			<br/>
						<?php

				connexion();
				$requete=mysql_fetch_array(mysql_query("SELECT COUNT(ref) FROM article;"));
				$nbreArt=$requete[0];
				$perPage=5;
				$pCourante=1;
				$nbPage=ceil($nbreArt/$perPage);

				$sql="SELECT * FROM article ";
				$page=true;
				if(isset($_POST['valider']))
				{
					$ref=$_POST['recherche'];
					$sql.="WHERE ref='{$ref}'";
					$page=false;
				}
				else
				{
				
				if(isset($_POST['valid_tri']) || isset($_COOKIE['famille']) || isset($_COOKIE['choix']) || isset($_COOKIE['type']))
				{
					if(isset($_COOKIE['famille']) || isset($_COOKIE['choix']) || isset($_COOKIE['type']))
					{
						if(isset($_POST['valid_tri']))
						{
							$type=$_POST['type'];
							$choix=$_POST['choix'];
							$fam=$_POST['famille'];
							$_COOKIE['famille']=$fam;
							$_COOKIE['choix']=$choix;
							$_COOKIE['type']=$type;
						}
						$type=$_COOKIE['type'];
						$choix=$_COOKIE['choix'];
						$fam=$_COOKIE['famille'];
						$famille=str_replace("é", "&eacute;", $fam);
						
					}
					else
					{
						$type=$_POST['type'];
						$choix=$_POST['choix'];
						$fam=$_POST['famille'];
						$_COOKIE['famille']=$fam;
						$_COOKIE['choix']=$choix;
						$_COOKIE['type']=$type;
						$famille=str_replace("é", "&eacute;", $fam);
					}		
					if($famille!='all')
					{
						$sql.="WHERE famille='{$famille}' ";
						$requete=mysql_fetch_array(mysql_query("SELECT COUNT(ref) FROM article WHERE famille='{$famille}';"));
						$nbreArt=$requete[0];
						$nbPage=ceil($nbreArt/$perPage);
					}
					if($type!='date')
					{
						$sql.="ORDER BY {$type} ";
					}
					else
					{
						$sql.="ORDER BY id ";
					}
					if($choix=="croissant")
					{
						$sql.="ASC ";//Faire un cookie pour enregistrer le choix
					}
					else
					{
						$sql.="DESC ";
					}
					//echo $_COOKIE['famille'].$_COOKIE['choix'].$_COOKIE['type'];
				}
				}
			
		if($form)
		{
			?>
			<form name="trie_article" action="consult_article.php?p=1" method="POST">
				<p>Famille: <select name="famille" onchange="change_famille(this.value)">
						<option value="all">Tout afficher</option>
						<?php
							$tab_famille=array('Caméra analogique','Caméra IP','DVR','NVR','Accessoire','Speed Dome','DVR HD-CVI','Caméra HD-CVI','Micro','DVR - PC - CARTE','Fibre optique','Caisson support','Logiciel','Objectif','Kits Ikonic');	
							foreach($tab_famille as $famille)
							{
								if($famille!=$_COOKIE['famille'] || !isset($_COOKIE['famille']))
								{
									echo "<option value=\"{$famille}\">{$famille}</option>";
								}
								else
								{
									echo "<option value=\"{$famille}\" selected='selected'>{$famille}</option>";
								}
						
							}
						?>
					</select>
				Trier par: 
				<select name="type" onchange="change_type(this.value)">
					<?php
						if(isset($_COOKIE['type']))
						{
						
							if($_COOKIE['type']=='date')
							{
								echo '<option value="date" selected="selected">Date</option>';
								echo '<option value="prix_ht">Prix</option>';
								echo '<option value="nbre_stock">Nombre en stock</option>';
							}
							elseif($_COOKIE['type']=='prix_ht')
							{
								echo '<option value="date">Date</option>';
								echo '<option value="prix_ht" selected="selected">Prix</option>';
								echo '<option value="nbre_stock">Nombre en stock</option>';
							}
							else
							{
								echo '<option value="date">Date</option>';
								echo '<option value="prix_ht">Prix</option>';
								echo '<option value="nbre_stock" selected="selected">Nombre en stock</option>';
							}
						}
						else
						{
							echo '<option value="date">Date</option>';
							echo '<option value="prix_ht">Prix</option>';
							echo '<option value="nbre_stock">Nombre en stock</option>';
						}
						?>
					
				</select>
				<select name="choix" onchange="change_choix(this.value)">
					<?php
						if(isset($_COOKIE['choix']))
						{
						
							if($_COOKIE['choix']=='croissant')
							{
								echo '<option value="croissant" selected="selected">Croissant</option><option value="decroissant">Decroissant</option>';
							}
							else
							{
								echo '<option value="croissant">Croissant</option><option value="decroissant" selected="selected">Decroissant</option>';
							}
						}
						else
						{
							echo '<option value="croissant">Croissant</option><option value="decroissant">Decroissant</option>';
						}
					?>					
				</select>
				<input type="submit" name="valid_tri" value="OK" /> </p>
			
			</form>
			<?php
	}
	else
	{
		echo "<a href='consult_article.php' style='border-bottom:1px dotted black;'>Revenir au listing général ici.</a><br/>";
	}
	
	?>
			<br/>
		<div class="CSSTableGenerator" >
		<table id="tab_article">
			<tr class="tab_article_couleur">
				<td>Référence</td>
				<td>Libelle</td>
				<td>Prix HT</td>
				<td>Nombre en stock</td>
			</tr>
			
			<?php
				
				
				if(isset($_GET['p']))
				{
					$a=$perPage*($_GET['p']-1);
					$sql.="LIMIT $a, $perPage";
				}
				if($page)
				{
				if(!isset($_GET['p']))
				{
					$sql.="LIMIT 0, {$perPage}";
				}
				}
				$execute=mysql_query("$sql") or die('Erreur au niveau de la requete'.mysql_error());
				
				while($data=mysql_fetch_array($execute))
				{
					echo "<tr><td>{$data['ref']}</td><td>{$data['famille']}</td><td>{$data['prix_ht']} €</td><td>{$data['nbre_stock']}</td></tr>";
			
				}
				echo "</table><br/>";
				if($page)
				{
					echo "Page > ";
				for($i=1;$i<=$nbPage;$i++)
				{
					echo "<a href='consult_article.php?p=$i'> $i </a>";
				}
				}
			?>
		
		</center>
		</div>


</section>



<?php include("Inclusion/bottom.php"); ?>

</body>
</html>
