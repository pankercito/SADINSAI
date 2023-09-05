<?php
/**
 * inicializa conexion con base de datos
 */
class Conexion
{
    protected $connec;

    public function __construct()
    {
        $this->connec = new mysqli("localhost", "root", "", "sadinsai");
    }

    /**
     * inicializar query a BD
     * @param mixed $query instruciones a base de datos
     * @return bool | mysqli_result resultado del query
     */
    public function query($query)
    {
        $a = $this->connec->query($query);
        return $a;
    }
    /**
     * Escapa texto para evitar inyeciones por input
     * @param mixed $texto entrada a escapar
     * @return string texto espacado
     */
    public function real_escape($texto)
    {
        return mysqli_real_escape_string($this->connec, $texto);
    }

    /**
     * cerrar concexion con base de datos 
     * @param mixed $conn es conexion 
     * @return bool mysqli_result 
     */
    public function close(){
        return mysqli_close($this->connec);
    }
}