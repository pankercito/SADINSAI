<?php

function encriptar($datoAEncriptar){
    $passwordSave = "qwerty";
    $encriptado = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 
                  md5($passwordSave, $datoAEncriptarz, MCRYPT_MODE_CBC, md5(md5($passwordSave)))));
    return $encriptado;
}

function desencriptar($datoAEncriptar){
    $passwordSave = "qwerty";
    $desencriptado = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 
                    md5($passwordSave, $datoAEncriptarz, MCRYPT_MODE_CBC, md5(md5($passwordSave)))));
    return $encriptado;
}

