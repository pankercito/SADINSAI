<?php

function hora(){

    date_default_timezone_set('America/Caracas');

    $hora_actual = date('Y-m-d H:i:s');
    // Convertir la hora actual en un objeto DateTime
    $fecha_hora = new DateTime($hora_actual);
    // Sumar 3 minutos a la hora actual
    $fecha_hora->add(new DateInterval('PT10M'));
     // Obtener la nueva hora en el formato "YYYY-MM-DD HH:MM:SS"
    $nueva_hora = $fecha_hora->format('Y-m-d H:i:s');

return $nueva_hora;
}