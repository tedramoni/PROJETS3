<?php
	session_start();
	if(!isset($_SESSION['pseudo']))
	{
	?>
		<li><a href="../index.php">Se Connecter</a></li>	
	<?php 
	} 
	else
	{	
		if (isset($_GET["id"]))
		{ 
			$connexion=mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni");				
			$db = "u157965635_ikc";
			mysqli_select_db($connexion, $db);
			$code_client=$_GET['id'];
					
			$req1 = 'DELETE FROM client WHERE client.code ="' .$code_client.'"';		
			$req2 = 'DELETE FROM adresse WHERE adresse.code_client ="' .$code_client.'"';	
			$req3 = 'DELETE FROM contact WHERE contact.code_client ="' .$code_client.'"';
			$action1=mysqli_query($connexion, $req1);
			$action2=mysqli_query($connexion, $req2);
			$action3=mysqli_query($connexion, $req3);
			
			if ($action1 && $action2 && $action3) 
			{
				header("Location: success.php?state=success&type=client"); 
			}
			else 
			{
				header("Location: success.php?state=error&type=client");
			}			
		}
	}
	?>