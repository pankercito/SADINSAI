<?php

// Establecer la duración de la sesión
ini_set('session.cookie_lifetime', 600); // un minuto para pruebas 

session_start();

// Actualizar la última actividad de la sesión
$_SESSION['LAST_ACTIVITY'] = time();