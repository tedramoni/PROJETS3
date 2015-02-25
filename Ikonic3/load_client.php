<?php
include("Inclusion/gestion.php");

if(isset($_POST)==true && empty($_POST)==false)
{				
				$bdd = connexionI();
				$code = $_POST['code_client'];
                $liste=array();
				$liste2=array();
				$liste3=array();
				$sql='Select * from client where code="'.$code.'"';
				$sql2='Select * from adresse where code_client="'.$code.'" AND type="F" LIMIT 1';
				$sql3='Select * from adresse where code_client="'.$code.'" AND type="L" LIMIT 1';
				$requete=mysqli_query($bdd,$sql);
				$i=0;				
				while($result=mysqli_fetch_array($requete)) 
				{ 
					$liste[$i]=$result; 
					$i++;
				}
				$j=0;
				$requete=mysqli_query($bdd,$sql2);
				mysqli_data_seek($requete, 0);
				while($result2=mysqli_fetch_array($requete)) 
				{ 
					$liste2[$j]=$result2; 
					$j++;
				}
				$merge = array_merge($liste, $liste2);
				$k=0;
				$requete=mysqli_query($bdd,$sql3);
				mysqli_data_seek($requete, 0);
				while($result3=mysqli_fetch_array($requete)) 
				{ 
					$liste3[$j]=$result3; 
					$k++;
				}					
				$data = array_merge($merge, $liste3);
				echo json_encode($data);
}		

?>