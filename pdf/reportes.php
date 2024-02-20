<?php
//peticion de la libreria fpdf
require_once "fpdf.php";
require_once "../php/class/conx.php";
require_once "../php/class/personal.php";
require_once "../php/function/criptCodes.php";
require_once "../php/function/getUser.php";

date_default_timezone_set('America/Caracas');
session_start();

/**
 * Suma todos los datos del arrays assoc 'count'
 * @param mixed $array
 * @return int = cantidad total
 */
function total($array)
{
    foreach ($array as $key => $value) {
        @$total .= $value['count'] . '-';
    }
    @$cadena = $total;
    // Convertimos la cadena en un array de números
    $numeros = explode("-", $cadena);
    // Declaramos una variable para almacenar la suma
    $suma = 0;
    // Iteramos sobre el array de números
    foreach ($numeros as $numero) {
        // Convertimos cada número a un número entero
        $numeroEntero = intval($numero);
        // Sumamos el número al acumulado
        $suma += $numeroEntero;
    }
    return $suma;
}

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
        $this->Cell(50, 8, 'Reporte Consolidado', 0, 1, 'R');
        $this->SetY(45);
        $this->SetX(147);
        $this->Ln(30);
    }

    function Footer()
    {
        $a = ($_SESSION['admincheck'] == 2) ? 'Generado por Dir. de Tecnologia' : 'Generado por Jefe de Departamento';

        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(85, 5, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'L');
        $this->Cell(20, 5, utf8_decode($a), 0, 0, 'C');
        $this->Cell(85, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
        $this->Line(10, 287, 200, 287);
        $this->Cell(0, 5, utf8_decode("Instituto Nacional Agricola Integral. INSAI Aragua"), 0, 0, "C");
    }
}

$pdf = new PDF();

function reportGestion($pdf)
{
    if (@$_SESSION['reporteGestion']) {

        $data = $_SESSION['reporteGestion'];

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
        $pdf->Cell(20, 8, utf8_decode('Reporte de gestiones'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 8, utf8_decode('gestiones totales:' . total($data)), 0, 1, 'L', 0);


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('tipo'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 

        $tipoSolic = [
            "0" => "ingreso de personal",
            "1" => "edicion de datos",
            "2" => "ingreso de archivo",
            "3" => "eliminacion de archivo"
        ];

        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;

            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($tipoSolic[$row['tipo']]))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['dia']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }
    }
}

function reportGestionUser($pdf)
{
    if (@$_SESSION['reporteUsersUsers']) {

        $data = $_SESSION['reporteUsersUsers'];

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
        $pdf->Cell(20, 8, utf8_decode('Gestiones Realizadas por Usuarios'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 5, utf8_decode('usuarios totales:' . count($data)), 0, 1, 'L', 0);
        $pdf->SetX(14);
        $pdf->Cell(20, 5, utf8_decode('gestiones totales:' . total($data)), 0, 1, 'L', 0);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('usuario'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 


        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;
            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($row['user']))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['fecha']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }
    }
}

// IMPLEMENTAR
function reportSolis($pdf)
{
    if (@$_SESSION['reporteSolis']) {

        $data = $_SESSION['reporteSolis'];

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
        $pdf->Cell(20, 8, utf8_decode('Reporte de solicitudes'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 8, utf8_decode('solicitudes totales:' . total($data)), 0, 1, 'L', 0);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('tipo'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 

        $tipoSolic = [
            "1" => "de anticipo",
            "2" => "de permiso",
            "3" => "de vacaciones",
            "4" => "carta de aval",
            "5" => "licencia de paternidad"
        ];

        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;
            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($tipoSolic[$row['tipo']]))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['dia']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }
    }
}

// IMPLEMENTAR
function reportSolisUser($pdf)
{
    if (@$_SESSION['reporteSolisUser']) {

        $data = $_SESSION['reporteSolisUser'];

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
        $pdf->Cell(20, 8, utf8_decode('Solicitudes Realizadas por Usuarios'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 5, utf8_decode('usuarios totales:' . count($data)), 0, 1, 'L', 0);
        $pdf->SetX(14);
        $pdf->Cell(20, 5, utf8_decode('Solicitudes totales:' . total($data)), 0, 1, 'L', 0);
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('usuario'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 


        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;
            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($row['user']))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['fecha']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }
    }
}

