<?php
// RAMONI Ted, ZOUHIRI Malik, COUDRAY Ugo, AZZA Nordine
// Version 1.00
//
// Ikonic www.ikonic.fr
// 
// Exemple de génération de devis/facture PDF
//
if(isset($_POST))
{
	require('facture_template.php');
	include( "Inclusion/gestion.php");
	setlocale(LC_MONETARY, 'fr_FR');
	$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
	$pdf->AddPage();
	if($_POST['duplicata'] == 'Oui'){
		$pdf->temporaire( "DUPLICATA" );
	}
	$pdf->SetAutoPageBreak('on','1');
	$pdf->addSociete( "logo/ikonic.png",
					  "IKONIC",
					  "15 rue du Buisson aux Fraises\n" .
					  "91300 MASSY\n",
					  "01.69.30.22.22",
					  "01.69.20.00.33",
					  "info@ikonic.fr");
	$pdf->fact_dev($_POST['numero_f']);
	$pdf->addDate($_POST['date']);
	$pdf->addClient($_POST['code_client']);
	$pdf->addClientAdresseLivraison(utf8_decode($_POST['raison_social']),utf8_decode($_POST['nom_commercial']),utf8_decode($_POST['BX_adr1_2']." ".$_POST['BX_adr2_2']." ".$_POST['BX_adr3_2']),$_POST['BX_cp2']." ".$_POST['BX_ville2'],utf8_decode($_POST['BX_pays2']),utf8_decode($_POST['BX_adr1']." ".$_POST['BX_adr2']." ".$_POST['BX_adr3']),$_POST['BX_cp']." ".$_POST['BX_ville'],utf8_decode($_POST['BX_pays']));
	$pdf->addReference($_POST['ref_client'],$_POST['ref_fournisseur']);	
	$cols=array( "Référence"    => 30,
				 "Désignation"  => 90,
				 "Qté"     => 10,
				 "P.U."      => 20,
				 "Rem.%" => 16,
				 "Montant HT"          => 24 );
	$pdf->addCols( $cols);
	$cols=array( "Référence"    => "C",
				 "Désignation"  => "L",
				 "Qté"     => "C",
				 "P.U."      => "R",
				 "Rem.%" => "R",
				 "Montant HT" => "R" );
	$pdf->addLineFormat($cols);

    $y = 109;
	if($_POST['numero_bl']!=""){
		$connexion=connexionI();
	    $sql = 'Select date from bon_livraison WHERE num_bl='.$_POST['numero_bl'];
	    $requete = mysqli_query($connexion,$sql);
	    $date_bl=mysqli_fetch_array($requete);
		$line = array( "Référence"    => " ",
					   "Désignation"  => "*** Bon de livraison n°".$_POST['numero_bl']." du ".$date_bl[0]." ***",
					   "Qté"     => " ",
					   "P.U."      => " ",
					   "Rem.%" => " ",
					   "Montant HT" => " " );
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 10;
	}
	
		$nbCommande=sizeof($_POST['qarticle']);
		$reference=array();
		$chaine=$_POST['format'];
		$nbArticle=sizeof($chaine);
		for($i=0;$i<$nbArticle;$i++)
		{
			$pieces = explode("|", $chaine[$i]);
			$reference[$i]=$pieces[4];
		}
		$designation=$_POST['namearticle'];
		$quantité=$_POST['qarticle'];
		$pu=$_POST['prix_article'];
		$remise=$_POST['rarticle'];
		$prix_ht=$_POST['prixtt_article'];
		$total=array_sum ( $quantité );
		$totalPort=0;
		$bool='false';
		for($i=0;$i<$nbCommande;$i++){
			if($reference[$i]=="IKA-PORT"){
				$totalPort=$pu[$i];
			}
		}

		for($i=0;$i<$nbCommande;$i++){
			if($i>=7 && $bool=='false') {
				$bool='true';
				$pdf->AddPage();
				$cols=array( "Référence"    => 30,
							 "Désignation"  => 90,
							 "Qté"     => 10,
							 "P.U."      => 20,
							 "Rem.%" => 16,
							 "Montant HT"          => 24 );
				$pdf->addCols2( $cols);
				$cols=array( "Référence"    => "C",
							 "Désignation"  => "L",
							 "Qté"     => "C",
							 "P.U."      => "R",
							 "Rem.%" => "R",
							 "Montant HT" => "R" );
				$pdf->addLineFormat($cols);

				$y    = 35;
				if($_POST['duplicata'] == 'Oui'){
					$pdf->temporaire( "DUPLICATA" );
				}
			}
			$line = array(	 "Référence"    => $reference[$i],
							 "Désignation"  => utf8_decode($designation[$i]),
							 "Qté"     => $quantité[$i],
							 "P.U."      => money_format('%!.2n', $pu[$i]),
							 "Rem.%" => $remise[$i],
							 "Montant HT"  => money_format('%!.2n', $prix_ht[$i]));
			$size = $pdf->addLine( $y, $line );
			$y   += $size + 6;					   
		}
	$pdf->addFraisPort("1500");
	$pdf->addReglementEcheance($_POST['mode_reglement'],$_POST['echeance']);
	$pdf->addCadrePaiement(money_format('%!.2n', $totalPort),money_format('%!.2n', $_POST['totalHT']),money_format('%!.2n', $_POST['totalTVA']),money_format('%!.2n', $_POST['totalTTC']),money_format('%!.2n', $_POST['acompte']),money_format('%!.2n', $_POST['totalTTC']-$_POST['acompte']));
	$pdf->addPiedPage("IKONIC - SARL au capital de 300 000 € inscrite au RC EVRY - N° siret 34796918000020 - APE 6201Z - Identification TVA FR 51 347 969 180");
	$pdf->Output();
}
?>