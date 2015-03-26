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

    <title>Ikonic: Factures</title>
    <style>
            #element3 tbody tr td {
          text-align: center;
           padding: 10px 10px;
       }
    </style>
    <style type="text/css">
        #design_tableau td{
            padding-left:30px;
            padding-right:30px;
            text-align: center;
        } 
        #design_tableau{
            margin:auto; 
        }
        #design_tableau tr:hover{
            background-color:#8BD57C;
            color:white;
        }
        #prix input[type=number] {
            width:50px;
        }
        #prix{
            width:600px;
        }
    </style>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(4); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 20px; text-align:center;">Factures</h1><br/>
     <?php
        //Récupération de la liste des codes clients et des noms des commerciales pour l'autocompletion.
        $liste=array();
        $liste2=array();
        $liste3=array();
        $connexion=connexionI();
        $sql = 'Select * from client';
        $requete=mysqli_query($connexion,$sql);
        while($result=mysqli_fetch_array($requete))
        {
            $liste[]=$result['code'];
            $liste2[]=$result['nom_commercial'];
            $liste3[]=$result['raison_sociale'];
        }


     ?>
    <center>
        <form method="post" action="">
         Du: <input type="date" id="date_debut" name="date_debut" />
        au <input type="date" id="date_fin" name="date_fin" /> <?php espace(10);?>
        <input type="text" id="recherche_code" name="recherche_code" placeholder="Code client" onkeyup="myFunction('code')"/>
        <input type="text" id="recherche_commercial" name="recherche_commercial" placeholder="Commercial" onkeyup="myFunction('commercial')"/>
        <input type="text" id="recherche_raison" name="recherche_raison" placeholder="Raison sociale" onkeyup="myFunction('raison_sociale')"/>
        <br/><br/>
        <div id="prix">
        Prix min: <input type="number" min="0"name="prix_min"/>  Prix max: <input type="number" min="0" name="prix_max" /><?php espace(10);?>
                <input type="submit" name="ok" />

        </div>
        </form>
            <script>
        //AUTO-COMPLETION
        $('#recherche_code').autocomplete();
        var liste = <?php echo json_encode($liste) ?>;
            
        $('#recherche_code').autocomplete({
            source : liste
        });
        
        $('#recherche_commercial').autocomplete();
        var liste2 = <?php echo json_encode($liste2) ?>;
            
        $('#recherche_commercial').autocomplete({
            source : liste2
        });

        $('#recherche_raison').autocomplete();
        var liste3 = <?php echo json_encode($liste3) ?>;
            
        $('#recherche_raison').autocomplete({
            source : liste3
        });
          
        </script>
    </center><br/><br/>


    <div class="CSSTableGenerator">
        <table id="design_tableau">
            <tr class="tab_article_couleur">
                <td>Date</td>
                <td>N°facture</td>
                <td>N°BL</td>
                <td>Client</td>
                <td>Raison sociale</td>
                <td>Montant HT</td>
                <td>Montant TTC</td>
                <td>Commercial</td>
            </tr>
            <?php
                function change_format_date($dateAchanger)
                {
                    $array_mois=array("Jan.", "Fev.","Mars","Avr.","Mai","Juin","Juil.","Août","Sept.","Oct.","Nov.","Dec.");
                    $array_date=explode('-', $dateAchanger);
                    $date_modifie=$array_date[2]." ".$array_mois[$array_date[1]-1]." ".$array_date[0];
                    return $date_modifie;
                }
                $connexion=connexionI();
                $sql="SELECT * FROM factures ";
                $sql_total_ttc="SELECT sum(prix_ttc) FROM factures WHERE annule!=1 ";
                $sql_total_ht="SELECT sum(prix_ht) FROM factures WHERE annule!=1 ";
                if(isset($_POST['ok']))
                {
                    $sql.="WHERE code_client like '%".$_POST['recherche_code']."%' AND nom_commercial like '%".$_POST['recherche_commercial']."%' AND raison_sociale like '%".$_POST['recherche_raison']."%' ";
                    $sql_total_ttc.="AND code_client like '%".$_POST['recherche_code']."%' AND nom_commercial like '%".$_POST['recherche_commercial']."%' AND raison_sociale like '%".$_POST['recherche_raison']."%' ";
                    $sql_total_ht.="AND code_client like '%".$_POST['recherche_code']."%' AND nom_commercial like '%".$_POST['recherche_commercial']."%' AND raison_sociale like '%".$_POST['recherche_raison']."%' ";
                    if(!empty($_POST['date_debut']) and !empty($_POST['date_fin']))
                    {
                        $sql.=" AND date between '".$_POST['date_debut']."' AND '".$_POST['date_fin']."'"; 
                         $sql_total_ttc.=" AND date between '".$_POST['date_debut']."' AND '".$_POST['date_fin']."'"; 
                          $sql_total_ht.=" AND date between '".$_POST['date_debut']."' AND '".$_POST['date_fin']."'"; 

                    }
                    if(!empty($_POST['prix_min']))
                    {
                        $sql.=" AND prix_ttc>=".$_POST['prix_min'];
                        $sql_total_ttc.=" AND prix_ttc>=".$_POST['prix_min'];
                        $sql_total_ht.=" AND prix_ttc>=".$_POST['prix_min'];
                    }
                    if(!empty($_POST['prix_max']))
                    {
                        $sql.=" AND prix_ttc<=".$_POST['prix_max'];
                        $sql_total_ttc.=" AND prix_ttc<=".$_POST['prix_max'];
                        $sql_total_ht.=" AND prix_ttc<=".$_POST['prix_max'];

                    }
					
				}
				 $sql.=" ORDER BY date DESC, num_facture DESC";

                $requete=mysqli_query($connexion,$sql) or die(mysqli_error($connexion));
                while($data=mysqli_fetch_array($requete))
                {
                    if($data['annule']==1)
                    {
                        echo "<tr style='background-color: #FBABAB;'><td>".change_format_date($data['date'])."</td>";
                    }
                    else
                    {
                        echo "<tr><td>".change_format_date($data['date'])."</td>";
                    }
                    echo "<td><a href='modif_facture.php?num_facture=".$data['num_facture']."'>".$data['num_facture']."</a></td>";
                    if($data['num_bl']=="")
                    {
                        echo "<td>No BL</td>";
                    }
                    else
                    {
                        echo "<td><a href='modif_bl.php?num_bl=".$data['num_bl']."'>".$data['num_bl']."</a></td>";
                    }
                    echo "<td>".$data['code_client']."</td>";
                    echo "<td>".$data['raison_sociale']."</td>";
                    echo "<td>".$data['prix_ht']." €</td>";
                    echo "<td>".$data['prix_ttc']." €</td>";
                    echo "<td>".$data['nom_commercial']."</td></tr>";
                }

                setlocale(LC_MONETARY, 'fr_FR');
                $requete_tcc=mysqli_fetch_array(mysqli_query($connexion,$sql_total_ttc));
                $requete_ht=mysqli_fetch_array(mysqli_query($connexion,$sql_total_ht));
                $ttc=$requete_tcc[0];
                $ht=$requete_ht[0];


    ?>
    </table></div>
    <br/><center>    
        <div id="element3">
                    <table>
                        <tr style="background-color: #c9dff0;">
                            <td>Total HT(€)</td>
                            <td>Total TTC(€)</td>
                        </tr>
                        <tr>
                            <td><?php echo money_format('%!.2n', $ht); ?></td>
                            <td><?php echo money_format('%!.2n', $ttc); ?></td>
                        </tr>
                    </table>
    </div>
</center><br/>
    <center><a href="saisie_facture.php"><button type="button" onClick="">Ajouter une facture</button></a></center>

    </section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>