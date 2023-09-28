<?php
/**
 * Encripta cualquier tipo de dato numerico o string.
 * not null
 * 
 * @param string $datoAEncriptar El string de entrada. 
 * @return string Devuelve el string modificado.
 */
function encriptar($datoAEncriptar){
    $passwordSave = "qwerty";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encriptado = openssl_encrypt($datoAEncriptar, 'aes-256-cbc', md5($passwordSave), OPENSSL_RAW_DATA, $iv);
    return rtrim(strtr(base64_encode($iv . $encriptado), '+/', '-_'), '=');
}

/**
 * Desencripta strings encriptados.
 * solo strings encriptados con -- encriptar() --
 * not null
 * 
 * @param string $datoADesencriptar El string de entrada. 
 * @return string Devuelve el string modificado a datos legibles.
 */
function desencriptar($datoADesencriptar){
    $passwordSave = "qwerty";
    $data = str_pad(strtr($datoADesencriptar, '-_', '+/'), strlen($datoADesencriptar) % 4, '=', STR_PAD_RIGHT);
    $data = base64_decode($data);
    $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $desencriptado = openssl_decrypt(substr($data, openssl_cipher_iv_length('aes-256-cbc')), 'aes-256-cbc', md5($passwordSave), OPENSSL_RAW_DATA, $iv);
    return $desencriptado;
}