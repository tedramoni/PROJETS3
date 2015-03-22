<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" type="text/css" href="css/feuille_de_style.css" />
    <link rel="stylesheet" type="text/css" href="css/TableCSSCode2.css" />
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

    <title>Ikonic: Modification d'un BL</title>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(3); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Modification d'un bon de livraison</h1>
        <br/>
        <br/>

        <?php  
            $connexion=connexionI(); 
            $sql='Select * from client'; 
            $requete=mysqli_query($connexion,$sql);
            $liste=array(); 
            //Recuperer les codes client pour l'autocompletion.
            while($result=mysqli_fetch_array($requete)) 
            { 
                $liste[]=$result['code']; 
            }
            
            $sql2="SELECT * FROM article "; 
            $execute2=mysqli_query($connexion,$sql2) or die( 'Erreur au niveau de la requete: '.mysql_error()); 
            $article=array(); 
            $i=0; 
            while($data2=mysqli_fetch_array($execute2)) 
            { 
                $article[$i]=$data2;
                $i++;
            }
            $sql="SELECT * FROM bon_livraison WHERE num_bl=".$_GET['num_bl'];
            $requete=mysqli_query($connexion,$sql);
            $data=mysqli_fetch_array($requete);
        ?>

        <div id="formu_contact">
            <form method="post" action="" id="form1" .target="_blank">
                <br/>
                <label for="numero_bl"><u>N°BL :</u> </label>
                <input type="text" id="numero_bl" name="numero_bl" required="required" value="<?php echo $data['num_bl'];?>"/>

                <fieldset>
                    <br/>
                    <legend>Bon de livraison</legend>
                    <label for="date">Date : </label>
                    <input class="datepicker form-control" name="date" id="date" required="required" type="text" value="<?php echo $data['date']; ?>"/>
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
                    <input type="text" id="ref_client" name="ref_client" value="<?php echo $data['ref_client']; ?>" required="required" />
                    <br/>
                    <label for="ref_fournisseur">Référence du fournisseur :</label>
                    <input type="text" id="ref_fournisseur" name="ref_fournisseur" value="<?php echo $data['ref_fournisseur']; ?>" required="required" />
                    <br/>

                    <label for="code_client">Code Client : </label>
                    <input type="text" id="code_client" name="code_client" value="<?php echo $data['code_client']; ?>" class="cc" onkeyup="myFunction()" />
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
                    <input type="text" class="nom_commercial" id="nom_commercial" name="nom_commercial" value="<?php echo $data['nom_commercial']; ?>" required="required" />

                    <input type="hidden" class="raison_social" id="raison_social" name="raison_social" required="required" />
                    <input type="hidden" class="remise" id="remise" name="remise" required="required" value="0" />
                    <br/>
                    <label for="acompte">Acompte versé: </label>
                    <input type="number" style="width:100px" step="any" min="0" value="<?php echo $data['acompte']; ?>" id="acompte" name="acompte" value="0" /> &euro;
                    <br/>
                    <label for="mode_reglement">Mode de règlement : </label>
                    <input type="text" class="mode_reglement" id="mode_reglement" name="mode_reglement" value="<?php echo $data['mode_reglement']; ?>" required="required" />
                    <br/>
                    <label for="echeance">Echeance : </label>
                    <input type="text" class="echeance" id="echeance" name="echeance" value="<?php echo $data['echeance']; ?>" required="required" />
                    <br/>
                    <label for="fdm">F.D.M: </label>
                    <?php
                        if($data['fdm']==1)
                        {
                            echo ' <input type="checkbox" checked="checked" name="fdm" /><br/>';
                        }
                        else
                        {
                            echo '<input type="checkbox" name="fdm" /><br/>';
                        }
                    ?>
                    <label for="jour">le:  </label><input type="number"  name="jour" min="1" max="31" value="<?php echo $data['jour']; ?>"  /><br/>

                    <label for="infos">Informations complémentaire : </label>
                    <textarea class="infos" id="infos" name="infos" required="required"><?php echo $data['info_comp']; ?></textarea>
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
                                        <input type="text" class="adr1_l" value="<?php echo $data['adr1_L']; ?>" name="BX_adr1" />
                                        <br/>

                                        <label for="BX_adr2">Adresse 2: </label>
                                        <input type="text" class="adr2_l" value="<?php echo $data['adr2_L']; ?>" name="BX_adr2" />
                                        <br/>

                                        <label for="BX_adr3">Adresse 3: </label>
                                        <input type="text" class="adr3_l" value="<?php echo $data['adr3_L']; ?>" name="BX_adr3" />
                                        <br/>

                                        <label for="BX_cp">Code Postal: </label>
                                        <input type="text" class="cp_l" value="<?php echo $data['cp_L']; ?>" name="BX_cp" />
                                        <br/>

                                        <label for="BX_ville">Ville: </label>
                                        <input type="text" class="v_l" value="<?php echo $data['ville_L']; ?>" name="BX_ville" />
                                        <br/>
                                    </td>
                                    <td>
                                        <label for="BX_pays">Pays: </label>
                                        <input type="text" class="pays_l" value="<?php echo $data['pays_L']; ?>" name="BX_pays" />
                                        <br/>

                                        <label for="BX_tel_bur">Tel. Bureau: </label>
                                        <input type="text" class="telbur_l" value="<?php echo $data['tel_bureau_L']; ?>" name="BX_tel_bur" />
                                        <br/>

                                        <label for="BX_email">Email: </label>
                                        <input type="text" class="mail_l" value="<?php echo $data['email_L']; ?>" name="BX_email" />
                                        <br/>

                                        <label for="BX_site_web">Site Web: </label>
                                        <input type="text" class="web_l" value="<?php echo $data['site_web_L']; ?>" name="BX_site_web" />
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
                                
                                    <br/>
                                    <td>
                                        <label for="BX_adr1_2">Adresse 1: </label>
                                        <input type="text" class="adr1_f" value="<?php echo $data['adr1_F']; ?>" name="BX_adr1_2" />
                                        <br />

                                        <label for="BX_adr2_2">Adresse 2: </label>
                                        <input type="text" class="adr2_f" value="<?php echo $data['adr2_F']; ?>" name="BX_adr2_2" />
                                        <br />

                                        <label for="BX_adr3_2">Adresse 3: </label>
                                        <input type="text" class="adr3_f" value="<?php echo $data['adr3_F']; ?>" name="BX_adr3_2" />
                                        <br />

                                        <label for="BX_cp2">Code Postal: </label>
                                        <input type="text" class="cp_f" value="<?php echo $data['cp_F']; ?>" name="BX_cp2" />
                                        <br/>

                                        <label for="BX_ville2">Ville: </label>
                                        <input type="text" class="ville_f" value="<?php echo $data['ville_F']; ?>" name="BX_ville2" />
                                        <br />
                                    </td>
                                    <td>
                                        <label for="BX_pays2">Pays: </label>
                                        <input type="text" class="pays_f" value="<?php echo $data['pays_F']; ?>" name="BX_pays2" />
                                        <br />

                                        <label for="BX_tel_bur2">Tel. Bureau: </label>
                                        <input type="text" class="telbur_f" value="<?php echo $data['tel_bureau_F']; ?>" name="BX_tel_bur2" />
                                        <br />

                                        <label for="BX_email2">Email: </label>
                                        <input type="text" class="mail_f" value="<?php echo $data['email_F']; ?>" name="BX_email2" />
                                        <br/>

                                        <label for="BX_site_web2">Site Web: </label>
                                        <input type="text" class="web_f" value="<?php echo $data['site_web_F']; ?>" name="BX_site_web2" />
                                        <br/>

                                    </td>
                            </tr>
                        </tbody>
                    </table>

                </fieldset>
                <fieldset>
                    <br/>
                    <legend>Livraison</legend>
                    <label for="expedition">Expedition : </label>
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
                    <input type="number" id="colis" name="colis" value="<?php echo $data['nbre_colis']; ?>" required="required" value="1" />
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
                                    <input type="button" value="+" class="btn_newpics"/>
                                </th>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Quantit&eacute;e</th>
                                <th>Prix</th>
                                <th>Remise</th>
                                <th style="text-align: right;">Total (&euro;)</th>
                            </tr>

                            <?php
                                echo $data['liste_articles']."<br/>";
                                $liste_article=explode('/',$data['liste_articles']);
                                echo $liste_article;
                                $i=0;
                                while($i<5)
                                {
                                    $pieces = explode("|", $liste_article[$i]);
                            ?>
                            <tr class="Ligne" id="default">
                                <td class="supligne" style="text-align:center;"> &nbsp
                                    <input type="button" class="btn-sup" value="-" style="width:30px align:center"/>
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
                            <?php
                                $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                    <br/><br/>
                    <div id="element2">
                        <fieldset>
                            <legend>Informations Article</legend>
                            Article: <toto id="iarticle" for="ArticleInfos"></toto><br/>
                            Poids: <toto id="ipoids" for="PoidsInfos"></toto><br/>
                            Volume: <toto id="ivolume" for="VolumeInfos"></toto><br/>
                            Quantité en stock: -<br/>
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
                   <input type="button" onclick="submitForm('saisie_facture.php')" value="Transformer en facture" />
                   <input type="button" onclick="submitForm('bl_pdf.php')" value="Imprimer BL" />
                </center>
            </form>
    </section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>
