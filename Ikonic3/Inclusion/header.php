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
		if($i==1){
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
                <li><a href="saisie_bl.php">BL</a></li>
                <li><a href="saisie_facture.php">Facturation</a></li>
                <li><a href="#">Paramètres</a></li>
            </ul>
<?php
	}
?>

    
    
                
                    
