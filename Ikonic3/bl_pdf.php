<?php
	if(isset($_POST))
	{

		require('bl_template.php');

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
						  "info@ikonic.fr",
						  "www.ikonic.fr");
		$pdf->fact_dev($_POST['numero_bl']);
		$pdf->addDate($_POST['date']);
		
		$pdf->addClient(utf8_decode($_POST['raison_social']),utf8_decode($_POST['nom_commercial']),utf8_decode($_POST['BX_adr1']." ".$_POST['BX_adr2']." ".$_POST['BX_adr3']),$_POST['BX_cp']." ".$_POST['BX_ville'],utf8_decode($_POST['BX_pays']));
		$pdf->addReference($_POST['ref_client'],$_POST['ref_fournisseur']);
		$cols=array( "Référence"    => 40,
					 "Désignation"  => 130,
					 "Qté"     => 20);
		$pdf->addCols( $cols);
		$cols=array( "Référence"    => "C",
					 "Désignation"  => "J",
					 "Qté"     => "C");
		$pdf->addLineFormat($cols);

		$y    = 115;

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
		$total=array_sum ( $quantité );
		$bool='false';
		for($i=0;$i<$nbCommande;$i++){
			if($i>=9 && $bool=='false') {
				$bool='true';
				$pdf->AddPage();
				$cols=array( "Référence"    => 40,
							 "Désignation"  => 130,
							 "Qté"     => 20);
				$pdf->addCols2( $cols);
				$cols=array( "Référence"    => "C",
							 "Désignation"  => "J",
							 "Qté"     => "C");
				$pdf->addLineFormat($cols);
				$y    = 35;
				if($_POST['duplicata'] == 'Oui'){
					$pdf->temporaire( "DUPLICATA" );
				}
			}
			$line = array( "Référence"    => $reference[$i],
							   "Désignation"  => utf8_decode($designation[$i]),
							   "Qté"     => $quantité[$i] );
			$size = $pdf->addLine( $y, $line );
			$y   += $size + 6;					   
		}

		$pdf->addCadreColis($_POST['colis'], $_POST['expedition'], $_POST['totalPoids']."kg");
		$pdf->addNomSignature();
		$pdf->addPiedPage("IKONIC - SARL au capital de 300 000 € inscrite au RC EVRY - N° siret 34796918000020 - APE 6201Z - Identification TVA FR 51 347 969 180");
		$pdf->Output();
	}
?>