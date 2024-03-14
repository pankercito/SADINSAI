<?php


/**
 * UseCase de Usuarios del sistema
 */
class UserUseCase
{
    /**
     * Summary of id
     * @var 
     */
    private $id;
    /**
     * Summary of connec
     * @var 
     */
    private $connec;

    /**
     * Summary of auditoria
     * @var 
     */
    private $auditoria;

    /**
     * Summary of user
     * @var 
     */
    private $user;

    /**
     * Summary of __construct
     * @param mixed $id
     */
    public function __construct(User $user)
    {
        @session_start();

        $this->connec = new Conexion;
        $this->auditoria = new UserAuditoria();

        $this->user = $user;
        $this->id = $this->user->getUserId();
    }

    /**
     * Desactivar usuario
     * @return bool
     */
    public function inhabilitarUsuario()
    {
        $si = $this->connec->query("UPDATE registro SET active = 3 WHERE id_usuario = {$this->id}");

        if ($this->user->active != 0) {
            $this->auditoria->accionSobreUsuario();
        }

        if ($si) {
            return true;
        }
        return false;
    }

    /**
     * Desactivar usuario
     * @return bool
     */
    public function desactivarUsuario()
    {
        $si = $this->connec->query("UPDATE registro SET active = 0 WHERE id_usuario = {$this->id}");

        if ($this->user->active != 0) {
            $this->auditoria->accionSobreUsuario();
        }

        if ($si) {
            return true;
        }
        return false;
    }

    /**
     * Activar usuario
     * @param mixed $this->id id de usuario
     * @param mixed $senha ci (opcional)
     * @return bool
     */
    public function activarUsuario()
    {
        $si = $this->connec->query("UPDATE registro SET active = 1 WHERE id_usuario = '$this->id'");

        if ($si && $this->auditoria->accionSobreUsuario()) {
            return true;
        }
        return false;
    }

    /**
     * Eliminar Usuario del Sistema
     * @param mixed $this->id id de usuario
     * @param mixed $senha ci (opcional)
     * @return bool
     */
    public function eliminarUsuario()
    {
        if ($this->user->active != 0) {
            throw new Exception("Error Processing Request", 1);
        }

        $a = $this->auditoria->eliminacionDeUsuario();

        $si = $this->connec->query("DELETE FROM registro WHERE id_usuario = '$this->id'");

        if ($si && $a) {
            return true;
        }
        return false;
    }

    /**
     * Summary of validarUsuario
     * @param mixed $hash
     * @param mixed $usuario
     * @return int
     */
    public function validarUsuario($hash, $usuario)
    {
        // si el usuario esta desactivado
        if ($this->user->active == 0) {
            header('location:../index.php?userdes=true');
            exit;
        }

        // si el usuario esta inhabilitado
        if ($this->user->active == 2) {
            header('location:../index.php?userinhal=true');
            exit;
        }

        if ($hash == desencriptar($this->user->getHash())) { //contraseña correcta 
            $resultado = 1;
        } else {
            if (!isset($_SESSION['errorContra'])) {
                $_SESSION['errorContra'] = 1;
            }

            if ($_SESSION['errorName'] != $usuario) {
                $_SESSION['errorContra'] = 1;
            }

            if ($_SESSION['errorContra'] == 3 && $_SESSION['errorName'] == $usuario) {
                $this->desactivarUsuario();
                $_SESSION['errorContra'] = 0;
                $resultado = 2;
            } else {
                $_SESSION['errorContra']++;
                $_SESSION['errorName'] = $usuario;
                $resultado = 3;
            }
        }

        return $resultado;
    }

    /**
     * Iniciar sesion en la base de datos
     * @return bool
     */
    public function inicioDeSesion()
    {
        $ssn = $this->connec->query("UPDATE registro SET sesion = '1' WHERE id_usuario = '$this->id'");

        if ($ssn) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Cerrar sesion en la base de datos
     * @param string $user ID de usuario
     * @return bool
     */
    public function cierreDeSesion()
    {
        $ssn = $this->connec->query("UPDATE registro SET sesion = '0' WHERE id_usuario = '$this->id'");

        if ($ssn) {
            return true;
        } else {
            return false;
        }
    }


    public function cambiarHash($tring)
    {
        $hash = encriptar($tring);

        $q = $this->connec->query("UPDATE registro SET pass = '$hash' WHERE id_usuario  = '$this->id'");

        if ($q) {
            return true;
        } else {
            return false;
        }
    }
}