<?php

date_default_timezone_set('America/Caracas');

/**
 * FUNCION PARA SUMAR 10m A LA HORA PARA EL CIERRE AUTOMATICO
 * @return string
 */
function hora10()
{
    $hora_actual = date('Y-m-d H:i:s');
    // Convertir la hora actual en un objeto DateTime
    $fecha_hora = new DateTime($hora_actual);
    // Sumar 10 minutos a la hora actual
    $fecha_hora->add(new DateInterval('PT5M'));
    // Obtener la nueva hora en el formato "YYYY-MM-DD HH:MM:SS"
    $nueva_hora = $fecha_hora->format('Y-m-d H:i:s');

    return $nueva_hora;
}

/**
 * FUNCION DE HORA EN FORMATO SQL
 * @return string
 */
function hora()
{
    $hora_actual = date('Y-m-d H:i:s');

    return $hora_actual;
}

/**
 * Crea un rango de fechas de la semana actual
 * @return array lunes | domingo
 */
function rangoFechas()
{
    $fech = date('Y-m-d');

    $domingo = date('Y-m-d', strtotime('next Sunday', strtotime($fech)));

    if (date("N") == 7) {
        $domingo = date('Y-m-d');
    }

    $lunes = date('Y-m-d', strtotime('-6 days', strtotime($domingo)));

    return [
        'lunes' => $lunes,
        'domingo' => $domingo
    ];
}