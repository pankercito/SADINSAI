<?php

/**
 * Obtener nombre de usuario mediante ID o CI
 * @param mixed $id ID de usuario
 * @param mixed $ci CI de usuario [ es necesario que este encriptada ]
 * @return void nombre de Usuario
 */
function getUser($id, $ci)
{
    $conn = new Conexion;
    switch (true) {
        case ($id == '' && $ci != ''):
            $ci = $conn->real_escape(desencriptar($ci));

            $sql = "SELECT user FROM registro WHERE ci = $ci";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = $q['user'];
            } else {
                $data = "Error al optener Username";
            }
            break;
        case ($id != '' && $ci == ''):

            $sql = "SELECT user FROM registro WHERE id_usuario = $id";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = $q['user'];
            } else {
                $data = "Error al optener Username";
            }
            break;
        case ($id == '' && $ci == ''):
            echo 'error';
            break;
        case ($id != '' && $ci != ''):
            echo 'error';
            break;
        case ($id == $ci):
            echo 'error';
            break;
    }
    $conn->close();
    return $data;
}