<?php

include "conx.php";
include "class/auditoria.php";

$conn = new Conexion();

if (isset($_POST["personal"])) {
    $ci = $conn->real_escape($_POST["personal"]);

    $teng = $conn->query("SELECT id_tipo_arch, nombre_tipo_arch FROM arch_required a INNER JOIN archidata d ON d.ci_arch = a.ci_required_arch AND d.tipo_arch = a.id_tipo_arch INNER JOIN tiposarch t ON a.id_tipo_arch = t.id_tipo WHERE a.ci_required_arch = '$ci'");
    $var = $teng->num_rows;

    $reque = $conn->query("SELECT id_tipo_arch, nombre_tipo_arch FROM arch_required a INNER JOIN tiposarch t ON a.id_tipo_arch = t.id_tipo WHERE ci_required_arch = '$ci' AND required_arch = 1");
    $varbi = $reque->num_rows;


    if ($var > 0) {
        echo "Archivos agregados: " . $var . "<br>";
        echo "Archivos faltantes: " . $varbi - $var . "<br><hr>";
        $requiero = [];
        $tengo = [];

        while ($a = $reque->fetch_assoc()) {
            $requiero[$a['id_tipo_arch']] = $a['nombre_tipo_arch'];
        }
        while ($b = $teng->fetch_assoc()) {
            $tengo[$b['id_tipo_arch']] = $b['nombre_tipo_arch'];
        }

        foreach ($requiero as $id_tipo_arch => $nombre_tipo_arch) {
            if (isset($tengo[$id_tipo_arch])) {
                echo "tiene: " . $nombre_tipo_arch . "<br>";
            }
        }

        echo "<hr>";
        
        foreach ($requiero as $id_tipo_arch => $nombre_tipo_arch) {
            if (!isset($tengo[$id_tipo_arch])) {
                echo "falta: " . $nombre_tipo_arch . "<br>";
            }
        }

        

    } else {
        echo "por favor genere un registro de requeminientos primero";
    }

} else {
    echo "nollego";
}