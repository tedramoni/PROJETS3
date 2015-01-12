<!DOCTYPE html>
<html lang="fr">

<head>
	<link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css" />
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/ico" href="images/favicon.ico" />
	<meta charset="utf-8" />
	<title>Ikonic: Liste des approvisionnements</title>
</head>


<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <!-- inclusion des librairies jQuery et jQuery UI (fichier principal et plugins) -->

	<section>
		<?php include("Inclusion/header.php"); actif(2); include("Inclusion/gestion.php");?>

		<h1 style="padding-top: 65px; text-align:center;">Liste des approvisionnements</h1><br/><br/>
	

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
	
	<form name="form_contact" method="POST" action="appro.php">
		<center><p>Du:	<input type="date" name="dateD" /> au <input type="date" name="dateF" />
				Ref : <input type="text" id="recherche" name="recherche" onkeyup="myFunction()"/>
		<script>
			function myFunction() {
				var x = document.getElementById("recherche");
				x.value = x.value.toUpperCase();
			}
		</script>			
		<input type="submit" name="valider" /></center></p><br/><br/>
	</form>
		
	<script>
		//AUTO-COMPLETION
		$('#recherche').autocomplete();
		var liste = <?php echo json_encode($liste) ?>;
			
		$('#recherche').autocomplete({
			source : liste
		});
	</script>

	<center>
	<?php
		connexion();
		$requete=mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM stock;"));
		$nbreArt=$requete[0];
		$perPage=10;
		$pCourante=1;
		$nbPage=ceil($nbreArt/$perPage);
		$sql="SELECT * FROM stock ";
		if(isset($_POST['valider']))
		{
			$ref=$_POST['recherche'];
			$sql.="WHERE ref LIKE '{$ref}%'";
			if(!empty($_POST['dateD']) && !empty($_POST['dateF']))
			{
				$sql.="AND date BETWEEN '{$_POST['dateD']}' AND '{$_POST['dateF']}'";
			}
		}
	?>
	<br/>
	<div class="CSSTableGenerator" >
		<table id="tab_article">
			<tr class="tab_article_couleur">
				<td>Date</td>
				<td>Réf</td>
				<td>Nombre d'entrée</td>
				<td>Nombre en stock</td>
			</tr>
			
	<?php
		if(isset($_GET['p']))
		{
			$a=$perPage*($_GET['p']-1);
			$sql.="LIMIT $a, $perPage";
		}
		if(!isset($_GET['p']))
		{
			$sql.="LIMIT 0, {$perPage}";
		}
		$execute=mysql_query("$sql") or die('Erreur au niveau de la requete'.mysql_error());
		while($data=mysql_fetch_array($execute))
		{
			echo "<tr><td>{$data['date']}</td><td>{$data['ref']}</td><td>{$data['nbre_entree']} </td><td>{$data['nbre_stock']}</td></tr>";
		}
		echo "</table><br/>";
		echo "Page : ";
		for($i=1;$i<=$nbPage;$i++)
		{
			echo "<a href='appro.php?p=$i'> $i </a>";
		}
		
	?>
	<br/><br/>
	</center>
	</div>
</section>

<?php include("Inclusion/bottom.php"); ?>

</body>
</html>