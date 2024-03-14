<?php

/**
 * Obtener nombre del tipo de archivo segun si id
 * @param mixed $tipo
 * @return mixed
 */
function getNombreTipoArch($tipo)
{
    $con = new Conexion();

    $x = $con->query("SELECT * FROM tiposarch WHERE id_tipo = '{$tipo}'");

    if ($x->num_rows > 0) {

        $o = $x->fetch_object();

        return $o->nombre_tipo_arch;
    }
}