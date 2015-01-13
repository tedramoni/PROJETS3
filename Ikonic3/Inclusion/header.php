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
			<li class="active"><a href="client.php">Client</a></li>
<?php			
		}
		else
		{
?>
			<li><a href="client.php">Client</a></li>
<?php
		}
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
                <li><a href="#">BL</a></li>
                <li><a href="#">Facturation</a></li>
                <li><a href="#">Paramètres</a></li>
            </ul>
<?php
	}
?>

    
    
                
                    
