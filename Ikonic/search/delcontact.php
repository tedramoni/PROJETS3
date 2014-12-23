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
			$contact=$_GET['id'];
					
			$req1 = 'DELETE FROM contact WHERE contact.code = "'.$contact.'"';		
			$action1 = mysqli_query($connexion, $req1);
			if ($action1) 
			{
				header("Location: success.php?state=success&type=contact"); 
				exit;
			}
			else 
			{
				header("Location: success.php?state=error&type=contact");
				exit;
			}			
		}
	}
	?>