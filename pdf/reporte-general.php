<?php
//peticion de la libreria fpdf
require_once "fpdf.php";
date_default_timezone_set('America/Caracas');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "sadinsai");

//crear clase en fpdf para control de cambios mayor
class PDF extends FPDF
{
    // Cabecera de página
//Numeros de paginas
//SetTextColor(255,255,255);es RGB extraer colores con GIMP
//SetFillColor()
//SetDrawColor()
//Line(derecha-izquierda, arriba-abajo,ancho,arriba-abajo)
//Color line setDrawColor(61,174,233)
//GetX() || GetY() posiciones en cm
//Grosor SetLineWidth(1)
// SetFont(tipo{COURIER, HELVETICA,ARIAL,TIMES,SYMBOL, ZAPDINGBATS}, estilo[normal,B,I ,A], tamaño)
// Cell(ancho , alto,texto,borde(0/1),salto(0/1),alineacion(L,C,R),rellenar(0/1)
//AddPage(orientacion[PORTRAIT, LANDSCAPE], tamño[A3.A4.A5.LETTER,LEGAL],rotacion)
//Image(ruta, poscisionx,pocisiony,alto,ancho,tipo,link)
//SetMargins(10,30,20,20) luego de addpage

    function Header()
    {

        $this->Image('../resources/sintillo.jpg', 6, 0, 199);
        $this->Image('../resources/ins.png', 170, 20, 25);

        $this->SetY(40);
        $this->SetX(145);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(255, 82, 82);
        $this->Cell(50, 8, 'Reporte General', 0, 1, 'R');
        $this->SetY(45);
        $this->SetX(147);
        $this->Ln(30);

    }

    function Footer()
    {
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95, 5, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'L');
        $this->Cell(95, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
        $this->Line(10, 287, 200, 287);
        $this->Cell(0, 5, utf8_decode("Instituto Nacional Agricola Integral. INSAI - Aragua"), 0, 0, "C");

    }


}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(500);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->SetX(15);
$pdf->SetFillColor(210, 57, 57);
$pdf->SetDrawColor(210, 57, 57);
// Cell(ancho , alto,texto,borde(0/1),salto(0/1),alineacion(L,C,R),rellenar(0/1)

$pdf->SetTextColor(210, 57, 57); //color del texto 
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(14);
$pdf->Cell(20, 8, utf8_decode('Solicitudes Realizadas'), 0, 1, 'L', 0);

// mini pie
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetX(14);
$pdf->Cell(20, 8, utf8_decode('solicitudes totales:' . 180 ), 0, 1, 'L', 0);


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(15);
$pdf->SetTextColor(255); //color del texto 
$pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(80, 12, utf8_decode('item descripción'), 1, 0, 'C', 1);
$pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
$pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0); //color del texto 
//consulta sql se colsulta cada persona que ha solicitado reportes y su cantidad
$sql = $conexion->query("SELECT *, COUNT(id_emisor) AS nombre FROM solicitudes
INNER JOIN registro ON solicitudes.id_emisor = registro.id_usuario GROUP BY registro.user");

$i = 0;
while ($row = $sql->fetch_assoc()) {
    $pdf->SetX(15);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(65, 61, 61);
    $i++;
    //contador que autoincrementa 
    $contador = $i;
    $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
    $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($row['user']))), 1, 0, 'C', 0);
    $pdf->Cell(60, 8, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(30, 8, utf8_decode('todas'), 1, 1, 'C', 0);
    $pdf->Ln(0.5);
}

// Tu código existente...
//para poder descargar el pdf, nombre del archivo y manera de descarga
$pdf->Output('reporte_consolidado_en_total.pdf', 'I');

//cierro conexion
mysqli_close($conexion);
?>