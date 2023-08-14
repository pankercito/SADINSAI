<?php

date_default_timezone_set('America/Caracas');

// FUNCION PARA SUMAR 10m A LA HORA PARA EL CIERRE AUTOMATICO
function hora10()
{
    $hora_actual = date('Y-m-d H:i:s');
    // Convertir la hora actual en un objeto DateTime
    $fecha_hora = new DateTime($hora_actual);
    // Sumar 10 minutos a la hora actual
    $fecha_hora->add(new DateInterval('PT10M'));
    // Obtener la nueva hora en el formato "YYYY-MM-DD HH:MM:SS"
    $nueva_hora = $fecha_hora->format('Y-m-d H:i:s');

    return $nueva_hora;
}

// FUNCION DE HORA EN FORMATO SQL
function hora()
{
    $hora_actual = date('Y-m-d H:i:s');

    return $hora_actual;
}