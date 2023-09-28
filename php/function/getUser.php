<?php

/**
 * Obtener nombre de usuario mediante ID o CI
 * @param string|null $id ID de usuario
 * @param string|null $ci CI de usuario [ es necesario que este encriptada ]
 * @return void nombre de Usuario
 */
function getUser($id = null , $ci = null)
{
    $conn = new Conexion;
    switch (true) {
        case ($ci == null);
            $sql = "SELECT user FROM registro WHERE id_usuario = $id";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = $q['user'];
            } else {
                $data = "Error al optener Username";
            }
            break;
        case ($id == null):
            $ci = $conn->real_escape(desencriptar($ci));

            $sql = "SELECT user FROM registro WHERE ci = $ci";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = $q['user'];
            } else {
                $data = "Error al optener Username";
            }
            break;
        case ($id == null && $ci == null):
            echo 'variables vacias';
            break;

        case ($id != null && $ci != null):
            $sql = "SELECT user FROM registro WHERE id_usuario = $id";

            if ($row = $conn->query($sql)) {
                $q = mysqli_fetch_assoc($row);
                $data = $q['user'];
            } else {
                $data = "Error al optener Username";
            }
            break;  
    }
    $conn->close();
    return $data;
}