<?php
// RAMONI Ted, ZOUHIRI Malik, COUDRAY Ugo, AZZA Nordine
// Version 1.00
//
// Ikonic www.ikonic.fr
// 
// Exemple de g�n�ration de bon de livraison PDF
//

require('bl_template.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->SetAutoPageBreak('on','1');
$pdf->addSociete( "logo/ikonic.png",
				  "IKONIC",
                  "15 rue du Buisson aux Fraises\n" .
                  "91300 MASSY\n",
                  "01.69.30.22.22",
				  "01.69.20.00.33",
				  "info@ikonic.fr",
				  "www.ikonic.fr");
$pdf->fact_dev( "141074");
$pdf->addDate( "30/10/2014");
$pdf->addClient("Nouveau client","Monsieur Rolland", "115 rue de Nantes","75015 PARIS","FRANCE");
$pdf->addReference("4978","28/10/14","890");
$cols=array( "R�f�rence"    => 40,
             "D�signation"  => 130,
             "Qt�"     => 20);
$pdf->addCols( $cols);
$cols=array( "R�f�rence"    => "C",
             "D�signation"  => "J",
             "Qt�"     => "C");
$pdf->addLineFormat($cols);

$y    = 115;

$line = array( "R�f�rence"    => "IKE-08HBS",
               "D�signation"  => "DVR 8 voies, 8x25 IPS @ 2CIF, VGA+HDMI\n" .
                                 "SN : 7514552",
               "Qt�"     => "1" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 6;

$line = array( "R�f�rence"    => "IKE-DD2000",
               "D�signation"  => "Disque dur 2TO SV35\n" .
                                 "SN : mk0013",
               "Qt�"     => "1" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 6;
$pdf->addCadreColis("1", "EXAPAQ", "15kg");
$pdf->addNomSignature();
$pdf->addPiedPage("IKONIC - SARL au capital de 300 000 � inscrite au RC EVRY - N� siret 34796918000020 - APE 6201Z - Identification TVA FR 51 347 969 180");
$pdf->Output();
?>