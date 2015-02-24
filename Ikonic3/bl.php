<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>BON DE LIVRAISON IKONIC</title>
</style>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script type='text/javascript' src='order.js'></script>
	<link rel="stylesheet" type="text/css" href="css/TableCSSCode2.css" />
</head>

<?php
include("Inclusion/gestion.php");
connexion();
$sql="SELECT * FROM article ";
$execute=mysql_query($sql) or die('Erreur au niveau de la requete'.mysql_error());
$article=array();
$i=0;
while($data=mysql_fetch_array($execute))
{
	$article[$i]=$data;	
	$i++;
}
?>
<body> 
<form name="form1" action="" method="POST">
       <!-- <div id="page-wrap" margin-left="30%"> -->
	<div class="CSSTableGenerator">	   
    	<table id="order-table" align="center">
    		<tbody id="tablco">
    	    <tr>
    	    	<th> <input type="button" value="Ajouter article" class="btn_newpics" style="width:100px"></input></th> 
    	         <th>Référence</th> 
    	         <th>Libellé</th>
				 <th>Quantit&eacute;e</th>
				 <th>X</th>
    	         <th>Prix</th> 
				 <th>Remise</th>  
				 <th>Poids</th> 
				 <th>Volume</th>  				  				 
    	         <th style="text-align: right;">Total (&euro;)</th> 
				 <th style="text-align: right;">Total (kg)</th> 
    	         <th style="text-align: right;">Total (m3)</th> 

    	    </tr>
            <tr class="Ligne" id="first">
            	 <td class="supligne"> &nbsp <input type="button" class="btn-sup" value="-" style="width:30px" > </input> </td>
				 <td class="format">
                	<SELECT name="format[]" class="selected_format_input" style="width:140px">
                		<OPTION selected="selected" VALUE="0"></OPTION>
						<?php
						for($i=0;$i<sizeof($article);$i++)
						{
							echo "<OPTION VALUE='{$article[$i]['prix_ht']}-{$article[$i]['libelle']}-{$article[$i]['volume']}-{$article[$i]['poids']}'>{$article[$i]['ref']}</OPTION>";			
						}
						?>
					</SELECT>
                </td>             
  			    <td class="product-title"><textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Numero de série" rows="2" cols="80" class="name-pics" name="namearticle[]"></textarea></td>           
               
			    <td class="num-pallets">
					<input type="number" min="0" name="qarticle[]" class="num-pallets-input" style="width:40px"></input>
				</td>
				
				<td class="equals">X</td>
				<td class="prix_article"><input type="number" name="prix_article[]" style="width:40px" class="prix"></input>&euro;</td>         				
				<td class="remise_article">
					<input type="number" min="0" value="0" name="rarticle[]" style="width:40px" class="remise_article-input"></input>%
				</td>
				<td class="Poids_article"><input type="number" name="poids_article[]" style="width:40px" class="poids" readonly></input> kg</td>         				
				<td class="Volume_article"><input type="number" name="volume_article[]" style="width:40px" class="volume" readonly></input> m3</td>         								
				<td class="row-total"><input type="text" name="prixtt_article[]"  style="width:60px" class="row-total-input"  readonly></input>&euro;</td>                
           		<td class="row-totalp"><input type="text" name="totalp_article[]"  style="width:60px" class="row-totalp-input"  readonly></input>kg</td>                
				<td class="row-totalv"><input type="text" name="totalv_article[]"  style="width:60px" class="row-totalv-input"  readonly></input>m3</td>                
		   </tr>
            <tr class="Ligne" id="default">
            	<td class="supligne" style="text-align:center"> &nbsp <input type="button" class="btn-sup" value="-" style="width:30px align:center" > </input> </td>
 			    <td class="format">
                	<SELECT name="format[]" class="selected_format_input" style="width:140px">
                		<OPTION selected="selected" VALUE="0"></OPTION>
						<?php
						for($i=0;$i<sizeof($article);$i++)
						{
							echo "<OPTION VALUE='{$article[$i]['prix_ht']}-{$article[$i]['libelle']}-{$article[$i]['volume']}-{$article[$i]['poids']}'>{$article[$i]['ref']}</OPTION>";			
						}
						?>
					</SELECT>
                </td>                
  			    <td class="product-title"><textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Numero de série" rows="2" cols="80" class="name-pics" name="namearticle[]"></textarea></td>           
                <td class="num-pallets">
					<input type="number" min="0" name="qarticle[]" style="width:40px" class="num-pallets-input"></input>
				</td>
				<td class="equals">X</td>
				<!-- <td class="prix_article"><span name="prix_article[]" class="prix"></span>&euro;</td> -->
				<td class="prix_article"><input type="number" style="width:40px" name="prix_article[]" class="prix"></input>&euro;</td>         				
				<td class="remise_article">
					<input type="number" min="0"  value="0" style="width:40px" name="rarticle[]" class="remise_article-input"></input>%
				</td>
				<td class="Poids_article"><input type="number" name="poids_article[]" style="width:40px" class="poids" readonly></input> kg</td>         				
				<td class="Volume_article"><input type="number" name="volume_article[]" style="width:40px" class="volume" readonly></input> m3</td> 
				<td class="row-total"><input type="text" style="width:60px" name="prixtt_article[]" class="row-total-input"  readonly></input>&euro;</td>                
           		<td class="row-totalp"><input type="text" name="totalp_article[]"  style="width:60px" class="row-totalp-input"  readonly></input>kg</td>                
				<td class="row-totalv"><input type="text" name="totalv_article[]"  style="width:60px" class="row-totalv-input"  readonly></input>m3</td>              
			</tr>  
             </tbody>
    	</table>    	
    	 	<br/>
			
		<div class="TotalPoids" style="text-align: left;">        	
            <span>  <b>TOTAL POIDS:</b> </span> 
            <input type="text" name="totalPoids" style="width:80px" class="total-poids"  value="0" id="product-poids" readonly></input>kg            	
            <br />                    
        </div>
				<div class="TotalVolume" style="text-align: left;">        	
            <span> <b> TOTAL VOLUME: </b></span> 
            <input type="text" name="totalVolume" style="width:80px" class="total-volume"  value="0" id="product-volume" readonly></input>m3            	
            <br />                    
        </div>
		<br/>
		<div class="TotalHT" style="text-align: left;">        	
            <span> <b> TOTAL HT: </b></span> 
            <input type="text" name="totalHT" style="width:80px" class="total-box"  value="0&euro;" id="product-ht" readonly></input>&euro;            	
            <br />            
            
        </div>
		
        <div class="Total" style="text-align: left;">        	
            <span> <b> TOTAL TTC:</b> </span> 
            <input type="text" style="width:80px" name="totalTTC" class="total-box"  value="0&euro;" id="product-subtotal" readonly></input>&euro;           	
            <br />            
            
        </div>
            
        </div>

        <div class="TotalTVA" style="text-align: left;">        	
            <span>  <b>DONT T.V.A:</b></span> 
            <input type="text" class="total-box" style="width:80px" value="0&euro;" name="totalTVA" id="product-TVA" readonly></input>&euro;         	
            <br />             
        </div>
        
    </div> 
    </form>
</form>

</body>
</html>

