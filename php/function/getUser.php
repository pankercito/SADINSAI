<?php

if (!function_exists('encriptar')) {
    include "criptCodes.php";
}

/**
 * Obtener hash de usuario mediante ID o CI
 * >>>>_NOTA_
 * >no olvidar orden de parametros no olvidar
 * 
 * ###########################################
 * @param string|null $id ID de usuario
 * @param string|null $ci CI de usuario 
 * @param string|null $user NOMBRE de usuario 
 * @return string hash de Usuario
 */
function getUserHash($id = null, $ci = null, $user = null)
{
    $conn = new Conexion;

    switch (true) {
        case($ci == null && $user == null);
            $sql = "SELECT * FROM registro WHERE id_usuario = $id";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = encriptar($q['ci']);
            } else {
                $data = "Error al optener data del usuario";
            }
            break;
        case($id == null && $user == null):
            $ci = $conn->real_escape($ci);

            $sql = "SELECT * FROM registro WHERE ci = $ci";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = encriptar($q['ci']);
            } else {
                $data = "Error al optener data del usuario";
            }
            break;

        case($id == null && $ci == null):
            $sql = "SELECT * FROM registro WHERE user = '$user'";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = encriptar($q['ci']);
            } else {
                $data = "Error al optener data del usuario";
            }
            break;
        case($id != null && $ci != null && $user != null):
            $sql = "SELECT * FROM registro WHERE user = '$user'";

            $a = $conn->query($sql);

            if ($a) {
                $row = $a->fetch_assoc();
                $data = encriptar($row['ci']);
            } else {
                echo $conn->error();
                $data = "Error al optener data del usuario";
            }
            break;

        default:
            throw new Exception("sin parametro de entrada", 1);

    }
    $conn->close();

    return $data;
}
