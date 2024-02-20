<?php

include "class/conx.php";
include "class/auditoria.php";

$conn = new Conexion;
$auditoria = new Auditoria;

if (isset($_POST['cedula'])) {

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

    $sino = [
        "no requerido",
        "requerido"
    ];

    $cec = $conn->real_escape($_POST['cedula']);
    $contenido = "";
    $i = 1001;
    while ($i < 1046) {
        $var = (isset($_POST[$tiposarch[$i]])) ? "1" : "0";

        $update = "UPDATE arch_required SET required_arch = '$var' WHERE id_tipo_arch = '$i' AND ci_required_arch = '$cec'";

        $insert = "INSERT INTO arch_required (ci_required_arch, id_tipo_arch, required_arch) VALUES ('$cec', '$i', '1')";

        $verifi = $conn->query("SELECT * FROM arch_required WHERE id_tipo_arch = $i AND ci_required_arch = $cec");
        $ver = $verifi->fetch_object();

        $c = false;

        if ($verifi->num_rows > 0) {
            $upsql = $conn->query($update); 
            if ($upsql == true) {
                $c = true;
                if ($var != $ver->required_arch) {
                    $contenido .=  "{$tiposarch[$i]}: antes: {$sino[$ver->required_arch]} despues: {$sino[$var]} -- ";
                }
            }
        } else {
            $inssql = $conn->query($insert);
            if ($inssql == true) {
                $contenido .=  "{$tiposarch[$i]}: antes: {$sino[$ver->required_arch]} despues: {$sino[$var]} -- ";
                $c = true;
            }
        }
        $i++;
    }

    if ($c == true) {
        echo "success";
        $auditoria->registRequerid($cec, $contenido);
    } else {
        if (@$inssql == true) {
            echo "success";
        } else {
            echo "error de q";
        }
    }
}