function reportInixUser($pdf)
{
    if (@$_SESSION['reporteUsersInix']) {
        $data = $_SESSION['reporteUsersInix'];

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
        $pdf->Cell(20, 8, utf8_decode('Inicios de Sesion por Usuario'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 8, utf8_decode('ingresos totales al sistema:' . total($data)), 0, 1, 'L', 0);


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('usuario'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 


        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;
            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($row['user']))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['fecha']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }

    }
}

function reportArch($pdf)
{
    if (@$_SESSION['reporteArch']) {

        $data = $_SESSION['reporteArch'];

        $conn = new Conexion();

        $r = $conn->query("SELECT * FROM tiposarch");

        while ($tori = $r->fetch_object()) {
            $t[$tori->id_tipo] = $tori->nombre_tipo_arch;
        }

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
        $pdf->Cell(20, 8, utf8_decode('Reporte de Archivos'), 0, 1, 'L', 0);

        // mini pie
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(14);
        $pdf->Cell(20, 8, utf8_decode('archivos totales en el sistema:' . total($data)), 0, 1, 'L', 0);


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(15);
        $pdf->SetTextColor(255); //color del texto 
        $pdf->Cell(12, 12, utf8_decode('N°'), 1, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('tipo'), 1, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('cantidad'), 1, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('fecha'), 1, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0); //color del texto 


        $i = 0;
        foreach ($data as $row) {
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(65, 61, 61);
            $i++;
            //contador que autoincrementa 
            $contador = $i;
            $pdf->Cell(12, 8, utf8_decode($contador), 1, 0, 'C', 0);
            $pdf->Cell(80, 8, utf8_decode(ucwords(strtolower($t[$row['tipo']]))), 1, 0, 'C', 0);
            $pdf->Cell(60, 8, utf8_decode($row['count']), 1, 0, 'C', 0);
            $pdf->Cell(30, 8, utf8_decode($row['dia']), 1, 1, 'C', 0);
            $pdf->Ln(0.5);
        }
    }
}

$conn = new Conexion;

//  ARCHIVOS 
if (isset($_SESSION['reporteArch'])) {
    reportArch($pdf);
    unset($_SESSION['reporteArch']);
}

//  GESTIONES 
if (isset($_SESSION['reportGestion'])) {
    reportGestion($pdf);
    unset($_SESSION['reportGestion']);
}

//  SOLICITUDES 
if (isset($_SESSION['reporteSolis'])) {
    reportSolis($pdf);
    unset($_SESSION['reporteSolis']);
}

//  SOLICITUDES USER
if (isset($_SESSION['reporteSolisUser'])) {
    reportSolisUser($pdf);
    unset($_SESSION['reporteSolisUser']);
}

//  USUARIOS GESTIONES
if (isset($_SESSION['reporteUsersUsers'])) {
    reportGestionUser($pdf);
    unset($_SESSION['reporteUsersUsers']);
}

//  USUARIOS INICIOS DE SESION
if (isset($_SESSION['reporteUsersInix'])) {
    reportInixUser($pdf);
    unset($_SESSION['reporteUsersInix']);
}

//  GENERAL
if (isset($_SESSION['general'])) {
    reportGestion($pdf);
    reportGestionUser($pdf);
    reportSolis($pdf);
    reportSolisUser($pdf);
    reportArch($pdf);
    reportInixUser($pdf);

    unset($_SESSION['reporteArch']);
    unset($_SESSION['reporteSolis']);
    unset($_SESSION['reporteUsersUsers']);
    unset($_SESSION['reporteUsersInix']);
}

//para poder descargar el pdf, nombre del archivo y manera de descarga
$pdf->Output('reporte_consolidado_en_total.pdf', 'I');