<?php

/**
 * Auditoria para usuarios del sistema
 */
class UserAuditoria extends Auditoria
{
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Registro de salida de sesion en BD
     * @return bool
     */
    public function inicioDeSesion(): bool
    {
        $query = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida, user_name) VAlUES ('{$this->id}', now(), 1, '{$this->username}')");

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro de entrada de sesion en BD
     * @param string $idEntrada ID de usuario 
     * @return bool
     */
    public function cierreDeSesion(): bool
    {
        $sql = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida, user_name) VAlUES ('$this->id', now(), 0, '{$this->username}{}')");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro del registro de nuevos usuarios para [sadinsai.auditoria]
     * @return bool
     */
    public function registroDeUsuario(): bool
    {
        $userN = $this->connec->real_escape($_POST['user']);

        $d = 'Registro de nuevo usuario por: ' . $this->username . '. Nuevo usuario: ' . strtoupper($userN);

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 5, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda en la Bade de Datos registro de activacion y desactivacion de usuarios
     * @return bool
     */
    public function accionSobreUsuario(): bool
    {
        @session_start();

        @$user = $this->connec->real_escape($_POST['userId']) ?: $this->id;
        @$radio = $this->connec->real_escape($_POST['radio']);

        $registro1 = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $user");

        $fc = $registro1->fetch_object(); // usuario pasivo

        $a = ($radio == 1) ? 'Activacion de usuario ' : 'Desactivacion de usuario ';

        @$d = $a . 'por: ' . $this->username . ', hacia el usuario: ' . $fc->user;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 6, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Registro de Eliminacion de Usuario
     * @return void
     */
    public function eliminacionDeUsuario(): bool
    {
        @session_start();

        $user = new User(getUserHash($this->connec->real_escape($_POST['userId'])));

        $d = "Eliminacion de usuario por {$this->username}. a {$user->usuario} - usuario de {$user->ci}";

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 6, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}