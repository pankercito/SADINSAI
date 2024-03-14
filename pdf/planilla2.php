<?php

require_once 'fpdf.php';

session_start();

@$nombre = $_SESSION['inputNames'];
@$cedula = $_SESSION['ced'];
@$fecha = $_SESSION['fecha'];

if (@$fecha != null) {
    $get = explode('-', $fecha);

    $dia = $get[2];
    $mes = $get[1];
    $anno = $get[0];
}

@$feingreso = $_SESSION['fechaingreso'];
@$nombre = $_SESSION['cargo'];
@$adscrito = $_SESSION['adscrito'];
@$direccion = $_SESSION['direccion'];
@$diasHabiles = $_SESSION['diasH'];
@$diasContinuos = $_SESSION['diasC'];
@$inicio = $_SESSION['inicio'];
if (@$inicio != null) {
    $get = explode('-', $fecha);

    $idia = $get[2];
    $imes = $get[1];
    $ianno = $get[0];
}
@$regreso = $_SESSION['regreso'];
if (@$regreso != null) {
    $get = explode('-', $fecha);

    $rdia = $get[2];
    $rmes = $get[1];
    $ranno = $get[0];
}
@$causa = $_SESSION['causa'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

//iamgen del INSAI
$pdf->Image('../resources/planillas/documento-2.png', -26, -1, 0, 340);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 8, 5, 194);
$pdf->Image('../resources/ins.png', 20, 19., 15);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);

// FECHA LINE
$pdf->SetXY(10, 45);
$pdf->Cell(64, 0, @$dia, 0, 0, 'C');
$pdf->Cell(65, 0, @$mes, 0, 0, 'C');
$pdf->Cell(60, 0, @$anno, 0, 0, 'C');

$pdf->SetXY(23, 67);
$pdf->MultiCell(40, 0, @$nombre, 0, 'C');
$pdf->SetXY(97, 65);
$pdf->Cell(40, 5, @$cedula, 0, 'C');
$pdf->SetXY(160, 65);
$pdf->Cell(40, 5, @$feingreso, 0, 'C');

$pdf->SetXY(23, 92);
$pdf->MultiCell(40, 0, @$nombre, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(82, 87);
$pdf->MultiCell(50, 5, @$adscrito, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetXY(145, 86);
$pdf->MultiCell(50, 5, @$direccion, 0, 'C');

// HABILES
$pdf->SetXY(10, 125);
$pdf->MultiCell(20, 5, @$diasHabiles, 0, 'C');
$pdf->SetXY(30, 125);
$pdf->MultiCell(20, 5, @$diasContinuos, 0, 'C');

// FECHAS 

$pdf->SetXY(68, 125);
$pdf->MultiCell(20, 5, @$idia, 0, 'C');
$pdf->SetXY(86, 125);
$pdf->MultiCell(20, 5, @$imes, 0, 'C');
$pdf->SetXY(105, 125);
$pdf->MultiCell(20, 5, @$ianno, 0, 'C');

$pdf->SetXY(142, 125);
$pdf->MultiCell(20, 5, @$rdia, 0, 'C');
$pdf->SetXY(161, 125);
$pdf->MultiCell(20, 5, @$rmes, 0, 'C');
$pdf->SetXY(181, 125);
$pdf->MultiCell(20, 5, @$ranno, 0, 'C');

$pdf->SetXY(20, 160);
$pdf->MultiCell(170, 5, @$causa, 0, 'C');


$pdf->Output('solicitud_vacaciones.pdf', 'I');