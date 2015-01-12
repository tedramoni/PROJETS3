<?php

function connexion()
{
	//CONNECTION A LA BDD
	try
	{
		$db=mysql_connect('mysql.serversfree.com','u157965635_root','ramoni');
		mysql_select_db('u157965635_ikc', $db);
	}
	catch(Exception $e)
	{	
		die('Erreur: '.$e->getMessage());
	}
}

function connexionI()
{
	$connexion = mysqli_connect("mysql.serversfree.com", "u157965635_root", "ramoni", "u157965635_ikc") or die(mysql_error());
	return $connexion;
}

function error404()
{
	echo "<center><img src=\"./Images/erreur404.jpg\" /></center>";
}

function espace($nbre)
{
	for($i=0;$i<$nbre;$i++)
	{
		echo "&nbsp;";
	}
}