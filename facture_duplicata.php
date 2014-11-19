<?php
// RAMONI Ted, ZOUHIRI Malik, COUDRAY Ugo, AZZA Nordine
// Version 1.00
//
// Ikonic www.ikonic.fr
// 
// Exemple de génération de devis/facture PDF
//

require('facture_template.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->temporaire( "DUPLICATA" );
$pdf->SetAutoPageBreak('on','1');
$pdf->addSociete( "logo/ikonic.png",
				  "IKONIC",
                  "15 rue du Buisson aux Fraises\n" .
                  "91300 MASSY\n",
                  "01.69.30.22.22",
				  "01.69.20.00.33",
				  "info@ikonic.fr");
$pdf->fact_dev( "141063");
$pdf->addDate( "30/10/2014");
$pdf->addClient("9C0025");
$pdf->addClientAdresseLivraison("Nouveau client","115 rue de Nantes","75015 PARIS","FRANCE");
$pdf->addFraisPort("1500");
$pdf->addReglementEcheance("Chèque à 30 jours","29/11/2014");
$pdf->addReference("4978","28/10/14","890");
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

$y    = 109;
$line = array( "Référence"    => " ",
               "Désignation"  => "*** Bon de livraison n°141047 du 30/10/2014 ***",
               "Qté"     => " ",
               "P.U."      => " ",
               "Rem.%" => " ",
               "Montant HT" => " " );
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "Référence"    => "IKE-08HBS",
               "Désignation"  => "DVR 8 voies, 8x25 IPS @ 2CIF, VGA+HDMI\n" .
                                 "SN : 7514552",
               "Qté"     => "1",
               "P.U."      => "350.00",
               "Rem.%" => "10.00",
               "Montant HT"          => "315.00" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 6;

$line = array( "Référence"    => "IKE-DD2000",
               "Désignation"  => "Disque dur 2TO SV35\n" .
                                 "SN : mk0013",
               "Qté"     => "1",
               "P.U."      => "140",
               "Rem.%" => "10.00",
               "Montant HT"          => "414.00" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 6;
$pdf->addCadrePaiement("0,00","729.00","291.6","1020.60","0.00","1020.60");
$pdf->addPiedPage("IKONIC - SARL au capital de 300 000 € inscrite au RC EVRY - N° siret 34796918000020 - APE 6201Z - Identification TVA FR 51 347 969 180");
$pdf->Output();
?>