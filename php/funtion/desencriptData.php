<?php


function desencriptar($textoEncript){
    //Clave para poder desencripart
    $claveSegura = "qwerty";
    //texto encriptado
    $textoEncript = base64_decode($textoEncript);
    //Medita usada para sumar al encriptar "cipher iv, aes-256-cbc"
    $criptL = openssl_cipher_iv_length('aes-256-cbc');
    //quitar el cipher iv
    $noCript = substr($textoEncript, 0, $criptL);
    
    $salida = substr($textoEncript, $criptL);

    //Salida con dato desencriptado
    return openssl_decrypt($salida, 'aes-256-cbc', $claveSegura, 0, $noCript);
}