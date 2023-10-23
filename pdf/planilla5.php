<?php

require_once 'fpdf.php';


@$codigo = $_POST['codigo'];
@$fecha = $_POST['fecha'];
@$codigoNomina = $_POST['codigoNomina'];
@$nombre = $_POST['inputNames'];
@$cargo = $_POST['cargo'];

@$cedula = $_POST['cin'];
@$departament = $_POST['adscrito'];
@$unidad = $_POST['unidad'];
@$estado = $_POST['ubicacion'];
@$fechaingre = $_POST['fechaingreso'];
@$tiempo = $_POST['organismos'];
@$tiempototal = $_POST['tiempototal'];
@$observaciones = $_POST['observaciones'];
@$desde = $_POST['desde'];
@$hasta = $_POST['hasta'];
@$cantidad = $_POST['cantidad'];
@$incorporacion = $_POST['incorporacion'];
@$licencia = $_POST['licencia'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

//iamgen del INSAI
$pdf->Image('../resources/planillas/documento-5.png', -16, -14, 0, 350);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 4, 5, 200);
$pdf->Image('../resources/ins.png', 20, 31., 20);


// PRIMERA LINEA 
$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(18, 55.5);
$pdf->Cell(25, 0, @$codigo, 0, 0, 'C');


$pdf->SetXY(88, 55.5);
$pdf->Cell(30, 0, @$fecha, 0, 0, 'C');

$pdf->SetXY(145, 55.5);
$pdf->Cell(45, 0, @$codigoNomina, 0, 0, 'C');

// LINE ***************************
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(15, 71.5);
$pdf->MultiCell(30, 5, @$nombre, 0, 'C', false);

$pdf->SetXY(58, 75.5);
$pdf->Cell(25, 0, @$cedula, 0, 0, 'C');

$pdf->SetXY(95, 75);
$pdf->Cell(25, 0, @$cargo, 0, 0, 'C');

$pdf->SetXY(124, 70.5);
$pdf->MultiCell(35, 5, @$departament, 0, 'C');

$pdf->SetXY(163, 70);
$pdf->MultiCell(38, 5, ucwords(strtolower(@$unidad)), 0, 'C');

// LINE ***************************
$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(9, 98);
$pdf->Cell(41, 5, @$estado, 0, 0, 'C');

$pdf->SetXY(50, 101);
$pdf->Cell(43, 0, @$fechaingre, 0, 0, 'C');

$pdf->SetXY(105, 101);
$pdf->Cell(37, 0, @$tiempo, 0, 0, 'C');

$pdf->SetXY(161, 101);
$pdf->Cell(40, 0, @$tiempototal, 0, 0, 'C');

// line
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(5, 129.5);
$pdf->MultiCell(30, 5, @$desde, 0, 'C', false);

$pdf->SetXY(38, 131.5);
$pdf->Cell(25, 0, @$hasta, 0, 0, 'C');

$pdf->SetXY(65, 131.5);
$pdf->Cell(25, 0, @$cantidad, 0, 0, 'C');

$pdf->SetXY(102, 130);
$pdf->Cell(37, 0, @$incorporacion, 0, 0, 'C');

$pdf->SetXY(158, 130);
$pdf->Cell(40, 0, @$licencia, 0, 0, 'C');

// OBSERVA
$pdf->SetFont('Arial', '', 11);
$pdf->SetXY(8, 146);
$pdf->MultiCell(0, 5, @$observaciones, 0, 'C', false);


$pdf->Output('solicitud_de_vacaciones.pdf', 'I');