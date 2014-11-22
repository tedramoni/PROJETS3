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
function filtre_texte($texte)
{
		$texte = str_replace(":smile:", "<img src='Images/smiley/smile.gif' border='0'>", $texte);
		$texte = str_replace(":wink:", "<img src='Images/smiley/wink.gif' border='0'>", $texte);
		$texte = str_replace(":wassat:", "<img src='Images/smiley/wassat.gif' border='0'>", $texte);
		$texte = str_replace(":tongue:", "<img src='Images/smiley/tongue.gif' border='0'>", $texte);
		$texte = str_replace(":laughing:", "<img src='Images/smiley/laughing.gif' border='0'>", $texte);
		$texte = str_replace(":sad:", "<img src='Images/smiley/sad.gif' border='0'>", $texte);
		$texte = str_replace(":angry:", "<img src='Images/smiley/angry.gif' border='0'>", $texte);
		$texte = str_replace(":crying:", "<img src='Images/smiley/crying.gif' border='0'>", $texte);


		return $texte;
}