<?php

function encriptar($datoAEncriptar){
    //Clave para poder encripart
    $claveSegura = "qwerty";
    //Agregar cipher iv
    $cript = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    //encriptado con openssl
    $textoEncript = openssl_encrypt($datoAEncriptar, 'aes-256-cbc', $claveSegura, 0, $cript);
    
    //Salida con Dato encriptado
    return base64_encode($cript . $textoEncript);
}