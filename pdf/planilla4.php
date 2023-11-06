<?php

require_once 'fpdf.php';
session_start();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

@$nombre = $_SESSION['inputNames'];
@$cedula = $_SESSION['ced'];
@$socio = $_SESSION['socibioregion'];
@$estado = $_SESSION['estado'];
@$telefono = $_SESSION['phone'];
@$telefonoclinic = $_SESSION['celphonN'];
@$diagnostico = $_SESSION['diagnostico'];
@$observaciones = $_SESSION['observaciones'];
@$docus = $_SESSION['organismos'];

@$nombreBene = $_SESSION['nombreBene'];
@$ceulaBene = $_SESSION['ciBene'];
@$parent = $_SESSION['parent'];

@$origen1 = ($_SESSION['origen'] == 'informe amplio y detallado del medico tratante') ? 'X' : '';
@$origen2 = ($_SESSION['origen'] == 'presupuesto vigente') ? 'X' : '';

@$fotocop1 = ($_SESSION['fotocopia'] == 'examenes que diagnostiquen la enfermedad') ? 'X' : '';
@$fotocop2 = ($_SESSION['fotocopia'] == 'copia de partida de nacimiento de los hijos') ? 'X' : '';
@$fotocop3 = ($_SESSION['fotocopia'] == 'Cedula del beneficiario y trabajador') ? 'X' : '';


//iamgen del INSAI

$pdf->Image('../resources/planillas/documento-4.png', -24, -17, 0, 370);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 6, 5, 197);
$pdf->Image('../resources/ins.png', 25, 31., 20);

$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(15, 55);
$pdf->MultiCell(50, 5, @$nombre, 0, 'C', false);

$pdf->SetXY(95, 60);
$pdf->Cell(25, 0, @$cedula, 0, 0, 'C');

$pdf->SetXY(152, 56);
$pdf->MultiCell(40, 5, ucwords(strtolower(@$socio)), 0, 'C', false);

// LINE 2
$pdf->SetXY(16, 94);
$pdf->MultiCell(50, 5, @$estado, 0, 'C', false);

$pdf->SetXY(95, 96);
$pdf->Cell(25, 0, @$telefono, 0, 0, 'C');

$pdf->SetXY(158, 96);
$pdf->Cell(25, 0, @$telefonoclinic, 0, 0, 'C');

// LINE 3
$pdf->SetXY(16, 124);
$pdf->MultiCell(50, 5, @$nombreBene, 0, 'C', false);

$pdf->SetXY(95, 126);
$pdf->Cell(25, 0, @$ceulaBene, 0, 0, 'C');

$pdf->SetXY(158, 126);
$pdf->Cell(25, 0, utf8_decode(@$parent), 0, 0, 'C');


// LINE 4
$pdf->SetXY(16, 150);
$pdf->MultiCell(50, 5, @$docus, 0, 'C', false);

// equis
$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(71, 147.5);
$pdf->Cell(20, 0, @$origen1, 0, 0, 'C');
$pdf->SetXY(71, 159.5);
$pdf->Cell(20, 0, @$origen2, 0, 0, 'C');
$pdf->SetXY(134, 147.5);
$pdf->Cell(20, 0, @$fotocop1, 0, 0, 'C');
$pdf->SetXY(134, 159.5);
$pdf->Cell(20, 0, @$fotocop2, 0, 0, 'C');
$pdf->SetXY(134.5, 171.5);
$pdf->Cell(20, 0, @$fotocop3, 0, 0, 'C');

// obsenile

$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(18, 175);
$pdf->MultiCell(40, 5, @$diagnostico, 0, 'C', false);

$pdf->SetXY(88, 175);
$pdf->MultiCell(40, 5, @$observaciones, 0, 'C', false);


$pdf->Output('solicitud_vacaciones.pdf', 'I');