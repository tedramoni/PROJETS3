<?php
session_start();
include 'parametre.php';

// CSS
	echo '<style type="text/css">';
		echo 'table {';
		echo 'border: medium solid #000000;';
		echo '}';
		echo 'td, th {';
		echo 'border: thin solid #6495ed;';
		echo '}';
	echo '</style>';
// Fin CSS
	
$connexion=mysqli_connect($serveur, $login, $mdp) or die ("Connexion Impossible");
$bd="u157965635_iut";
mysqli_select_db($connexion, $bd);
$query='SELECT * from client ORDER BY code ASC';
$query2='SELECT * FROM adr_livraison ORDER BY code ASC';
$result=mysqli_query($connexion,$query);
$result2=mysqli_query($connexion,$query2);

	echo "<br />";
	echo "<h1> TABLES DE LA BASE DE DONNEES </h1> <hr> <br><br>";
	
	echo "<h2> Table Client</h2> <br><br>";
	
	echo '<table>';
	echo '<TR>';
		echo '<td>';
		echo "<b>Code Client</b>";
		echo '</td>';
		echo '<td>';
		echo "<b>Nom</b>";
		echo '</td>';
		echo '</TR>';		
while($ligne=mysqli_fetch_row($result))
			{
				for($i=0;$i<2;$i++)
				{
					if($i==0) echo '<TR>';
						echo '<td>';
						echo $ligne[$i];
						echo '</td>';
				}
				if($i==1) echo '</TR>';
					
			}
	echo '</table> <br><br/>';
	
	echo "<h2> Table Adresse Livraison</h2> <br><br>";
	
echo '<table>';
	echo '<TR>';
		echo '<td>';
		echo "<b>Code Client</b>";
		echo '</td>';
		echo '<td>';
		echo "<b>Code Postal</b>";
		echo '</td>';
		echo '<td>';
		echo "<b>Ville</b>";
		echo '</td>';
		echo '<td>';
		echo "<b>Adresse</b>";
		echo '</td>';
		echo '</TR>';		
while($ligne=mysqli_fetch_row($result2))
			{
				for($i=1;$i<5;$i++)
				{
					if($i==1) echo '<TR>';
						echo '<td>';
						echo $ligne[$i];
						echo '</td>';
				}
				if($i==4) echo '</TR>';
					
			}
	echo '</table> <br><br/>';

?>