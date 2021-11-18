<?php

namespace Models;

use PDF\FPDF as FPDF;

require './PDF/FPDF.php';


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    /* <img src="utnLogo.png" width="300"> */
    //$this->Image(IMG_PATH.'utnLogo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Courier','B',13);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,13,'- POSTULATED STUDENTS -',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->Cell(40,10,'File number',1,0,'C',0);
    $this->Cell(40,10,'First name',1,0,'C',0);
    $this->Cell(40,10,'Last name',1,0,'C',0);
    $this->Cell(70,10,'Email',1,1,'C',0); 
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Page ').$this->PageNo().'/{nb}',0,0,'C');
}
}


?>