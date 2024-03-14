<?php

// PARAMETROS DE BASE DE DATOS
const HOST = 'localhost';
const USUARIO = 'root';
const PASS = '';
const BASEDATA = 'sadinsai';

/**
 * inicializa conexion con base de datos
 */
class Conexion
{
    private $connec;

    public function __construct()
    {
        try {
            $this->connec = new mysqli(HOST, USUARIO, PASS, BASEDATA);
            if (mysqli_connect_errno()) {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
            // Add error handling based on your application logic (e.g., log the error, display a message to the user)
            exit(); // Terminate script execution to avoid further issues
        }
    }

    /**
     
     * inicializar query a BD
     * @param mixed $query instruciones a base de datos
     * @return bool|mysqli_result
     */
    public function query($query)
    {
        return $this->connec->query($query);
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
    public function close()
    {
        return mysqli_close($this->connec);
    }

    /**
     * Summary of error
     * @return string
     */
    public function error()
    {
        return mysqli_error($this->connec);

    }

    /**
     * Devuelve numero de filas afectadas por la ultima consulta
     * @return int|string

     */
    public function affected_rows()
    {
        return mysqli_affected_rows($this->connec);
    }
}