<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
    <link rel="stylesheet" type="text/css" href="css/TableCSSCode2.css" />
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
    <meta charset="utf-8" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    <script type='text/javascript' src='Inclusion/order_facture.js'></script>
	<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
		document.getElementById('form1').target="_blank";
        document.getElementById('form1').submit();
    }
	function quitter_sans_sauvegarde() {
	  if (confirm("Quitter sans sauvegarder ?")) {
	   window.location.href = "http://iuted.bugs3.com/projet/Ikonic3/";
      }
	}
	function quitter_avec_sauvegarde(action) {
	  document.getElementById('form1').action = action;
      document.getElementById('form1').target="_self";
      document.getElementById('form1').submit();
	}
	
</script>

    <title>Ikonic: Saisie d'une Facture</title>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(4); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Saisie d'une facture</h1>
        <br/>
        <br/>

        <?php if (isset($_GET[ 'err'])) { if ($_GET[ 'err']=='err1' ) { echo "<center><p style='color:red;'>Le code client doit être de la forme : 9, puis une lettre, puis 4 chiffres (ex : 9L0015) !</center><br><br>"; } if ($_GET[ 'err']=='err2' ) { echo "<center><p style='color:red;'>Le code client existe déjà !</center><br><br>"; } } $liste=array(); connexion(); $sql='Select * from client' ; $requete=mysql_query($sql); while($result=mysql_fetch_array($requete)) { $liste[]=$result[ 'code']; } $sql2="SELECT * FROM article " ; $execute2=mysql_query($sql2) or die( 'Erreur au niveau de la requete'.mysql_error()); $article=array(); $i=0; while($data2=mysql_fetch_array($execute2)) { $article[$i]=$data2; $i++; } 
            $sql3="SELECT * FROM parametre;";
            $requete3=mysql_query($sql3);
            $data=mysql_fetch_array($requete3);
        ?>		
		<?php
		if(!empty($_POST))
		{
			$numero_bl=$_POST['numero_bl'];
            
			$date=$_POST['date'];
			$ref_client=$_POST['ref_client'];
			$ref_fournisseur=$_POST['ref_fournisseur'];
			$code_client=$_POST['code_client'];
			$nom_commercial=$_POST['nom_commercial'];
            $raison_social=$_POST['raison_social'];
            $acompte=$_POST['acompte'];
			$mode_reglement=$_POST['mode_reglement'];
			
			//Echeance, again
			$badara = explode("/", $date);
			$j = $badara[0];
			$m = $badara[1];
			$a = $badara[2];
			
			$ech = $_POST['echeance'];
			$fdmtest = $_POST['fdm'];
			if($fdmtest == "on")
			{
				$fdm = 1;
			}
			else
			{
				$fdm = 0;
			}
			$le = $_POST['jour'];
			
			
			$echeance=calculDate($j,$m,$a,$ech,$fdm,$le);
			
			
			$infos=$_POST['infos'];
			
			$BX_adr1=$_POST['BX_adr1'];
			$BX_adr2=$_POST['BX_adr2'];
			$BX_adr3=$_POST['BX_adr3'];
			$BX_cp=$_POST['BX_cp']; 
			$BX_ville=$_POST['BX_ville'];
			$BX_pays=$_POST['BX_pays'];
			$BX_tel_bur=$_POST['BX_tel_bur'];
			$BX_email=$_POST['BX_email'];
			$BX_site_web=$_POST['BX_site_web'];
			
			$BX_adr1_2=$_POST['BX_adr1_2'];
			$BX_adr2_2=$_POST['BX_adr2_2'];
			$BX_adr3_2=$_POST['BX_adr3_2'];
			$BX_cp2=$_POST['BX_cp2']; 
			$BX_ville2=$_POST['BX_ville2'];
			$BX_pays2=$_POST['BX_pays2'];
			$BX_tel_bur2=$_POST['BX_tel_bur2'];
			$BX_email2=$_POST['BX_email2'];
			$BX_site_web2=$_POST['BX_site_web2'];
			
			$expedition=$_POST['expedition'];
            $colis=$_POST['colis'];
		}
		else
		{
			$numero_bl="";
			$date=date('d/m/Y');
			$ref_client="";
			$ref_fournisseur="";
			$code_client="";
			$nom_commercial="";
            $raison_social="";
			$mode_reglement="";
			$echeance="";
			$infos="";
            $acompte="0";
			
			$BX_adr1="";
			$BX_adr2="";
			$BX_adr3="";
			$BX_cp=""; 
			$BX_ville="";
			$BX_pays="";
			$BX_tel_bur="";
			$BX_email="";
			$BX_site_web="";
			
			$BX_adr1_2="";
			$BX_adr2_2="";
			$BX_adr3_2="";
			$BX_cp2=""; 
			$BX_ville2="";
			$BX_pays2="";
			$BX_tel_bur2="";
			$BX_email2="";
			$BX_site_web2="";
			
			$expedition="";		
		}
		
		?>
        <div id="formu_contact">
            <form method="post" action="" id="form1">
                <br/>
				<label for="numero_f"><u>N°Facture :</u> </label>
                <input type="text" id="numero_f" name="numero_f" required="required" value="<?php echo $data[num_facture];?>"/><br/>
				
                <label for="numero_bl"><u>N°BL :</u> </label>
                <input type="text" id="numero_bl" name="numero_bl" required="required" value='<?php echo $numero_bl; ?>'/>

                <fieldset>
                    <br/>
                    <legend>Bon de livraison</legend>
                    <label for="date">Date : </label>
                    <input class="datepicker form-control" name="date" id="date" required="required" type="text" value="<?php echo $date;?>"/>
                    <script>
                        $(function() {
                        $( ".datepicker" ).datepicker({
                        altField: "#datepicker",
                        closeText: 'Fermer',
                        prevText: 'Précédent',
                        nextText: 'Suivant',
                        currentText: 'Aujourd\'hui',
                        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                        weekHeader: 'Sem.',
                        dateFormat: 'dd/mm/yy'
                        });
                        });
                    </script>
                    <br/>
                    <label for="ref_client"><u>Référence du client :</u> </label>
                    <input type="text" id="ref_client" name="ref_client" required="required" value='<?php echo $ref_client; ?>' />
                    <br/>
                    <label for="ref_fournisseur"><u>Référence du fournisseur :</u> </label>
                    <input type="text" id="ref_fournisseur" name="ref_fournisseur" required="required" value='<?php echo $ref_fournisseur; ?>' />
                    <br/>

                    <label for="code_client"><u>Code Client :</u> </label>
                    <input type="text" id="code_client" name="code_client" class="cc" onkeyup="myFunction()" value='<?php echo $code_client; ?>'/>
					<input type="button" value="Charger données client" class="btn_load_client" style="width:200px"></input>
                    <br/>

                    <script>
                        function myFunction() {
                            var x = document.getElementById("code_client");
                            x.value = x.value.toUpperCase();
                        }
                    </script>

                    <script>
                        //AUTO-COMPLETION
                        $('#code_client').autocomplete();
                        var liste = <?php echo json_encode($liste) ?> ;

                        $('#code_client').autocomplete({
                            source: liste
                        });
                    </script>

                    <label for="nom_commercial"><u>Nom Commercial :</u> </label>
                    <input type="text" class="nom_commercial" id="nom_commercial" name="nom_commercial" required="required" value='<?php echo $nom_commercial; ?> '/>
                    <input type="hidden" class="raison_social" id="raison_social" name="raison_social" required="required" value='<?php echo $raison_social; ?> '/>
                     <br/>
                    <label for="acompte"><u>Acompte versé: </u></label>
                    <input type="number" class="acompte" id="acompte" name="acompte" required="required" value='<?php echo $acompte; ?>'/>
                    <br/>
                    <label for="mode_reglement"><u>Mode de règlement :</u> </label>
                    <input type="text" class="mode_reglement" id="mode_reglement" name="mode_reglement" required="required" value='<?php echo $mode_reglement; ?>'/>
                    <br/>
                    <label for="echeance"><u>Echeance :</u> </label>
                    <input type="text" class="echeance" id="echeance" name="echeance" required="required" value='<?php echo $echeance; ?>' />
                    <br/>
                    <label for="infos"><u>Informations complémentaire :</u> </label>
                    <textarea class="infos" id="infos" name="infos" required="required" ><?php echo $infos; ?></textarea>
                    <br/>
                </fieldset>
                <fieldset>
                    <br/>
                    <legend>Adresse Livraison</legend>
                    <table id="dataTableAdresseLivraison" border="1">
                        <tbody>
                            <tr>
                                <p>
                                    <br/>
                                    <td>
                                        <label for="BX_adr1">Adresse 1: </label>
                                        <input type="text" class="adr1_l" name="BX_adr1" value='<?php echo $BX_adr1; ?> '/>
                                        <br/>

                                        <label for="BX_adr2">Adresse 2: </label>
                                        <input type="text" class="adr2_l" name="BX_adr2" value='<?php echo $BX_adr2; ?>' />
                                        <br/>

                                        <label for="BX_adr3">Adresse 3: </label>
                                        <input type="text" class="adr3_l" name="BX_adr3" value='<?php echo $BX_adr3; ?>' />
                                        <br/>

                                        <label for="BX_cp">Code Postal: </label>
                                        <input type="text" class="cp_l" name="BX_cp" value='<?php echo $BX_cp; ?>'/>
                                        <br/>

                                        <label for="BX_ville">Ville: </label>
                                        <input type="text" class="v_l" name="BX_ville" value='<?php echo $BX_ville; ?>' />
                                        <br/>
                                        <hr>
                                    </td>
                                    <td>
                                        <label for="BX_pays">Pays: </label>
                                        <input type="text" class="pays_l" name="BX_pays" value='<?php echo $BX_pays; ?>' />
                                        <br/>

                                        <label for="BX_tel_bur">Tel. Bureau: </label>
                                        <input type="text" class="telbur_l" name="BX_tel_bur" value='<?php echo $BX_tel_bur; ?> '/>
                                        <br/>

                                        <label for="BX_email">Email: </label>
                                        <input type="text" class="mail_l" name="BX_email" value='<?php echo $BX_email; ?>'/>
                                        <br/>

                                        <label for="BX_site_web">Site Web: </label>
                                        <input type="text" class="web_l" name="BX_site_web" value='<?php echo $BX_site_web;?>'/>
                                        <br/>
                                        <br/>
                                    </td>
                                </p>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset>
                    <br/>
                    <legend>Adresse Facturation</legend>
                    <table id="dataTableAdresseFacturation" border="1">
                        <tbody>
                            <tr>
                                <p>
                                    <br/>
                                    <td>
                                        <label for="BX_adr1_2">Adresse 1: </label>
                                        <input type="text" class="adr1_f" name="BX_adr1_2" value='<?php echo $BX_adr1_2; ?>' />
                                        <br />

                                        <label for="BX_adr2_2">Adresse 2: </label>
                                        <input type="text" class="adr2_f" name="BX_adr2_2" value='<?php echo $BX_adr2_2;?>'/>
                                        <br />

                                        <label for="BX_adr3_2">Adresse 3: </label>
                                        <input type="text" class="adr3_f" name="BX_adr3_2" value='<?php echo $BX_adr3_2; ?>'/>
                                        <br />

                                        <label for="BX_cp2">Code Postal: </label>
                                        <input type="text" class="cp_f" name="BX_cp2" value='<?php echo $BX_cp2; ?>' />
                                        <br/>

                                        <label for="BX_ville2">Ville: </label>
                                        <input type="text" class="ville_f" name="BX_ville2" value='<?php echo $BX_ville2; ?>'/>
                                        <br />
                                        <hr>
                                    </td>
                                    <td>
                                        <label for="BX_pays2">Pays: </label>
                                        <input type="text" class="pays_f" name="BX_pays2" value='<?php echo $BX_pays2; ?>'/>
                                        <br />

                                        <label for="BX_tel_bur2">Tel. Bureau: </label>
                                        <input type="text" class="telbur_f" name="BX_tel_bur2" value='<?php echo $BX_tel_bur2; ?>'/>
                                        <br />

                                        <label for="BX_email2">Email: </label>
                                        <input type="text" class="mail_f" name="BX_email2" value='<?php echo $BX_email2; ?>'/>
                                        <br/>

                                        <label for="BX_site_web2">Site Web: </label>
                                        <input type="text" class="web_f" name="BX_site_web2" value='<?php echo $BX_site_web2; ?> '/>
                                        <br/>

                                    </td>
                            </tr>
                        </tbody>
                    </table>

                </fieldset>
                <fieldset>
                    <br/>
                    <legend>Livraison</legend>
                    <label for="expedition">Expedition: </label>
                    <select name="expedition" required="required" onchange="change_manga(this.value)">
						<option value='<?php echo $expedition; ?>'><?php echo $expedition; ?></option>
                        <option value="Retrait">Retrait</option>
                        <option value="Chronopost">Chronopost</option>
                        <option value="TNT Express">TNT Express</option>
                        <option value="Exapaq">Exapaq</option>
                    </select>
                    <br/><br/>
                    <label for="colis">Nombre de colis: </label>
                    <input type="number" id="colis" name="colis" required="required" value="1" />
                    <br/>
                    <br/>
                </fieldset>
                <br/>
                <!-- Saisie des commandes -->

                <div class="CSSTableGenerator">
                    <table id="order-table" align="center">
                        <tbody id="tablco">
                            <tr>
                                <th>
                                    <input type="button" value="+" class="btn_newpics"></input>
                                </th>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Quantit&eacute;e</th>
                                <th>Prix</th>
                                <th>Remise</th>
                                <th style="text-align: right;">Total (&euro;)</th>
                            </tr>
							<!-- récup des commandes précédentes -->
							<?php
							if(isset($_POST) &&!empty($_POST)){
								$i=0;
								while($i<sizeof($_POST['format']))
								{
								 $pieces = explode("|", $_POST['format'][$i]);
								 if($i==0){ echo '<tr class="Ligne" id="default">';}
								 else { echo '<tr class="Ligne" id="suite">';}
									echo '<td class="supligne" style="text-align:center"> &nbsp';
										echo '<input type="button" class="btn-sup" value="-" style="width:30px align:center"> </input>';
									echo'</td>';
									echo'<td class="format">';
									   echo' <SELECT name="format[]" class="selected_format_input" style="width:100px">';
											echo '<OPTION selected="selected" VALUE="'.$_POST['format'][$i].'">'.$pieces[4].'</OPTION>';
											echo '<OPTION VALUE="0"></OPTION>';
											for($j=0;$j<sizeof($article);$j++) 
											{ 
												$chaine=$article[$j]['prix_ht']."|".$article[$j]['libelle']."|".$article[$j]['volume']."|".$article[$j]['poids']."|".$article[$j]['ref'];
												$reference=$article[$j]["ref"];
												echo '<OPTION VALUE="'.$chaine.'">'.$reference.'</OPTION>'; 
											}
										echo '</SELECT>';
									echo '</td>';
									echo'<td class="product-title">';
										echo'<textarea rows="3" cols="40" class="name-pics" name="namearticle[]">'.$_POST['namearticle'][$i].'</textarea>';
									echo'</td>';
									echo'<td class="num-pallets">';
										echo'<input type="number" step="any" min="0" name="qarticle[]" style="width:40px" class="num-pallets-input" value="'.$_POST['qarticle'][$i].'"></input>';
									echo'</td>';
									echo'<td class="prix_article">';
										echo'<input type="number" step="any" min="0" style="width:80px" name="prix_article[]" class="prix" value="'.$_POST['prix_article'][$i].'"></input>&euro;</td>';
									echo'<td class="remise_article">';
										echo'<input type="number" step="any" min="0" value="'.$_POST['rarticle'][$i].'" style="width:40px" name="rarticle[]" class="remise_article-input"></input>%';
									echo'</td>';
									echo'<td style="display:none;" class="Poids_article">';
										echo'<input type="number" step="any" min="0" name="poids_article[]" style="width:40px" class="poids" value="'.$_POST['poids_article'][$i].'" readonly></input> kg</td>';
									echo'<td style="display:none;" class="Volume_article">';
										echo'<input type="number" step="any" min="0" name="volume_article[]" style="width:40px" class="volume" value="'.$_POST['volume_article'][$i].'" readonly></input> m3</td>';
									echo '<td class="row-total">';
										echo '<input type="text" style="width:80px" name="prixtt_article[]" class="row-total-input" value="'.$_POST['prixtt_article'][$i].'" readonly></input>&euro;</td>';
									echo '<td style="display:none;" class="row-totalp">';
										echo '<input type="text" name="totalp_article[]" style="width:60px" class="row-totalp-input" value="'.$_POST['totalp_article'][$i].'" readonly></input>kg</td>';
									echo '<td style="display:none;" class="row-totalv">';
										echo '<input type="text" name="totalv_article[]" style="width:60px" class="row-totalv-input" value="'.$_POST['totalv_article'][$i].'" readonly></input>m3</td>';
								 echo'</tr>';
								$i++;
								}
							}
							else {?>
							    <tr class="Ligne" id="default">
                                <td class="supligne" style="text-align:center"> &nbsp
                                    <input type="button" class="btn-sup" value="-" style="width:30px align:center"> </input>
                                </td>
                                <td class="format">
                                    <SELECT name="format[]" class="selected_format_input" style="width:100px">
                                        <OPTION selected="selected" VALUE="0"></OPTION>
                                        <?php for($i=0;$i<sizeof($article);$i++) { echo "<OPTION VALUE='{$article[$i]['prix_ht']}|{$article[$i]['libelle']}|{$article[$i]['volume']}|{$article[$i]['poids']}|{$article[$i]['ref']}'>{$article[$i]['ref']}</OPTION>"; } ?>
                                    </SELECT>
                                </td>
                                <td class="product-title">
                                    <textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero de série" rows="3" cols="40" class="name-pics" name="namearticle[]"></textarea>
                                </td>
                                <td class="num-pallets">
                                    <input type="number" step="any" min="0" name="qarticle[]" style="width:40px" class="num-pallets-input"></input>
                                </td>
                                <!-- <td class="prix_article"><span name="prix_article[]" class="prix"></span>&euro;</td> -->
                                <td class="prix_article">
                                    <input type="number" step="any" min="0" style="width:80px" name="prix_article[]" class="prix"></input>&euro;</td>
                                <td class="remise_article">
                                    <input type="number" step="any" min="0" value="0" style="width:40px" name="rarticle[]" class="remise_article-input"></input>%
                                </td>
                                <td style="display:none;" class="Poids_article">
                                    <input type="number" step="any" min="0" name="poids_article[]" style="width:40px" class="poids" readonly></input> kg</td>
                                <td style="display:none;" class="Volume_article">
                                    <input type="number" step="any" min="0" name="volume_article[]" style="width:40px" class="volume" readonly></input> m3</td>
                                <td class="row-total">
                                    <input type="text" style="width:80px" name="prixtt_article[]" class="row-total-input" readonly></input>&euro;</td>
                                <td style="display:none;" class="row-totalp">
                                    <input type="text" name="totalp_article[]" style="width:60px" class="row-totalp-input" readonly></input>kg</td>
                                <td style="display:none;" class="row-totalv">
                                    <input type="text" name="totalv_article[]" style="width:60px" class="row-totalv-input" readonly></input>m3</td>
                            </tr>
							<?php
							}
							?>
							<!-- ligne pour commander -->
                            <tr class="Ligne" id="port">
                                <td class="supligne" style="text-align:center"> &nbsp
                                    <!-- <input type="button" class="btn-sup" value="-" style="width:30px align:center" hidden> </input> -->
                                </td>
                                <td class="format">
                                    <SELECT name="format[]" class="selected_format_input" style="width:100px" readonly>
                                        <OPTION selected="selected" VALUE="24.00.|Frais de port|0|0|IKA-PORT">IKA-PORT</OPTION>
                                    </SELECT>
                                </td>
                                <td class="product-title">
                                    <textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero de série" rows="3" cols="40" class="name-pics" name="namearticle[]" readonly>Frais de Port</textarea>
                                </td>
                                <td class="num-pallets">
                                    <input type="number" step="any" min="1" name="qarticle[]" style="width:40px" class="num-pallets-input" value="1" readonly></input>
                                </td>
                                <td class="prix_article">
                                    <input type="number" step="any" min="0" style="width:80px" name="prix_article[]" class="prix" value="24.00" ></input>&euro;</td>
                                <td class="remise_article">
                                    <input type="number" step="any" min="0" value="0" style="width:40px" name="rarticle[]" class="remise_article-input" value="0" readonly></input>%
                                </td>
                                <td style="display:none;" class="Poids_article">
                                    <input type="number" step="any" min="0" name="poids_article[]" style="width:40px" class="poids" value="0"readonly></input> kg</td>
                                <td style="display:none;" class="Volume_article">
                                    <input type="number" step="any" min="0" name="volume_article[]" style="width:40px" class="volume" value="0" readonly></input> m3</td>
                                <td class="row-total">
                                    <input type="text" style="width:80px" name="prixtt_article[]" class="row-total-input" value="24.00" readonly></input>&euro;</td>
                                <td style="display:none;" class="row-totalp">
                                    <input type="text" name="totalp_article[]" style="width:60px" class="row-totalp-input" value="0" readonly></input>kg</td>
                                <td style="display:none;" class="row-totalv">
                                    <input type="text" name="totalv_article[]" style="width:60px" class="row-totalv-input" value="0" readonly></input>m3</td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>

                    <div style="display:none;" class="TotalPoids" style="text-align: left;">
                        <span>  <b>TOTAL POIDS:</b> </span>
                        <input type="text" name="totalPoids" style="width:80px" class="total-poids" value='<?php echo $_POST['totalPoids']; ?>' id="product-poids" readonly></input>kg
                    </div>
                    <div style="display:none;" class="TotalVolume" style="text-align: left;">
                        <span> <b> TOTAL VOLUME: </b></span>
                        <input type="text" name="totalVolume" style="width:80px" class="total-volume" value='<?php echo $_POST['totalVolume']; ?>' id="product-volume" readonly></input>m3
                        <br />
                    </div>
                    <br/>
                    <div class="TotalHT" style="text-align: left;">
                        <span> <b> TOTAL HT: </b></span>
                        <?php $ht=($_POST['totalHT']+24.00); ?>
                        <input type="text" name="totalHT" style="width:80px" class="total-box" value='<?php echo number_format($ht,2); ?>' id="product-ht" readonly></input>&euro;
                        <br />
                    </div>

                    <div class="Total" style="text-align: left;">
                        <span> <b> TOTAL TTC:</b> </span>
                        <?php $ttc=($_POST['totalTTC']+28.80); ?>
                        <input type="text" style="width:80px" name="totalTTC" class="total-box" value='<?php echo number_format($ttc,2); ?>' id="product-subtotal" readonly></input>&euro;
                        <br />
                    </div>
                </div>

                <div class="TotalTVA" style="text-align: left;">
                    <span>  <b>DONT T.V.A:</b></span>
                    <?php $tva=($_POST['totalTVA']+4.80); ?>
                    <input type="text" class="total-box" style="width:80px" value='<?php echo number_format($tva,2); ?>' name="totalTVA" id="product-TVA" readonly></input>&euro;
                    <br />
                </div>
				
                <!-- Fin Saisie Commande -->
				<input type="checkbox" name="duplicata" value="Oui"> Marquer cette Facture en DUPLICATA ? </input>
                <center>
                   <!-- <input type="submit" name="valider" /> -->
				   <input type="button" onclick="quitter_sans_sauvegarde()" value="Annuler" />
				   <input type="button" onclick="quitter_avec_sauvegarde('traitement_facture.php')" value="Sauvegarder" />
				   <input type="button" onclick="submitForm('facture_pdf.php')" value="Imprimer Facture" />
                </center>
            </form>
    </section>
    </div>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>