<?php

require_once 'fpdf.php';

session_start();

@$codigo = $_SESSION['codigo'];
@$fecha = $_SESSION['fecha'];
@$codigoNomina = $_SESSION['codigoNomina'];
@$nombre = $_SESSION['inputNames'];
@$cargo = $_SESSION['cargo'];

@$cedula = $_SESSION['cin'];
@$departament = $_SESSION['adscrito'];
@$unidad = $_SESSION['unidad'];
@$estado = $_SESSION['ubicacion'];
@$fechaingre = $_SESSION['fechaingreso'];
@$tiempo = $_SESSION['organismos'];
@$totaltiem = $_SESSION['tiempototal'];
@$observaciones = $_SESSION['observaciones'];


// seccion de motivo
@$motivo =  ($_SESSION['motivode'] == 'Vivienda Adquisición devivienda') ? 'x' : '';
@$motivo1 =  ($_SESSION['motivode'] == 'Vivienda Mejora o reparacion de la vivienda') ? 'x' : '';
@$motivo2 =  ($_SESSION['motivode'] == 'Hipoteca Sobre la vivienda') ? 'x' : '';
@$motivo3 =  ($_SESSION['motivode'] == 'Hipoteca Otro gravamen') ? 'x' : '';
@$motivo4 =  ($_SESSION['motivode'] == 'Gastos Trabajador') ? 'x' : '';
@$motivo5 =  ($_SESSION['motivode'] == 'Gastos Cónyugue') ? 'x' : '';
@$motivo6 =  ($_SESSION['motivode'] == 'Gastos Hijos') ? 'x' : '';
@$motivo7 =  ($_SESSION['motivode'] == 'pago de pension escolar') ? 'x' : '';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

//iamgen del INSAI
$pdf->Image('../resources/planillas/documento-1.png', -3, 15, 0, 280);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 8, 5, 194);
$pdf->Image('../resources/ins.png', 20, 29., 20);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 15);


// LINE ***************************
$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(14, 54);
$pdf->Cell(30, 5, @$codigo, 0, 0, 'C');

$pdf->SetXY(69, 56);
$pdf->Cell(25, 0, @$fecha, 0, 0, 'C');

$pdf->SetXY(145, 56);
$pdf->Cell(25, 0, @$codigoNomina, 0, 0, 'C');


// LINE ***************************
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(10, 86);
$pdf->MultiCell(48, 5, @$nombre, 0, 'C', false);

$pdf->SetFont('Arial', '', 11);

$pdf->SetXY(60, 90);
$pdf->Cell(25, 0, @$cedula, 0, 0, 'C');

$pdf->SetXY(90, 90);
$pdf->Cell(24, 0, ucwords(@$cargo), 0, 0, 'C');

$pdf->SetXY(117, 86);
$pdf->MultiCell(38, 5, @$departament, 0, 'C', false);

$pdf->SetXY(160, 86);
$pdf->MultiCell(38, 5, ucfirst(strtolower(@$unidad)), 0, 'C', false);

// LINE ***************************
$pdf->SetFont('Arial', '', 10);

$pdf->SetXY(12, 117);
$pdf->Cell(41, 5, utf8_decode(@$estado), 0, 0, 'C');

$pdf->SetXY(55, 120);
$pdf->Cell(43, 0, @$fechaingre, 0, 0, 'C');

$pdf->SetXY(100, 120);
$pdf->Cell(37, 0, @$tiempo, 0, 0, 'C');

$pdf->SetXY(150, 120);
$pdf->Cell(40, 0, @$totaltiem, 0, 0, 'C');

// OBSERVA
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(168, 150);
$pdf->MultiCell(32, 5, @$observaciones, 0, 'C', false);

// CHECK 
$pdf->SetFont('Arial', '', 15);
$pdf->SetXY(21, 170);
$pdf->Cell(32, 5, @$motivo , 0, 'C', false);
$pdf->SetXY(44, 170);
$pdf->Cell(32, 5, @$motivo1, 0, 'C', false);
$pdf->SetXY(65, 170);
$pdf->Cell(32, 5, @$motivo2, 0, 'C', false);
$pdf->SetXY(86, 170);
$pdf->Cell(32, 5, @$motivo3, 0, 'C', false);
$pdf->SetXY(105, 170);
$pdf->Cell(32, 5, @$motivo4, 0, 'C', false);
$pdf->SetXY(125, 170);
$pdf->Cell(32, 5, @$motivo5, 0, 'C', false);
$pdf->SetXY(145, 170);
$pdf->Cell(32, 5, @$motivo6, 0, 'C', false);
$pdf->SetXY(160, 170);
$pdf->Cell(32, 5, @$motivo7, 0, 'C', false);


$pdf->Output('solicitud_vacaciones.pdf', 'I');

$nombre = [
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
    13 => 'motivode',
    14 => 'observaciones'
];

foreach ($nombres as $key => $value) {
   unset($_SESSION[$nombre[$key]]);
}