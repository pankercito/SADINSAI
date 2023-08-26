<?php

class based
{
    protected $connec;
    public $aplicacion;

    public function __construct()
    {
        //Creamos el obj, instanciando la clase Conexion()
        $this->connec = new Conexion();
        $this->aplicacion = array();
    }
}

/**
 * Gestion de datos de un usuario
 */
class auditoria  extends based {  
    private $idEntrada;
    private $arrayEntrada;
 
    public function get_usuarionum($search)
    {
        $query = $this->connec->query("SELECT * FROM registro WHERE id_usuario = '" . $search . "'");
        $result = $query->fetch_row();

        echo $result[0];
    }
    /**
     * Registro de salida de sesion en BD
     * @param string $idEntrada ID de usuario 
     * @return bool
     */
    public function auditoriaSesionInit($idEntrada)
    {

        $query = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, userName, fecha, entradaSalida) VAlUES ('$idEntrada', 'nada', now(), 1)");
    
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
    public function auditoriaSesionClose($idEntrada)
    {

        $sql = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, userName, fecha, entradaSalida) VAlUES ('$idEntrada', 'nada', now(), 0)");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registrar Cambios por el usuario
     * @param $arrayEntrada
     * @return mixed
     */
    public function RegistrarCambios()
    {        /// XDD,así no brou pero bueno, lo importante qué funcione

        $sql = "SELECT * FROM registro_entrada_salida";
    
    }
}