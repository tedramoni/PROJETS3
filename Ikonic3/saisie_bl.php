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
    <style type="text/css">
        #element2 {
            float:right;
        }

        #element3 tbody tr td {
          text-align: center;
           padding: 10px 10px;
        }
    </style>
	<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
		document.getElementById('form1').target="_blank";
        document.getElementById('form1').submit();
    }
	function submitForm2(action1,action2)
    {
        document.getElementById('form1').action = action1;
		document.getElementById('form1').target="_blank";
        document.getElementById('form1').submit();
		
		document.getElementById('form1').action = action2;
        document.getElementById('form1').target="_self";
        document.getElementById('form1').submit();
    }
	
	function quitter_sans_sauvegarde() {
	  if (confirm("Quitter sans sauvegarder ?")) {
	   window.location.href = "http://iuted.bugs3.com/projet/Ikonic3/bl.php";
      }
	}
	function quitter_avec_sauvegarde(action) {
        document.getElementById('form1').action = action;
        document.getElementById('form1').target="_self";
        document.getElementById('form1').submit();
	}
	
</script>
<style type="text/css">
    #element2 {float:right;}

</style>

    <title>Ikonic: Saisie d'un BL</title>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(3); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Saisie d'un bon de livraison</h1>
        <br/>
        <br/>

        <?php 

            $liste=array(); 
            $connexion=connexionI(); 
            $sql='Select * from client' ; 
            $requete=mysqli_query($connexion,$sql); 
            while($result=mysqli_fetch_array($requete)) 
            { 
                $liste[]=$result[ 'code']; 
            }
            $sql2="SELECT * FROM article "; 
            $execute2=mysqli_query($connexion,$sql2) or die( 'Erreur au niveau de la requete'.mysqli_error()); 
            $article=array(); 
            $i=0; 
            while($data2=mysqli_fetch_array($execute2)) 
            { 
                $article[$i]=$data2; 
                $i++; 
            }
            $sql="SELECT MAX(num_bl) FROM bon_livraison";
            $requete=mysqli_query($connexion,$sql) or die( 'Erreur au niveau de la requete: max(num_bl): '.mysqli_error()); 
            $data=mysqli_fetch_array($requete);
        ?>
        <div id="formu_contact">
            <form method="post" action="" id="form1">
                <br/>
                <label for="numero_bl">N°BL : </label>
                <input type="text" id="numero_bl" name="numero_bl" required="required" value="<?php echo $data[0]+1;?>" />

                <fieldset>
                    <br/>
                    <legend>Bon de livraison</legend>
                    <label for="date">Date : </label>
                    <input class="datepicker form-control" name="date" id="date" required="required" type="text" value="<?php echo date('d/m/Y'); ?>"/>
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
                    <!-- <input type="date" name="date" id="date" required="required" value="<?php echo date('dd/mm/yyyy'); ?>" /> -->
                    <br/>
                    <label for="ref_client">Référence du client : </label>
                    <input type="text" id="ref_client" name="ref_client" required="required" />
                    <br/>
                    <label for="ref_fournisseur">Référence du fournisseur : </label>
                    <input type="text" id="ref_fournisseur" name="ref_fournisseur" required="required" />
                    <br/>

                    <label for="code_client">Code Client : </label>
                    <input type="text" id="code_client" name="code_client" class="cc" onkeyup="myFunction()" />
					<input type="button" value="Charger données client" class="btn_load_client" style="width:200px" />
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

                    <label for="nom_commercial">Nom Commercial : </label>
                    <input type="text" class="nom_commercial" id="nom_commercial" name="nom_commercial" required="required" />
                    <input type="hidden" class="raison_social" id="raison_social" name="raison_social" required="required" />
                    <input type="hidden" class="remise" id="remise" name="remise" required="required" value="0" />
                    <br/>
                    <label for="acompte">Acompte versé: </label>
                    <input type="number" style="width:100px" step="any" min="0" id="acompte" name="acompte" value="0" /> &euro;
                    <br/>
                    <label for="mode_reglement">Mode de règlement : </label>
                    <input type="text" class="mode_reglement" id="mode_reglement" name="mode_reglement" required="required" />
                    <br/>
                    <label for="echeance">Echeance :</label>
                    <input type="text" class="echeance" id="echeance" name="echeance" required="required" />
                    <br/>
                    <label for="fdm">F.D.M: </label><input type="checkbox" id="fdm" class="fdm" name="fdm" /><br/>
                    <label for="jour">le:  </label><input type="number" class="jour" name="jour" min="1" max="31" /><br/>

                    <label for="infos">Informations complémentaires : </label>
                    <textarea class="infos" id="infos" name="infos" required="required"></textarea>
                    <br/>
                </fieldset>
                <fieldset>
                    <br/>
                    <legend>Adresse Livraison</legend>
                        <strong><label for="choixLivraison">Choisir une adresse: </label></strong>
                        <SELECT id="selectLivraison" name="selectLivraison" class="selected_livraison_input" style="width:700px"> <OPTION selected="selected" VALUE="">Selectionner une autre adresse que celle par défaut.</OPTION></SELECT> <br/><br/>
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
                        <strong><label for="choixFacturation">Choisir une adresse: </label></strong>
                        <SELECT id="selectFacturation" name="selectFacturation" class="selected_facturation_input" style="width:700px"> <OPTION selected="selected" VALUE="">Selectionner une autre adresse que celle par défaut.</OPTION></SELECT> <br/><br/>
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
                                    <input type="button" value="+" class="btn_newpics" />
                                </th>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Quantit&eacute;e</th>
                                <th>Prix</th>
                                <th>Remise</th>
                                <th style="text-align: right;">Total (&euro;)</th>
                            </tr>
                            <tr class="Ligne" id="default">
                                <td class="supligne" style="text-align:center"> &nbsp
                                    <input type="button" class="btn-sup" value="-" style="width:30px align:center"/>
                                </td>
                                <td class="format">
                                    <SELECT name="format[]" class="selected_format_input" style="width:100px">
                                        <OPTION selected="selected" VALUE="0"></OPTION>
                                        <?php for($i=0;$i<sizeof($article);$i++) { echo "<OPTION VALUE='{$article[$i]['prix_ht']}|{$article[$i]['libelle']}|{$article[$i]['volume']}|{$article[$i]['poids']}|{$article[$i]['ref']}|{$article[$i]['nbre_stock']}'>{$article[$i]['ref']}</OPTION>"; } ?>
                                    </SELECT>
                                </td>
                                <td class="product-title">
                                    <textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero de série" rows="3" cols="40" class="name-pics" name="namearticle[]"></textarea>
                                </td>
                                <td class="num-pallets">
                                    <input type="number" step="any" min="0" name="qarticle[]" style="width:40px" class="num-pallets-input"/>
                                </td>
                                <!-- <td class="prix_article"><span name="prix_article[]" class="prix"></span>&euro;</td> -->
                                <td class="prix_article">
                                    <input type="number" step="any" min="0" style="width:80px" name="prix_article[]" class="prix"/>&euro;</td>
                                <td class="remise_article">
                                    <input type="number" step="any" min="0" value="0" style="width:40px" name="rarticle[]" class="remise_article-input"/>%
                                </td>
                                <td style="display:none;" class="Poids_article">
                                    <input type="number" step="any" min="0" name="poids_article[]" style="width:40px" class="poids" readonly/> kg</td>
                                <td style="display:none;" class="Volume_article">
                                    <input type="number" step="any" min="0" name="volume_article[]" style="width:40px" class="volume" readonly/> m3</td>
                                <td class="row-total">
                                    <input type="text" style="width:80px" name="prixtt_article[]" class="row-total-input" readonly/>&euro;</td>
                                <td style="display:none;"class="row-totalp">
                                    <input type="text" name="totalp_article[]" style="width:60px" class="row-totalp-input" readonly/>kg</td>
                                <td style="display:none;"class="row-totalv">
                                    <input type="text" name="totalv_article[]" style="width:60px" class="row-totalv-input" readonly/>m3</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <br/><br/><br/>

                    <div id="element2">
                        <fieldset>
                            <legend>Informations Article</legend>
                            Article: <toto id="iarticle" for="ArticleInfos"></toto><br/>
                            Poids: <toto id="ipoids" for="PoidsInfos"></toto><br/>
                            Volume: <toto id="ivolume" for="VolumeInfos"></toto><br/>
                            Quantité en stock: <toto id="istock" for="StockInfos"></toto><br/>
                        </fieldset>
                    </div>
                    <div id="element3">
                    <table>
                        <tr style="background-color: #c9dff0;">
                            <td>Poids total(kg)</td>
                            <td>Volume total(m3)</td>
                            <td>Total HT (€)</td>
                            <td>Total TTC(€)</td>
                            <td>Dont T.V.A(€)</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="totalPoids" style="width:80px" class="total-poids" value="<?php echo $data['poids_total']; ?>" id="product-poids" readonly /></td>
                            <td><input type="text" name="totalVolume" style="width:80px" class="total-volume" value="<?php echo $data['volume_total']; ?>" id="product-volume" readonly /></td>
                            <td><input type="text" name="totalHT" style="width:80px" class="total-box" value="<?php echo $data['prix_ht']; ?>;" id="product-ht" readonly /></td>
                            <td><input type="text" style="width:80px" name="totalTTC" class="total-box" value="<?php echo $data['prix_ttc']; ?>" id="product-subtotal" readonly /></td>
                            <td><input type="text" class="total-box" style="width:80px" value="0" name="totalTVA" id="product-TVA" readonly /></td>
                        </tr>
                    </table>
                    </div>
                <!-- Fin Saisie Commande -->
                Afficher ce BL avec la mention DUPLICATA? <input type="checkbox" name="duplicata" value="Oui"/> <br/><br/>
                <center>
                   <!-- <input type="submit" name="valider" /> -->
                   <a onclick="submitForm2('traitement_bl.php','saisie_facture.php')" class="button grey">Transformer en facture</a>
                   <a onclick="quitter_sans_sauvegarde()" class="button grey">Annuler</a>
                   <a onclick="quitter_avec_sauvegarde('traitement_bl.php')" class="button grey">Sauvegarder</a>
                   <a onclick="submitForm('bl_pdf.php')" class="button grey">Imprimer BL</a>
                </center>
            </form>
    </section>
    </div>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>