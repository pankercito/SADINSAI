<?php


/**
 * Controlador de UserCase de usuario
 * incluir junto a este la funcion UserData
 */
class SystemUser
{
    /**
     * Summary of connec
     * @var 
     */
    private $connec;
    /**
     * Summary of sesion
     * @var 
     */
    private $userLogged;

    /**
     * Summary of __construct
     * @param mixed $id
     */
    public function __construct()
    {
        @session_start();
        $this->userLogged = new User(getUserHash($_SESSION['sesion'])) ?? null;

        $this->connec = new Conexion;
    }

    /**
     * Obtener listado de usuarios totales en el sistema
     * @param  string $yo sesion de usuario q no es visible en los resultado
     * @return  array<User>
     */
    public function userListSystem()
    {
        $regisview = $this->connec->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci");

        //Si ha resultados
        if (mysqli_num_rows($regisview) > 1) {

            $v = [];
            while ($v = $regisview->fetch_object()) {
                // Poner los Instancias de Usuarios dentro de un array
                $data[] = new User(getUserHash($v->id_usuario));
            }
            // crear un array con el array de los datos
            $new_array = [$data];
        } else {
            //Si no hay registros encontrados
            $data[] = [
                " ",
                " ",
                "sin informacion",
                " ",
                " "
            ];

            $new_array = [$data];
        }

        return $new_array;
    }

    /**
     * Obtener listado de usuarios totales en el sistema
     * @param  string $yo sesion de usuario q no es visible en los resultado
     * @return  array<User> $result array 
     */
    public function usersList()
    {
        $regisview = $this->connec->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci ORDER BY r.sesion DESC");

        // verificacion de tipo de usuario
        $verifi = $this->connec->query("SELECT * FROM registro WHERE id_usuario = '{$this->userLogged->getUserId()}'");
        $yoadp = $verifi->fetch_object();

        //Si ha resultados
        if (mysqli_num_rows($regisview) > 1) {

            $v = [];
            while ($v = $regisview->fetch_object()) {
                if ($this->userLogged != $v->id_usuario) {
                    if ($v->adp != 2) {
                        // Poner los datos en un array en el orden de los campos de la tabla
                        $data[] = new User(getUserHash($v->id_usuario));
                    }
                }
            }
        } else {
            //Si no hay registros encontrados
            $data[] = [
                " ",
                " ",
                "sin informacion",
                " ",
                " "
            ];
        }

        return $data;
    }

    public function adpUserLogged() : int {
        return $this->userLogged->adp;
    }
}