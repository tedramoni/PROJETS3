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
    <style type="text/css">
        #element3 tbody tr td {
          text-align: center;
           padding: 10px 10px;
        }
    </style>

    <title>Ikonic: Modification d'une Facture</title>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(4);
        
        function change_format_date($dateAchanger)
        {
            $array_date=explode('/', $dateAchanger);
            $date_modifie=$array_date[2]."-".$array_date[1]."-".$array_date[0];
            return $date_modifie;
        }?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Modification d'une facture</h1>
        <br/>
        <br/>
        <?php
            $connexion=connexionI();
            $requetefact = mysqli_query($connexion, "SHOW TABLE STATUS LIKE 'factures'");
            $datafact = mysqli_fetch_array($requetefact);
            $nextId = $datafact['Auto_increment'];  
            if (($nextId-1)==$_GET['num_facture']) {
                
        ?>

        <center><script>
            function verif()
            {
                var a=confirm('Etes vous sûr d\'annuler cette facture?'); 
                if(a==true){
                    window.location.href ="modif_facture.php?supp=<?php echo $_GET['num_facture']; ?>";
                }
                else
                {
                 alert('Votre demande n\'a pas été traitée.');
                }
             }
        </script>
        <?php
            $sql="SELECT * FROM factures WHERE num_facture=".$_GET['num_facture'];
            $requete=mysqli_query($connexion,$sql);
            $data=mysqli_fetch_array($requete);
            if($data['annule']!=1)
            {

        ?>
        <a href="#" style="border-bottom:1px dotted red;color:red;" onclick="verif();"> Voulez-vous annuler cette facture?</a><br/>
        <?php }echo "</center>"; }
        if(isset($_GET['supp']))
        {
            $sql_supp="UPDATE factures SET annule=1 WHERE num_facture=".$_GET['supp'].";";
            mysqli_query($connexion,$sql_supp) or die(mysqli_error($connexion));
            header('Location:factures.php?modif_facture='.$_GET['modif_facture']);
        }
        ?>

    <?php
        $liste = array();
        $connexion=connexionI();
        $sql = 'Select * from client';
        $requete = mysqli_query($connexion,$sql);

        while ($result = mysqli_fetch_array($requete))
        {
            $liste[] = $result['code'];
        }

        $sql2 = "SELECT * FROM article ";
        $execute2 = mysqli_query($connexion,$sql2) or die('Erreur au niveau de la requete' . mysqli_error($connexion));
        $article = array();
        $i = 0;

        while ($data2 = mysqli_fetch_array($execute2))
        {
            $article[$i] = $data2;
            $i++;
        }
         $sql="SELECT * FROM factures WHERE num_facture=".$_GET['num_facture'];
         $requete=mysqli_query($connexion,$sql);
         $data=mysqli_fetch_array($requete);
         if($data['annule']==1)
         {
            echo "<center><h2>Cette facture a été annulée. </h2></center>";
         }


