<link href="../resources/import/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../resources/import/Bootstrap/font/bootstrap-icons.css">
<script src="../resources/import/Pdf/build/pdf.js"></script>
<link rel="stylesheet" href="../resources/import/Pdf/web/viewer.css">
<link rel="stylesheet" href="../styles/buttomlogin.css">

<?php

// Incluir la librería FPDF
require_once "fpdf.php";

class PDF extends FPDF
{
    // Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln(); // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

    // Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

session_start();

// Crear un nuevo documento PDF
$pdf = new PDF();

function total($array)
{
    foreach ($array as $key => $value) {
        @$total .= $value['count'] . '-';
    }
    $cadena = $total;
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

$hader = (!isset($_SESSION['general'])) ? '<div class="header row">
                    <img src="../resources/ins.png" style="margin: 0 1rem 0;    width: 8%;    height: 2rem;">
                    <img src="../resources/sintillo.jpg" style="width: 100%;">
                </div>' : '';


if (isset($_SESSION['reporteArch'])) {
    $data = $_SESSION['reporteArch'];

    $header = ['tipo', 'cantidad', 'fecha'];

    ?>
    <div class="p-4 table-responsive">
        <div class="header row">
            <img src="../resources/ins.png" style="margin: 0 1rem 0;    width: 8%;    height: 2rem;">
            <img src="../resources/sintillo.jpg" style="width: 100%;">
        </div>

        <h4 class="text-center mb-5 mt-4">Reporte de archivos</h4>
        <small>total de archivos en el sistema
            <?php echo $total = total($data) ?>
        </small>
        <table class="table table-striped
    table-danger
    align-middle">
            <thead class="table-light">
                <caption>reporte de archivos</caption>
                <tr>
                    <?php
                    foreach ($header as $key => $value) {
                        ?>
                        <th>
                            <?php echo $value ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <?php
                    foreach ($data as $row) {
                        // Agrega las celdas a la tabla
                        echo "<tr>";
                        foreach ($row as $col) {
                            echo "<td>$col</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <?php
    unset($_SESSION['reporteArch']);
}

if (isset($_SESSION['reporteSolis'])) {
    $data = $_SESSION['reporteSolis'];
    $header = ['tipo', 'cantidad', 'fecha'];

    foreach ($data as $key => $value) {
        @$total .= 0 + $key['count()'];
    }

    ?>
    <div class="p-4 table-responsive">
        <?php echo $hader ?>
        <h4 class="text-center mb-3 mt-4">Reporte de solicitudes</h4>
        <small> total de solicitudes
            <?php echo @total($data) ?>
        </small>
        <table class="table table-striped
    table-danger
    align-middle">
            <thead class="table-light">
                <caption>reporte de archivos</caption>
                <tr>
                    <?php
                    foreach ($header as $key => $value) {
                        ?>
                        <th>
                            <?php echo $value ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <?php
                    foreach ($data as $row) {
                        // Agrega las celdas a la tabla
                        echo "<tr>";
                        foreach ($row as $col) {
                            echo "<td>$col</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <?php
    unset($_SESSION['reporteSolis']);
}

if (isset($_SESSION['reporteUsers'])) {
    $data = $_SESSION['reporteUsers'];
    $header = ['id', 'usuario', 'cantidad', 'fecha'];
    ?>

    <div class="p-4 table-responsive">
        <?php echo $hader ?>

        <h4 class="text-center mb-3 mt-4">Reporte de solicitudes</h4>
        <table class="table table-striped
    table-danger
    align-middle">
            <thead class="table-light">
                <caption>reporte de archivos</caption>
                <tr>
                    <?php
                    foreach ($header as $key => $value) {
                        ?>
                        <th>
                            <?php echo $value ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <?php
                    foreach ($data as $row) {
                        // Agrega las celdas a la tabla
                        echo "<tr>";
                        foreach ($row as $col) {
                            echo "<td>$col</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <?php
    unset($_SESSION['reporteUsers']);
}
?>

<script type="text/javascript">

    setTimeout(() => {
        // Imprimimos la página
        window.print();
    }, 600);
</script>