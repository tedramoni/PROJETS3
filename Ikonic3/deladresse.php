<?php
		if (isset($_GET["id"]))
		{ 
			$connexion=mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");				
			$db = "u157965635_ikc";
			mysqli_select_db($connexion, $db);
			$adresse=$_GET['id'];
			$code_client=$_GET['cc'];
					
			$req1 = 'DELETE FROM adresse WHERE adresse.index ="'.$adresse.'"';		
			$action1 = mysqli_query($connexion, $req1);
			
			if ($action1) 
			{
				header("Location: modif_client.php?code=".$code_client);
				exit();
			}
			else 
			{
				header("Location: modif_client.php?state=error&code=".$code_client);
				exit();
			}			
		}
	?>