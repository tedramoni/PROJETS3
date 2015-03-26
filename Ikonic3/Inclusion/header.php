<?php
	function actif($i)
	{
?>
<ul id="nav">
    <li><a href="index.html">Home</a></li>
<?php
		if($i==1)
		{
?>
			<li class="active"><a href="client.php">Client</a>
<?php			
		}
		else
		{
?>
			<li><a href="client.php">Client</a>
<?php
		}
?>
                    <ul class="subs">
                        <li><a href="client.php">Client</a>
                            <ul>
                                <li><a href="client.php">Listing des clients</a></li>
                                <li><a href="ajout_client.php">Ajouter un client</a></li>
                            </ul>
                        </li>

                    </ul></li>
<?php
		if($i!=2){
			echo '<li><a href="article.php">Article</a>';
		}
		if($i==2)
		{
?>
		<li class="active"><a href="article.php">Article</a>
<?php
	}
?>
<span id="s2"></span>
                    <ul class="subs">
                        <li><a href="article.php">Article</a>
                            <ul>
                                <li><a href="article.php">Listing des articles</a></li>
                                <li><a href="ajout_article.php">Ajouter un article</a></li>
                                <li><a href="appro.php">L'historique des approvisionnements</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
<?php
				if($i==3)
				{
					echo "<li class=\"active\"><a href=\"bl.php\">BL</a>";
				}
				else
				{
?>
                <li><a href="bl.php">BL</a>
<?php
                }
?>
                    <ul class="subs">
                        <li><a href="article.php">Bon de livraison</a>
                            <ul>
                                <li><a href="bl.php">Listing des BLs</a></li>
                                <li><a href="saisie_bl.php">Ajouter un BL</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
<?php
				
				if($i==4)
				{
					echo "<li class=\"active\"><a href=\"factures.php\">Facturation</a>";
				}
				else
				{
					echo "<li><a href=\"factures.php\">Facturation</a>";
				}
?>
                    <ul class="subs">
                        <li><a href="factures.php">Factures</a>
                            <ul>
                                <li><a href="factures.php">Listing des factures</a></li>
                                <li><a href="saisie_facture.php">Ajouter une facture</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
<?php
				if($i==5)
				{
					echo "<li class=\"active\"><a href=\"parametres.php\">Paramètres</a></li>";
				}
				else
				{
?>
                <li><a href="parametres.php">Paramètres</a></li>
<?php
				}
?>
            </ul>
<?php
	}
?>

    
    
                
                    
