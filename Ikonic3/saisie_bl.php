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
    <script type='text/javascript' src='Inclusion/order.js'></script>
	<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
        document.getElementById('form1').submit();
    }
	function quitter_sans_sauvegarde() {
	  if (confirm("Quitter sans sauvegarder ?")) {
	   window.location.href = "http://iuted.bugs3.com/projet/Ikonic3/";
      }
	}
	function quitter_avec_sauvegarde() {
	  if (confirm("Quitter et sauvegarder ce bon de livraison ?")) {
	   	  alert("en construction");
	  }
	}
</script>

    <title>Ikonic: Saisie d'un BL</title>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(1); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Saisie d'un bon de livraison</h1>
        <br/>
        <br/>

        <?php if (isset($_GET[ 'err'])) { if ($_GET[ 'err']=='err1' ) { echo "<center><p style='color:red;'>Le code client doit être de la forme : 9, puis une lettre, puis 4 chiffres (ex : 9L0015) !</center><br><br>"; } if ($_GET[ 'err']=='err2' ) { echo "<center><p style='color:red;'>Le code client existe déjà !</center><br><br>"; } } $liste=array(); connexion(); $sql='Select * from client' ; $requete=mysql_query($sql); while($result=mysql_fetch_array($requete)) { $liste[]=$result[ 'code']; } $sql2="SELECT * FROM article " ; $execute2=mysql_query($sql2) or die( 'Erreur au niveau de la requete'.mysql_error()); $article=array(); $i=0; while($data2=mysql_fetch_array($execute2)) { $article[$i]=$data2; $i++; } ?>

        <div id="formu_contact">
            <form method="post" action="bl_pdf.php" id="form1">
                <br/>
                <label for="numero_bl"><u>N°BL :</u> </label>
                <input type="text" id="numero_bl" name="numero_bl" required="required" />

                <fieldset>
                    <br/>
                    <legend>Bon de livraison</legend>
                    <label for="date">Date : </label>
                    <input type="date" name="date" id="date" maxlength="6" required="required" value="<?php echo date('Y-m-d'); ?>" />
                    <br/>
                    <label for="ref_client"><u>Référence du client :</u> </label>
                    <input type="text" id="ref_client" name="ref_client" required="required" />
                    <br/>
                    <label for="ref_fournisseur"><u>Référence du fournisseur :</u> </label>
                    <input type="text" id="ref_fournisseur" name="ref_fournisseur" required="required" />
                    <br/>

                    <label for="code_client"><u>Code Client :</u> </label>
                    <input type="text" id="code_client" name="code_client" class="cc" onkeyup="myFunction()" />
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
                    <input type="text" class="nom_commercial" id="nom_commercial" name="nom_commercial" required="required" />
                    <br/>
                    <label for="mode_reglement"><u>Mode de règlement :</u> </label>
                    <input type="text" class="mode_reglement" id="mode_reglement" name="mode_reglement" required="required" />
                    <br/>
                    <label for="echeance"><u>Echeance :</u> </label>
                    <input type="text" class="echeance" id="echeance" name="echeance" required="required" />
                    <br/>
                    <label for="infos"><u>Informations complémentaire :</u> </label>
                    <textarea class="infos" id="infos" name="infos" required="required"></textarea>
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
                                        <input type="text" class="adr1_l" name="BX_adr1" />
                                        <br/>

                                        <label for="BX_adr2">Adresse 2: </label>
                                        <input type="text" class="adr2_l" name="BX_adr2" />
                                        <br/>

                                        <label for="BX_adr3">Adresse 3: </label>
                                        <input type="text" class="adr3_l" name="BX_adr3" />
                                        <br/>

                                        <label for="BX_cp">Code Postal: </label>
                                        <input type="text" class="cp_l" name="BX_cp" />
                                        <br/>

                                        <label for="BX_ville">Ville: </label>
                                        <input type="text" class="v_l" name="BX_ville" />
                                        <br/>
                                        <hr>
                                    </td>
                                    <td>
                                        <label for="BX_pays">Pays: </label>
                                        <input type="text" class="pays_l" name="BX_pays" />
                                        <br/>

                                        <label for="BX_tel_bur">Tel. Bureau: </label>
                                        <input type="text" class="telbur_l" name="BX_tel_bur" />
                                        <br/>

                                        <label for="BX_email">Email: </label>
                                        <input type="text" class="mail_l" name="BX_email" />
                                        <br/>

                                        <label for="BX_site_web">Site Web: </label>
                                        <input type="text" class="web_l" name="BX_site_web" />
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
                                        <input type="text" class="adr1_f" name="BX_adr1_2" />
                                        <br />

                                        <label for="BX_adr2_2">Adresse 2: </label>
                                        <input type="text" class="adr2_f" name="BX_adr2_2" />
                                        <br />

                                        <label for="BX_adr3_2">Adresse 3: </label>
                                        <input type="text" class="adr3_f" name="BX_adr3_2" />
                                        <br />

                                        <label for="BX_cp2">Code Postal: </label>
                                        <input type="text" class="cp_f" name="BX_cp2" />
                                        <br/>

                                        <label for="BX_ville2">Ville: </label>
                                        <input type="text" class="ville_f" name="BX_ville2" />
                                        <br />
                                        <hr>
                                    </td>
                                    <td>
                                        <label for="BX_pays2">Pays: </label>
                                        <input type="text" class="pays_f" name="BX_pays2" />
                                        <br />

                                        <label for="BX_tel_bur2">Tel. Bureau: </label>
                                        <input type="text" class="telbur_f" name="BX_tel_bur2" />
                                        <br />

                                        <label for="BX_email2">Email: </label>
                                        <input type="text" class="mail_f" name="BX_email2" />
                                        <br/>

                                        <label for="BX_site_web2">Site Web: </label>
                                        <input type="text" class="web_f" name="BX_site_web2" />
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
                        <option value="Retrait">Retrait</option>
                        <option value="Chronopost">Chronopost</option>
                        <option value="TNT Express">TNT Express</option>
                        <option value="Exapaq">Exapaq</option>
                    </select>
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
                                    <input type="button" value="Ajouter article" class="btn_newpics" style="width:100px"></input>
                                </th>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Quantit&eacute;e</th>
                                <th>Prix</th>
                                <th>Remise</th>
                                <th>Poids</th>
                                <th>Volume</th>
                                <th style="text-align: right;">Total (&euro;)</th>
                                <th style="text-align: right;">Total (kg)</th>
                                <th style="text-align: right;">Total (m3)</th>

                            </tr>
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
                                    <input type="number" step="any" min="0" style="width:40px" name="prix_article[]" class="prix"></input>&euro;</td>
                                <td class="remise_article">
                                    <input type="number" step="any" min="0" value="0" style="width:40px" name="rarticle[]" class="remise_article-input"></input>%
                                </td>
                                <td class="Poids_article">
                                    <input type="number" step="any" min="0" name="poids_article[]" style="width:40px" class="poids" readonly></input> kg</td>
                                <td class="Volume_article">
                                    <input type="number" step="any" min="0" name="volume_article[]" style="width:40px" class="volume" readonly></input> m3</td>
                                <td class="row-total">
                                    <input type="text" style="width:60px" name="prixtt_article[]" class="row-total-input" readonly></input>&euro;</td>
                                <td class="row-totalp">
                                    <input type="text" name="totalp_article[]" style="width:60px" class="row-totalp-input" readonly></input>kg</td>
                                <td class="row-totalv">
                                    <input type="text" name="totalv_article[]" style="width:60px" class="row-totalv-input" readonly></input>m3</td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>

                    <div class="TotalPoids" style="text-align: left;">
                        <span>  <b>TOTAL POIDS:</b> </span>
                        <input type="text" name="totalPoids" style="width:80px" class="total-poids" value="0" id="product-poids" readonly></input>kg
                    </div>
                    <div class="TotalVolume" style="text-align: left;">
                        <span> <b> TOTAL VOLUME: </b></span>
                        <input type="text" name="totalVolume" style="width:80px" class="total-volume" value="0" id="product-volume" readonly></input>m3
                        <br />
                    </div>
                    <br/>
                    <div class="TotalHT" style="text-align: left;">
                        <span> <b> TOTAL HT: </b></span>
                        <input type="text" name="totalHT" style="width:80px" class="total-box" value="0&euro;" id="product-ht" readonly></input>&euro;
                        <br />
                    </div>

                    <div class="Total" style="text-align: left;">
                        <span> <b> TOTAL TTC:</b> </span>
                        <input type="text" style="width:80px" name="totalTTC" class="total-box" value="0&euro;" id="product-subtotal" readonly></input>&euro;
                        <br />
                    </div>
                </div>

                <div class="TotalTVA" style="text-align: left;">
                    <span>  <b>DONT T.V.A:</b></span>
                    <input type="text" class="total-box" style="width:80px" value="0&euro;" name="totalTVA" id="product-TVA" readonly></input>&euro;
                    <br />
                </div>

                <!-- Fin Saisie Commande -->
				<input type="checkbox" name="duplicata" value="Oui"> Marquer ce BL en DUPLICATA ? </input>
                <center>
                   <!-- <input type="submit" name="valider" /> -->
				   <input type="button" onclick="submitForm('saisie_facture.php')" value="Transformer en facture" />
				   <input type="button" onclick="quitter_sans_sauvegarde()" value="Annuler" />
				   <input type="button" onclick="quitter_avec_sauvegarde()" value="Sauvegarder" />
				   <input type="button" onclick="submitForm('bl_pdf.php')" value="Imprimer BL" />
                </center>
            </form>
    </section>
    </div>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>