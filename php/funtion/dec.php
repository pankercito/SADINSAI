<?php

// acomodar los links de archives
function comprueba(){
    $res = null;
    if (array_key_exists('perfil', $_GET) or array_key_exists('carga', $_GET)) {
        $res = $_GET['perfil'] ?? $_GET['carga'];
    }
    return $res;
}
