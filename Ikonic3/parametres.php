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
		document.getElementById('contentArea').innerHTML="<br/>"+"<form action='' method='post'><input type='text' name='new_param' />";	
		document.getElementById('contentArea').innerHTML+="<input style=\" margin-left:5px;\" type=\"submit\" value=\"Ok\" /></form>";
	}
	</script>
</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(5); ?>
        <?php
			connexion();
			$sql="SELECT * FROM parametre;";
			$requete=mysql_query($sql);
			$data=mysql_fetch_array($requete);
			$param_bd=$data['num_bl'];

		?>
        <?php
			//Traitement PHP
			if(isset($_POST['new_param']))
			{
				$connexion=connexionI();
				$p=$_POST['new_param'];
				if($param_bd<$p)
				{
					$sql="UPDATE parametre SET num_bl=$p,num_facture=$p,num_avoir=$p,num_devis=$p,num_proforma=$p WHERE num_bl>0";
					mysqli_query($connexion,$sql);
					header('Location:parametres.php');

				}
			}
		
		?>
		
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Paramètres</h1>
        <br/>
        <br/>
		<center><i><p><?php echo "Nous sommes le ".date("d-m-Y");?></p></i>
		<br/>

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
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_bl" name="numero_bl" readonly value="<?php echo $data['num_bl'];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_facture" name="numero_facture" readonly value="<?php echo $data['num_facture'];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_avoir" name="numero_avoir" readonly value="<?php echo $data['num_avoir'];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_devis" name="numero_devis" readonly value="<?php echo $data['num_devis'];?>"/></td>
					<td><input style="width:50px;margin-right:20px;" type="text" id="numero_proforma" name="numero_proforma" readonly value="<?php echo $data['num_proforma'];?>"/></td>
				</tr>
			</table>
			
			<br/>
			</div>
			<p>Redéfinir les numéros pour l'année suivante? <p style="color:red;">(Attention cette action est irréversible)</p></p><br/>
			<form action="" method="POST">
				<input type="text" name="new_param" />
				<input type="submit" value="Ok" />
				
			</form>
			</center>
		


	</section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>