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

    <title>Ikonic: Flush</title>
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
            width:300px;
            border:1px dotted black;
        }
    </style>

</head>


<body>
    <section>
        <?php include( "Inclusion/gestion.php"); include( "Inclusion/header.php"); actif(4); ?>
        <br/>
        <br/>
        <h1 style="padding-top: 55px; text-align:center;">Flush</h1>
        
     <br/><br/>
     <?php
        //Récupération de la liste des codes clients et des noms des commerciales pour l'autocompletion.
        $connexion=connexionI();
        $sql = 'DELETE FROM factures WHERE num_facture>0;';
        $sql2 = 'DELETE FROM bon_livraison WHERE num_bl>0;';
        if(isset($_GET['supp_bl']))
        {
             $requete2=mysqli_query($connexion,$sql2);

        }
        if(isset($_GET['supp_facture']))
        {
             $requete2=mysqli_query($connexion,$sql);

        }
     ?>
     <center>
         <a href="flush.php?supp_bl=all" >Supprimer tous les BLs</a><?php espace(10); ?>
         <a href="flush.php?supp_facture=all" >Supprimer toutes les factures</a>

     </center>
    </section>

    <?php include( "Inclusion/bottom.php"); ?>
</body>

</html>