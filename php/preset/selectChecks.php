<?php

$sels = $_POST['select'];

switch ($sels) {
    case '1':
        include "../../layout/bxConten/solicitudes.html";

        break;
    case '2':
        include "../../layout/bxConten/archivos.html";

        break;
    case '3':
        include "../../layout/bxConten/usuarios.html";
        break;
    case '4':
        echo "se generara un reporte de toda la informacion";
        break;
    default:
       echo 'error';
        break;
}