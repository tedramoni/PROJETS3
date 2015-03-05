<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
    <link rel="stylesheet" type="text/css" href="css/TableCSSCode2.css" />
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
    <meta charset="utf-8" />
    <title>Ikonic: Paramètres</title>
	<script type="text/javascript">
    function afficheParam()
    {
		document.getElementById('contentArea').innerHTML="<br/>"+"	<select name=\"annee\"onchange=\"change_manga(this.value)\">"+"<option value=\"a\">2015</option>"+"<option value=\"b\">2016</option></select>";	
		document.getElementById('contentArea').innerHTML+="<input style=\" margin-left:5px;\" type=\"submit\" value=\"Ok\" />";
	}
	</script>
</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(5); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Paramètres</h1>
        <br/>
        <br/>
		<center><i><p><?php echo "Nous sommes le ".date("d-m-Y");?></p></i>
		<br/>
		<?php
			connexion();
			$sql="SELECT * FROM parametre;";
			$requete=mysql_query($sql);
			$data=mysql_fetch_array($requete);

		?>
		<div id="formu_contact">
			
			<table>
				<tr>
					<td>N°BL</td>
					<td>N°Facture</td>
					<td>N°Avoir</td>
					<td>N°Devis</td>
					<td>N°Proforma</td>
				</tr>
				<tr>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_bl" name="numero_bl" disabled="diasabled" value="<?php echo $data[num_bl];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_facture" name="numero_facture" disabled="diasabled" value="<?php echo $data[num_facture];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_avoir" name="numero_avoir" disabled="diasabled" value="<?php echo $data[num_avoir];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_devis" name="numero_devis" disabled="diasabled" value="<?php echo $data[num_devis];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_proforma" name="numero_proforma" disabled="diasabled" value="<?php echo $data[num_proforma];?>"/></td>
				</tr>
			</table>
			
			<br/>
			<p><a href="#" onclick="afficheParam()">Redéfinir les numéros pour l'année suivante? </a><p style="color:red;">(Attention cette action est irréversible)</p></p>
			</div>
			<div id="contentArea"></div>
			</center>
		
		<?php
			//Traitement PHP
			if(isset($_POST['annee']))
			{
			}
		
		?>
		

	</section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>