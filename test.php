<?php

include('php/funtion/encriptData.php');
include('php/funtion/desencriptData.php');

session_start();

// Texto encriptado
$_SESSION['culito'] = encriptar('hola mundo');
// Clave de desencripción
echo $_SESSION['culito'];
// Llamada a la función desencriptar()
$textoDesencriptado = desencriptar($_SESSION['culito']);

// Imprimir el texto desencriptado
echo '<br>' . $textoDesencriptado ;