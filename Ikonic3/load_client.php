<?php
include("Inclusion/gestion.php");

if(isset($_POST)==true && empty($_POST)==false)
{				
				$bdd = connexionI();
				$code = $_POST['code_client'];
                $liste=array();
				$liste2=array();
				$liste3=array();
				$liste4=array();
				$liste5=array();
				$sql='Select * from client where code="'.$code.'"';
				$sql2='Select * from adresse where code_client="'.$code.'" AND type="F" LIMIT 1';
				$sql3='Select * from adresse where code_client="'.$code.'" AND type="L" LIMIT 1';
				$sql4='Select * from adresse where code_client="'.$code.'" AND type="F"';
				$sql5='Select * from adresse where code_client="'.$code.'" AND type="L"';
				$requete=mysqli_query($bdd,$sql);
				$i=0;

				// recup des infos clients				
				while($result=mysqli_fetch_array($requete)) 
				{ 
					$liste[$i]=$result; 
					$i++;
				}
				$j=0;
				$requete=mysqli_query($bdd,$sql2);
				mysqli_data_seek($requete, 0);

				// recup de l'adresse de facturation par défaut
				while($result2=mysqli_fetch_array($requete)) 
				{ 
					$liste2[$j]=$result2; 
					$j++;
				}
				$merge = array_merge($liste, $liste2);
				$k=0;
				$requete=mysqli_query($bdd,$sql3);
				mysqli_data_seek($requete, 0);

				// recup de l'adresse de livraison par défaut
				while($result3=mysqli_fetch_array($requete)) 
				{ 
					$liste3[$j]=$result3; 
					$k++;
				}

				$merge = array_merge($merge, $liste3);
				$k=0;
				$requete=mysqli_query($bdd,$sql4);
				mysqli_data_seek($requete, 0);
				while($result4=mysqli_fetch_array($requete)) 
				{ 
					$liste4[$k]=$result4; 
					$k++;
				}
				$merge[sizeof($merge)]=$k;
				$merge = array_merge($merge, $liste4);
				$k=0;
				$requete=mysqli_query($bdd,$sql5);
				mysqli_data_seek($requete, 0);
				while($result5=mysqli_fetch_array($requete)) 
				{ 
					$liste5[$k]=$result5; 
					$k++;
				}
				$merge[sizeof($merge)]=$k;
				$data = array_merge($merge, $liste5);
				echo json_encode($data);
}		

?>