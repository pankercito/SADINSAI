<?php

/**
 * verifica las entradas GET en archives.php 
 * para evitar duplicacion en los links
 * 
 * @return string link de salida 
 */
function comprueba(){
    $res = null;
    if (array_key_exists('perfil', $_GET) or array_key_exists('carga', $_GET)) {
        $res = $_GET['perfil'] ?? $_GET['carga'];
    }
    return $res;
}
