<?php

require_once 'fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(8, 10, 8);

//iamgen del INSAI
$pdf->Image('../resources/planillas/documento-2.png', -26, -5, 0, 370);

//imagen grande 
$pdf->Image('../resources/sintillo.jpg', 8, 5, 194);
$pdf->Image('../resources/ins.png', 20, 31., 20);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 15);

$pdf->Output('solicitud_vacaciones.pdf', 'I');