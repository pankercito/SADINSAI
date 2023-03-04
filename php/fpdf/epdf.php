<?php

require('fpdf.php');

if (isset($_POST['scans'])){

    $texttopdf = $_POST['textscan'];
    
    $pdf = new FPDF();
        $title = 'Resumen';
        
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(10, 15, utf8_decode($title), 0, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(190, 5, utf8_decode($texttopdf), 0, 'J');
        
    $pdf->Output();

}else{
    echo'No ha llegado el texto para guardar';
}