?>
        <div id="formu_contact">
            <form method="post" action="" id="form1">
                <br/>
				<label for="numero_f">N°Facture : </label>
                <input type="text" id="numero_f" name="numero_f" required="required" value="<?php echo $data['num_facture'];?>"/><br/>
				
                <label for="numero_bl">N°BL : </label>
                <input type="text" id="numero_bl" name="numero_bl" required="required" readonly="readonly" value="<?php echo $data['num_bl'];?>"/>

                <fieldset>
                    <br/>
                    <legend>Bon de livraison</legend>
                    <label for="date">Date : </label>
                    <input class="datepicker form-control" name="date" id="date" required="required" type="text" value="<?php echo $data['date']?>"/>
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
                    <label for="ref_client">Référence du client : </label>
                    <input type="text" id="ref_client" name="ref_client" required="required" value='<?php echo $data['ref_client']; ?>' />
                    <br/>
                    <label for="ref_fournisseur">Référence du fournisseur : </label>
                    <input type="text" id="ref_fournisseur" name="ref_fournisseur" required="required" value='<?php echo $data['ref_fournisseur']; ?>' />
                    <br/>

                    <label for="code_client">Code Client : </label>
                    <input type="text" id="code_client" name="code_client" class="cc" onkeyup="myFunction()" value='<?php echo $data['code_client']; ?>'/>
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

                    <label for="nom_commercial">Nom Commercial : </label>
                    <input type="text" class="nom_commercial" id="nom_commercial" name="nom_commercial" required="required" value='<?php echo $data['nom_commercial']; ?> '/>
                    <input type="hidden" class="raison_social" id="raison_social" name="raison_social" required="required" value='<?php echo $data['raison_sociale']; ?> '/>
                     <br/>
                    <label for="acompte">Acompte versé: </label>
                    <input type="number" class="acompte" id="acompte" name="acompte" required="required" value='<?php echo $data['acompte']; ?>'/>
                    <br/>
                    <label for="mode_reglement">Mode de règlement : </label>
                    <input type="text" class="mode_reglement" id="mode_reglement" name="mode_reglement" required="required" value='<?php echo $data['mode_reglement']; ?>'/>
                    <br/>
                    <label for="echeance">Echeance : </label>
                    <input type="text" class="echeance" id="echeance" name="echeance" required="required" value='<?php echo $data['date_echeance']; ?>' />
                    <br/>
                    <label for="infos">Informations complémentaire : </label>
                    <textarea class="infos" id="infos" name="infos" required="required" ><?php echo $data['info_comp']; ?></textarea>
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
                                        <input type="text" class="adr1_l" name="BX_adr1" value='<?php echo $data['adr1_L']; ?> '/>
                                        <br/>

                                        <label for="BX_adr2">Adresse 2: </label>
                                        <input type="text" class="adr2_l" name="BX_adr2" value='<?php echo $data['adr2_L']; ?>' />
                                        <br/>

                                        <label for="BX_adr3">Adresse 3: </label>
                                        <input type="text" class="adr3_l" name="BX_adr3" value='<?php echo $data['adr3_L']; ?>' />
                                        <br/>

                                        <label for="BX_cp">Code Postal: </label>
                                        <input type="text" class="cp_l" name="BX_cp" value='<?php echo $data['cp_L']; ?>'/>
                                        <br/>

                                        <label for="BX_ville">Ville: </label>
                                        <input type="text" class="v_l" name="BX_ville" value='<?php echo $data['ville_L']; ?>' />
                                        <br/>
                                        
                                    </td>
                                    <td>
                                        <label for="BX_pays">Pays: </label>
                                        <input type="text" class="pays_l" name="BX_pays" value='<?php echo $data['pays_L']; ?>' />
                                        <br/>

                                        <label for="BX_tel_bur">Tel. Bureau: </label>
                                        <input type="text" class="telbur_l" name="BX_tel_bur" value='<?php echo $data['tel_bureau_L']; ?> '/>
                                        <br/>

                                        <label for="BX_email">Email: </label>
                                        <input type="text" class="mail_l" name="BX_email" value='<?php echo $data['mail_L']; ?>'/>
                                        <br/>

                                        <label for="BX_site_web">Site Web: </label>
                                        <input type="text" class="web_l" name="BX_site_web" value='<?php echo $data['site_web_L'];?>'/>
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
                                        <input type="text" class="adr1_f" name="BX_adr1_2" value='<?php echo $data['adr1_F']; ?>' />
                                        <br />

                                        <label for="BX_adr2_2">Adresse 2: </label>
                                        <input type="text" class="adr2_f" name="BX_adr2_2" value='<?php echo $data['adr2_F'];?>'/>
                                        <br />

                                        <label for="BX_adr3_2">Adresse 3: </label>
                                        <input type="text" class="adr3_f" name="BX_adr3_2" value='<?php echo $data['adr3_F']; ?>'/>
                                        <br />

                                        <label for="BX_cp2">Code Postal: </label>
                                        <input type="text" class="cp_f" name="BX_cp2" value='<?php echo $data['cp_F']; ?>' />
                                        <br/>

                                        <label for="BX_ville2">Ville: </label>
                                        <input type="text" class="ville_f" name="BX_ville2" value='<?php echo $data['ville_F']; ?>'/>
                                        <br />
                                        
                                    </td>
                                    <td>
                                        <label for="BX_pays2">Pays: </label>
                                        <input type="text" class="pays_f" name="BX_pays2" value='<?php echo $data['pays_F']; ?>'/>
                                        <br />

                                        <label for="BX_tel_bur2">Tel. Bureau: </label>
                                        <input type="text" class="telbur_f" name="BX_tel_bur2" value='<?php echo $data['tel_bureau_F']; ?>'/>
                                        <br />

                                        <label for="BX_email2">Email: </label>
                                        <input type="text" class="mail_f" name="BX_email2" value='<?php echo $data['email_F']; ?>'/>
                                        <br/>

                                        <label for="BX_site_web2">Site Web: </label>
                                        <input type="text" class="web_f" name="BX_site_web2" value='<?php echo $data['site_web_F']; ?> '/>
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
                        <?php
                            $tab_exp=array("Retrait","Chronopost","TNT Express","Exapaq");
                            $type_exp=$data['type_expedition'];
                            foreach ($tab_exp as $i ) {
                                if($i==$type_exp)
                                    echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                                else
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            
                        ?>
                    </select>
                    <br/><br/>
                    <label for="colis">Nombre de colis: </label>
                    <input type="number" id="colis" name="colis" value='<?php echo $data['nbre_colis']; ?>' required="required" value="1" />
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
                                    <input type="hidden" value="+" class="btn_newpics"></input>
                                </th>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Quantit&eacute;e</th>
                                <th>Prix</th>
                                <th>Remise</th>
                                <th style="text-align: right;">Total (&euro;)</th>
                            </tr>
                            <?php
                                $liste_article=explode('**',$data['liste_articles']);
                                //print_r($liste_article);
                                $liste_champs=explode('|',$liste_article[1]);
                                //print_r($liste_champs);
                                for($i=0;$i<sizeof($liste_article);$i++)
                                {
                                    $champs = explode('|',$liste_article[$i]);
                                    if($i==0){ 
                                        echo '<tr class="Ligne" id="default">';
                                    }
                                    else { 
                                    echo '<tr class="Ligne" id="suite">';
                                    }
                            ?>
                                <td class="supligne" style="text-align:center;"> &nbsp
                                    <input type="hidden" class="btn-sup" value="-" style="width:30px align:center"/>
                                </td>
                                <td class="format">
                                    <SELECT name="format[]" class="selected_format_input" style="width:100px">
                                        <OPTION selected="selected" VALUE="<?php echo $liste_article[$i];?>"><?php echo $champs[4];?></OPTION>
                                        <?php for($j=0;$j<sizeof($article);$j++) { echo "<OPTION VALUE='{$article[$j]['prix_ht']}|{$article[$j]['libelle']}|{$article[$j]['volume']}|{$article[$j]['poids']}|{$article[$j]['ref']}|{$article[$i]['nbre_stock']}'>{$article[$j]['ref']}</OPTION>"; } ?>
                                        <?php echo $article['IKE-64N6E'];?>
                                    </SELECT>
                                </td>
                                <td class="product-title">
                                    <textarea placeholder="Libellé de l'article &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero de série" rows="3" cols="40" class="name-pics" name="namearticle[]"><?php echo $champs[1]?></textarea>
                                </td>
                                <td class="num-pallets">
                                    <input type="number" step="any" min="0" name="qarticle[]" style="width:40px" class="num-pallets-input" value="<?php echo $champs[2];?>" readonly/>
                                </td>
                                <!-- <td class="prix_article"><span name="prix_article[]" class="prix"></span>&euro;</td> -->
                                <td class="prix_article">
                                    <input type="number" step="any" min="0" style="width:80px" value="<?php echo $champs[3];?>" name="prix_article[]" class="prix"/>&euro;</td>
                                <td class="remise_article">
                                    <input type="number" step="any" min="0" style="width:40px" value="<?php echo $champs[0];?>" name="rarticle[]" class="remise_article-input"/>%
                                </td>
                                <td style="display:none;" class="Poids_article">
                                    <input type="number" step="any" min="0" value="<?php echo $champs[5];?>" name="poids_article[]" style="width:40px" class="poids" readonly/> kg</td>
                                <td style="display:none;" class="Volume_article">
                                    <input type="number" step="any" min="0" value="<?php echo $champs[6];?>" name="volume_article[]" style="width:40px" class="volume" readonly/> m3</td>
                                <td class="row-total">
                                    <input type="text" style="width:80px" value="<?php echo $champs[7];?>" name="prixtt_article[]" class="row-total-input" readonly/>&euro;</td>
                                <td style="display:none;"class="row-totalp">
                                    <input type="text" name="totalp_article[]" value="<?php echo $champs[8];?>" style="width:60px" class="row-totalp-input" readonly/>kg</td>
                                <td style="display:none;"class="row-totalv">
                                    <input type="text" name="totalv_article[]" value="<?php echo $champs[9];?>" style="width:60px" class="row-totalv-input" readonly/>m3</td>
                            </tr>
                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                        </div>
                    <br/>

                    <div style="display:none;" class="TotalPoids" style="text-align: left;">
                        <span>  <b>TOTAL POIDS:</b> </span>
                        <input type="text" name="totalPoids" style="width:80px" class="total-poids" value='<?php echo $data['poids_total']; ?>' id="product-poids" readonly></input>kg
                    </div>
                    <div style="display:none;" class="TotalVolume" style="text-align: left;">
                        <span> <b> TOTAL VOLUME: </b></span>
                        <input type="text" name="totalVolume" style="width:80px" class="total-volume" value='<?php echo $data['volume_total']; ?>' id="product-volume" readonly></input>m3
                        <br />
                    </div>
                        <?php $ht=($data['prix_ht']); $ttc=($data['prix_ttc']);  $tva=($data['tva']); ?>
                         <div id="element3">
                        <table>
                            <tr style="background-color: #c9dff0;">
                                <td>Total HT</td>
                                <td>Total TTC</td>
                                <td>Dont T.V.A</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="totalHT" style="width:80px" class="total-box" value='<?php echo $ht; ?>' id="product-ht" readonly/></td>
                                <td><input type="text" style="width:80px" name="totalTTC" class="total-box" value='<?php echo $ttc; ?>' id="product-subtotal" readonly/></td>
                                <td><input type="text" class="total-box" style="width:80px" value='<?php echo $tva; ?>' name="totalTVA" id="product-TVA" readonly/></td>
                            </tr>
                        </table>
				        </div>
                <!-- Fin Saisie Commande -->
				
                   <!-- <input type="submit" name="valider" /> -->
                   <?php
                   if($data['annule']==1)
                   {
                    ?>
                <?php
                   }
                   else
                   {

                    ?>
                    <input type="checkbox" name="duplicata" value="Oui"> Marquer cette Facture en DUPLICATA ? </input>
                    <center>
                    <a onclick="quitter_sans_sauvegarde()" class="button grey">Annuler</a>
                    <a onclick="quitter_avec_sauvegarde('update_facture.php')" class="button grey">Modifier</a>
                    <a onclick="submitForm('facture_pdf.php')" class="button grey">Imprimer Facture</a>
                    <?php } ?>
                </center>
            </form>
    </section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>