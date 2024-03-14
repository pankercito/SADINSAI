<?php

require_once 'fpdf.php';

session_start();

@$codigo = $_SESSION['codigo'];
@$fecha = $_SESSION['fecha'];
@$codigoNomina = $_SESSION['codigoNomina'];
@$nombre = $_SESSION['inputNames'];
@$nombre = $_SESSION['cargo'];
@$cedula = $_SESSION['cin'];
@$departament = $_SESSION['adscrito'];
@$unidad = $_SESSION['unidad'];
@$estado = $_SESSION['ubicacion'];
@$fechaingre = $_SESSION['fechaingreso'];
@$tiempo = $_SESSION['organismos'];
@$totaltiem = $_SESSION['tiempototal'];
@$periodo = $_SESSION['periodo'];
@$habiles = $_SESSION['habiles'];
@$cantidad = $_SESSION['cantidad'];
@$incorporacion = $_SESSION['incorporacion'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

//iamgen del INSAI
$pdf->Image('../resources/planillas/documento-3.png', -26, -5, 0, 370);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 5, 5, 199);
$pdf->Image('../resources/ins.png', 24, 31., 20);

$pdf->Ln(10);

// PRIMERA LINEA 
$pdf->SetFont('Arial', '', 12);

$pdf->SetXY(18, 60);
$pdf->Cell(25, 0, @$codigo, 0, 0, 'C');


$pdf->SetXY(65, 65);
$pdf->Cell(30, 0, @$fecha, 0, 0, 'C');

// // check tipo de cargpo
// $pdf->Image('../resources/check.png', 112, 60, 6);
// $pdf->Cell(10, 0, '', 0, 0, 'C');
// $pdf->Image('../resources/check.png', 135, 60, 6);

// // check tipo de trabajador
// $pdf->Image('../resources/check.png', 162, 60, 6);
// $pdf->Cell(10, 0, '', 0, 0, 'C');
// $pdf->Image('../resources/check.png', 187, 60, 6);

// LINE ***************************
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(10, 94);
$pdf->MultiCell(30, 5, @$nombre, 0, 'C', false);

$pdf->SetXY(50, 98);
$pdf->Cell(25, 0, @$cedula, 0, 0, 'C');

$pdf->SetXY(90, 98);
$pdf->Cell(25, 0, @$nombre, 0, 0, 'C');


$pdf->SetXY(128, 92);
$pdf->MultiCell(30, 5, @$departament, 0, 'C');

$pdf->SetXY(168, 92);
$pdf->MultiCell(30, 5, ucwords(strtolower(@$unidad)), 0, 'C');

// LINE ***************************
$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(10, 132);
$pdf->Cell(41, 5, @$estado, 0, 0, 'C');

$pdf->SetXY(59, 135);
$pdf->Cell(43, 0, @$fechaingre, 0, 0, 'C');

$pdf->SetXY(110, 135);
$pdf->Cell(37, 0, @$tiempo, 0, 0, 'C');

$pdf->SetXY(160, 135);
$pdf->Cell(40, 0, @$totaltiem, 0, 0, 'C');

// LINE 
$pdf->SetXY(10, 154);
$pdf->Cell(41, 5, @$periodo, 0, 0, 'C');

$pdf->SetXY(58, 156);
$pdf->Cell(43, 0, @$habiles, 0, 0, 'C');

$pdf->SetXY(110, 156);
$pdf->Cell(37, 0, @$cantidad, 0, 0, 'C');

$pdf->SetXY(160, 156);
$pdf->Cell(40, 0, @$incorporacion, 0, 0, 'C');

$nombres = [
    1 => 'codigo',
    2 => 'fecha',
    3 => 'codigoNomina',
    4 => 'inputNames',
    5 => 'cargo',
    6 => 'cin',
    7 => 'adscrito',
    8 => 'unidad',
    9 => 'ubicacion',
    10 => 'fechaingreso',
    11 => 'organismos',
    12 => 'tiempototal',
    13 => 'periodo',
    14 => 'habiles',
    15 => 'cantidad',
    16 => 'incorporacion'
];

foreach ($nombres as $key => $value) {
    unset($_SESSION[$nombres[$key]]);
}

$pdf->Output('solicitud_vacaciones.pdf', 'I');
