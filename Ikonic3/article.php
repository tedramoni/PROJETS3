<?php
if(isset($_POST['valider'])) {
	setcookie('famille',$_POST['famille'],time()+3600);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	<title>Ikonic: Interface article</title>
</head>


<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <!-- inclusion des librairies jQuery et jQuery UI (fichier principal et plugins) -->

	<section>
		<?php include("Inclusion/header.php"); actif(2); include("Inclusion/gestion.php");?>

		<h1 style="padding-top: 65px; text-align:center;">Gestion des articles</h1><br/><br/>
	
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
		?>
		
		<center>
		<?php
			//------------------------GESTION DU FORMULAIRE (TRI PAR FAMILLE + TRI PAR REFERENCE)------------------
				connexion();
				//--------------PAGINATION--------------------------------------------------
				$requete=mysql_fetch_array(mysql_query("SELECT COUNT(ref) FROM article;"));
				$nbreArt=$requete[0];
				$perPage=10; //Nombre d'article par page.
				$pCourante=1;
				$nbPage=ceil($nbreArt/$perPage);
				$sql="SELECT * FROM article ";
				if(isset($_POST['valider']) || isset($_COOKIE['famille']))// SI COOKIE OU ENVOIE DE FORMULAIRE
				{
					if(isset($_COOKIE['famille'])) //SI COOKIE EXISTE
					{
						$fam=$_COOKIE['famille'];
						//$famille=str_replace("é", "&eacute;", $fam);
						$famille=$fam;
						//$sql.="WHERE famille='{$famille}'";
					}
					if(isset($_POST['valider']))//SI ENVOIE DE FORMULAIRE
					{
						$ref=$_POST['recherche'];
						$fam=$_POST['famille'];
						$fam=$_POST['famille'];
						$_COOKIE['famille']=$fam;
						$sql.="WHERE ref LIKE '{$ref}%' ";
						$famille=$fam;
					}		
					if($famille!='all')
					{
						if(!isset($_POST['valider']))
						{
							$sql.=" WHERE famille='{$famille}' ";
						}
						else
						{
							$sql.=" AND famille='{$famille}' ";
						}
						$requete=mysql_fetch_array(mysql_query("SELECT COUNT(ref) FROM article WHERE famille='{$famille}';"));
						$nbreArt=$requete[0];
						$nbPage=ceil($nbreArt/$perPage);
					}
				}

		?>
		<form name="form_contact" method="POST" action="article.php">
			Famille: <select name="famille" onchange="change_famille(this.value)">
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
			 <input type="text" id="recherche" name="recherche" placeholder="Ecrivez la référence" onkeyup="myFunction()"/>
			 <input type="submit" name="valider" value="Rechercher"/>
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
			<br/><br/>
		
		
		<div class="CSSTableGenerator" >
			<table id="tab_article">
				<tr class="tab_article_couleur">
					<td>Référence</td>
					<td>Libelle</td>
					<td>Prix HT</td>
					<td>Nombre en stock</td>
				</tr>
		<?php
			//-----------PAGINATION
			if(isset($_GET['p']))
			{
				$a=$perPage*($_GET['p']-1);
				$sql.="LIMIT $a, $perPage";
			}
			if(!isset($_GET['p']))
			{
				$sql.="LIMIT 0, {$perPage}";
			}
	
			$execute=mysql_query($sql) or die('Erreur au niveau de la requete'.mysql_error());
			while($data=mysql_fetch_array($execute))
			{
				echo "<tr><td><a href='modif_article.php?ref={$data['ref']}'>{$data['ref']}</a></td><td>{$data['libelle']}</td><td>{$data['prix_ht']} €</td><td>{$data['nbre_stock']}</td></tr>";			
			}
			echo "</table><br/>";
			echo "Page : ";
			for($i=1;$i<=$nbPage;$i++)
			{
				echo "<a href='article.php?p=$i'> $i </a>";
			}
			?>
		
		<br/><br/><br/>
		<button type="button" onclick="window.location.href='ajout_article.php'">Ajouter un article</button>
		<button type="button" onclick="window.location.href='appro.php'">Historique approvisionnements</button>
		</center>
		</div>

</section>

<?php include("Inclusion/bottom.php"); ?>

</body>
</html>