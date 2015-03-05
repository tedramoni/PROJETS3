<?php
require('fpdf.php');
define('EURO', chr(128) );
define('EURO_VAL', 6.55957 );

// RAMONI Ted, ZOUHIRI Malik, COUDRAY Ugo, AZZA Nordine
// Version 1.00
//
// Ikonic www.ikonic.fr
// 
// Permet de générer un bon de livraison
// 

//////////////////////////////////////
// fonctions à utiliser (publiques) //
//////////////////////////////////////
//  function sizeOfText( $texte, $larg )
//  function addSociete( $nom, $adresse )
//  function fact_dev( $libelle, $num )
//  function addFacture( $numfact )
//  function addDate( $date )
//  function addClient( $client, $nom, $adresse, $cp, $pays  )
//  function addReference($ref)
//  function addCols( $tab )
//  function addLineFormat( $tab )
//  function lineVert( $tab )
//  function addLine( $ligne, $tab )
//  function addPiedPage($societe)
//  function addCadreColis($nb, $expedition, $poids)
//  function addNomSignature()

class PDF_Invoice extends FPDF
{
// variables privées
var $colonnes;
var $format;
var $angle=0;

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
    $h = $this->h;
    $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
                        $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

function Rotate($angle, $x=-1, $y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}

// fonctions publiques
function sizeOfText( $texte, $largeur )
{
    $index    = 0;
    $nb_lines = 0;
    $loop     = TRUE;
    while ( $loop )
    {
        $pos = strpos($texte, "\n");
        if (!$pos)
        {
            $loop  = FALSE;
            $ligne = $texte;
        }
        else
        {
            $ligne  = substr( $texte, $index, $pos);
            $texte = substr( $texte, $pos+1 );
        }
        $length = floor( $this->GetStringWidth( $ligne ) );
        $res = 1 + floor( $length / $largeur) ;
        $nb_lines += $res;
    }
    return $nb_lines;
}

// Cette fonction affiche en haut, a gauche,
// le logo de l'entreprise
// le nom de la societe dans la police Arial-12-Bold
// les coordonnees de la societe dans la police Arial-10
function addSociete($logo, $nom, $adresse, $tel, $fax, $courriel, $site  )
{
    //Ajout du logo
	$this->Image($logo,9,1,40);
	$x1 = 10;
    $y1 = 48;
	//Positionnement en bas
    $this->SetXY( $x1, $y1 );
    $this->SetFont('Arial','B',12);
    $length = $this->GetStringWidth( $nom );
    $this->Cell( $length, 2, $nom);
    $this->SetXY( $x1, $y1 + 4 );
    $this->SetFont('Arial','',10);
    $length = $this->GetStringWidth( $adresse );
    //Coordonnées de la société
    $lignes = $this->sizeOfText( $adresse, $length) ;
    $this->MultiCell($length, 4, $adresse);
	//Tel de la société
	$this->SetXY( $x1, $y1 + 14 );
	$tel='Tél : '.$tel;
    $length = $this->GetStringWidth($tel);
	$this->Cell( $length, 4, $tel);
	//Fax de la Société
	$this->SetXY( $x1, $y1 + 18 );
	$fax='Fax : '.$fax;
    $length = $this->GetStringWidth( $fax);
	$this->Cell( $length, 4, $fax);
	//Courriel de la Société
	$this->SetXY( $x1, $y1 + 22 );
	$courriel='Courriel : '.$courriel;
    $length = $this->GetStringWidth( $courriel);
	$this->Cell( $length, 4, $courriel);
	//Site de la Société
	$this->SetXY( $x1, $y1 + 26 );
	$site='Site : '.$site;
    $length = $this->GetStringWidth( $site);
	$this->Cell( $length, 4, $site);
}

// Affiche en haut, a droite le libelle
// (FACTURE, DEVIS, Bon de commande, etc...)
// et son numero
// La taille de la fonte est auto-adaptee au cadre
function fact_dev($num)
{
    $r1  = $this->w -95;
    $r2  = $r1 + 68;
    $y1  = 10;
    $y2  = $y1 + 2;
    $mid = ($r1 + $r2 ) / 2;
    
    $texte  = "Bon de livraison : " . $num;    
    $szfont = 15;
    $loop   = 0;
    
    while ( $loop == 0 )
    {
       $this->SetFont( "Arial", "B", $szfont );
       $sz = $this->GetStringWidth( $texte );
       if ( ($r1+$sz) > $r2 )
          $szfont --;
       else
          $loop ++;
    }

    $this->SetXY( $r1+1, $y1+2);
    $this->Cell($r2-$r1 -1,5, $texte, 0, 0, "C" );
}

// Affiche un cadre avec la date de la facture / devis
// (en haut, a droite)
function addDate( $date )
{
    $r1  = $this->w - 65;
    $y1  = 22;
    $this->SetXY( $r1 , $y1 );
    $this->SetFont( "Arial", "B", 15);
    $this->Cell(10,5,"du ".$date, 0,0, "C");
}

// Affiche l'adresse du client et de livraison
// (en haut, a droite)
function addClient($client, $nom, $adresse, $cp, $pays )
{
    $r1  = $this->w - 92;
    $r2  = $r1 + 85;
    $y1  = 44;
    $y2  = 40 ;
    $this->Rect($r1, $y1-2, ($r2 - $r1), $y2, 3.5, 'D');
	//Client
    $this->SetXY( $r1-35 + ($r2-$r1)/2 - 5, $y1+2.6 );
    $this->SetFont( "Arial", "B", 12);
    $this->Cell(10,5, $client, 0, 0, "");
	//Nom
	$this->SetXY( $r1-35 + ($r2-$r1)/2 - 5, $y1+8 );
    $this->SetFont( "Arial", "", 12);
    $this->Cell(10,5, $nom, 0, 0, "");
	//Adresse
    $this->SetXY( $r1-35	+ ($r2-$r1)/2 - 5, $y1+13 );
    $this->SetFont( "Arial", "", 12);
    $this->Cell(10,5,$adresse, 0,0, "");
	//Code Postale
    $this->SetXY( $r1-35 + ($r2-$r1)/2 - 5, $y1+24 );
    $this->Cell(10,5,$cp, 0,0, "");
	//Pays
	$this->SetXY( $r1-35 + ($r2-$r1)/2 - 5, $y1+29 );
    $this->Cell(10,5,$pays, 0,0, "");
	
}

// Affiche une ligne avec des reference
// (en haut, a gauche)
function addReference($num_commande,$iko)
{
	$text="Votre réf. : " .$num_commande. " ".$date."        IKONIC: ".$iko;
    $this->SetFont( "Arial", "B", 10);
    $length = $this->GetStringWidth( $text);
    $r1  = 10;
    $r2  = $r1 + $length;
    $y1  = 92;
    $y2  = $y1+5;
    $this->SetXY( $r1 , $y1 );
    $this->Cell($length,4,$text);
}

// trace le cadre des colonnes du devis/facture
function addCols( $tab )
{
    global $colonnes;
    
    $r1  = 10;
    $r2  = $this->w - ($r1 * 2) ;
    $y1  = 100;
    $y2  = $this->h - 60 - $y1;
    $this->SetXY( $r1, $y1 );
    $this->Rect( $r1, $y1, $r2, $y2, "D");
    $this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
    $colX = $r1;
    $colonnes = $tab;
    while ( list( $lib, $pos ) = each ($tab) )
    {
        $this->SetXY( $colX, $y1+2 );
        $this->Cell( $pos-2, 1, $lib, 0, 0, "C");
        $colX += $pos;
        $this->Line( $colX, $y1, $colX, $y1+$y2);
    }
}

// trace le cadre des colonnes du devis/facture
function addCols2( $tab )
{
    global $colonnes;
    
    $r1  = 10;
    $r2  = $this->w - ($r1 * 2) ;
    $y1  = 20;
    $y2  = $this->h - 60 - $y1;
    $this->SetXY( $r1, $y1 );
    $this->Rect( $r1, $y1, $r2, $y2, "D");
    $this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
    $colX = $r1;
    $colonnes = $tab;
    while ( list( $lib, $pos ) = each ($tab) )
    {
        $this->SetXY( $colX, $y1+2 );
        $this->Cell( $pos-2, 1, $lib, 0, 0, "C");
        $colX += $pos;
        $this->Line( $colX, $y1, $colX, $y1+$y2);
    }
}

// mémorise le format (gauche, centre, droite) d'une colonne
function addLineFormat( $tab )
{
    global $format, $colonnes;
    
    while ( list( $lib, $pos ) = each ($colonnes) )
    {
        if ( isset( $tab["$lib"] ) )
            $format[ $lib ] = $tab["$lib"];
    }
}

function lineVert( $tab )
{
    global $colonnes;

    reset( $colonnes );
    $maxSize=0;
    while ( list( $lib, $pos ) = each ($colonnes) )
    {
        $texte = $tab[ $lib ];
        $longCell  = $pos -2;
        $size = $this->sizeOfText( $texte, $longCell );
        if ($size > $maxSize)
            $maxSize = $size;
    }
    return $maxSize;
}

function addLine( $ligne, $tab )
{
    global $colonnes, $format;

    $ordonnee     = 10;
    $maxSize      = $ligne;

    reset( $colonnes );
    while ( list( $lib, $pos ) = each ($colonnes) )
    {
        $longCell  = $pos -2;
        $texte     = $tab[ $lib ];
        $length    = $this->GetStringWidth( $texte );
        $tailleTexte = $this->sizeOfText( $texte, $length );
        $formText  = $format[ $lib ];
        $this->SetXY( $ordonnee+1, $ligne-1);
		$this->SetFont( "Arial", "", 10);
        $this->MultiCell( $longCell, 4 , $texte, 2, $formText);
        if ( $maxSize < ($this->GetY()  ) )
            $maxSize = $this->GetY() ;
        $ordonnee += $pos;
    }
    return ( $maxSize - $ligne );
}

// Ajoute un pied de page (en bas, au centre)
function addPiedPage($societe)
{

    $r1  = 60;
    $y1  = $this->h - 23;
	$this->SetFont( "Arial", "B", 10);
	$text="Nous retournez obligatoirement ce bon daté et signé par fax dès\n";
    $length = $this->GetStringWidth($text);
    $this->SetXY( $r1-7 , $y1+3);
	$this->Cell($length,4,$text, 0,0, "C");
	$text="réception du matériel afin de bénéficier de la garantie";
	$length = $this->GetStringWidth($text);
    $this->SetXY( $r1 , $y1+10);
	$this->Cell($length,4,$text, 0,0, "C");
    $this->SetFont( "Arial", "", 8);
    $length = $this->GetStringWidth($societe);
    $r1  = 16;
    $y1  = $this->h - 5;
    $this->SetXY( $r1 , $y1);
	$this->Cell($length,4,$societe, 0,0, "C");
}

// DateSignature
function addNomSignature()
{
    $r1  = $this->w - 200;
    $y1  = $this->h - 54;
    $this->SetFont( "Arial", "", 10);
    $this->SetXY( $r1+5, $y1+4 );
    $this->Cell(10,4, "Date :", 0, 0, "");
	$this->SetXY( $r1+5, $y1+14 );
    $this->Cell(10,4, "Nom et signature :", 0, 0, "");
}

// trace le cadre des totaux
function addCadreColis($nb, $expedition, $poids)
{
    $r1  = $this->w - 80;
    $r2  = $r1 + 60;
    $y1  = $this->h - 55;
    $y2  = $y1+25;
    $this->Rect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
    $this->SetFont( "Arial", "", 11);
    $this->SetXY( $r1+5, $y1+4 );
    $this->Cell(10,4, "Nombre de colis : ".$nb, 0, 0, "");
	$this->SetXY( $r1+5, $y1+10 );
    $this->Cell(10,4, "Expédition : ".$expedition, 0, 0, "");
    $this->SetXY( $r1+5, $y1+16 );
    $this->Cell(7,4, "Poids : ".$poids, 0, 0, "");
}

function temporaire( $texte )
{
    $this->SetFont('Arial','',50);
    $this->SetTextColor(255,0,0);
    $this->Rotate(45,90,200);
    $this->Text(60,190,$texte);
    $this->Rotate(0);
    $this->SetTextColor(0,0,0);
}
}
?>