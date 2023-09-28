<?php

include("../php/conx.php");
include("../php/function/removerAcentos.php");

$conn = new Conexion();

$ci = $_POST['cedula'];

// VERIFICACION DE REQUERIDO
$verifi = $conn->query("SELECT * FROM arch_required a JOIN  tiposarch t ON t.id_tipo = a.id_tipo_arch WHERE a.ci_required_arch = '$ci' ");

// VERIFICACION DE REQUERIDO
if ($verifi->num_rows == 0) {
    ?>
    <div class="mx-auto col-md-12 mb-4 text-center">
        <h6>no se han establecido parametros aun</h6>
        <small>(precione guardar para generar registros)</small>
        <input type="checkbox" name="firt" valor="1" class="d-none">
    </div>
    <?php
    $verifi = $conn->query("SELECT * FROM tiposarch ");
}

?>
<div class="mx-auto col">
    <?php

    $tiposarch = [
        1001 => 'Ofertas',
        1002 => 'Curriculum',
        1003 => 'CI',
        1004 => 'ISR',
        1005 => 'Naturalizacion',
        1006 => 'Patrimonio',
        1007 => 'Puntos',
        1008 => 'FP-020',
        1009 => 'Concurso',
        1010 => 'Ascensos',
        1011 => 'Transferencias',
        1012 => 'Sueldo',
        1013 => 'Resoluciones',
        1014 => 'Contratos',
        1015 => 'Antecedentes',
        1016 => 'Gaceta',
        1017 => 'Titulos',
        1018 => 'Cursos',
        1019 => 'Trabajo',
        1020 => 'Primas',
        1021 => 'Eficiencia',
        1022 => 'Reconocimientos',
        1023 => 'Vacaciones',
        1024 => 'Defuncion',
        1025 => 'Matrimonio',
        1026 => 'Nacimiento',
        1027 => 'Estudiantes',
        1028 => 'Ayuda',
        1029 => 'Cirugia',
        1030 => 'Alimentacion',
        1031 => 'IVSS',
        1032 => 'Forma14',
        1033 => 'Medico',
        1034 => 'p-matrimonio',
        1035 => 'p-defuncion',
        1036 => 'p-estudiantes',
        1037 => 'Permisos',
        1038 => 'Amonestaciones',
        1039 => 'Providencia',
        1040 => 'Sentencia',
        1041 => 'Procedimientos',
        1042 => 'Familia',
        1043 => 'Embargo',
        1044 => 'Suspencion',
        1045 => 'Informes',
    ];
    ?>
    <?php

    $i = 45;
    // ciclo de consultas automaticas
    while ($arch = $verifi->fetch_object()) {

        $col_abierta = false;

        @$vff = ($arch->required_arch == 1) ? "checked" : "";

        ?>
        <div class="neg form-check">
            <input class="neg form-check-input" type="checkbox" name="<?php echo $tiposarch[$arch->id_tipo] ?>" value="1"
                id="<?php echo $arch->id_tipo ?>" <?php echo @$vff ?>>
            <label class="neg form-check-label" for="<?php echo $arch->id_tipo ?>">
                <?php echo $arch->nombre_tipo_arch ?>
            </label>
        </div>
        <?php

        if ($i % 14 == 0) {
            echo "</div>";
            echo "<div class='mx-auto col'>";
            $col_abierta = true;
        }
        $i++;
    }
    if ($col_abierta == true) {
        echo "</div>";
    }