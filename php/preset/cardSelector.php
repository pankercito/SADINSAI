<?php

$archivos = $_GET["gestion"];

include('arrayArchives.php');
// Comprobamos si el valor de la opción está en el array

if (array_key_exists($archivos, $direcciones)) {
      // Si está, incluimos el archivo correspondiente AGREGAR
    if (isset($_GET["documento"])){
      include('../layout/documentForm.php');
    }else{
      // Si está, incluimos el archivo correspondiente ARCHIVOS
     include $direcciones[$archivos];
    }
  } else {
    // Si no está, mostramos un mensaje de error
    echo "Opción no válida";
  }