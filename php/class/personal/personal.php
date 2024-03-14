<?php

/**
 * Obtener datos de personal
 * 
 * ----------- _n o t a_ -----------
 * 
 * string de entrada debe estar codificado 
 * usar funcion getUserData(); sino se tiene hash de entrada (CI condificado)
 */
abstract class Personal
{
    /**
     * Summary of ci
     * @var 
     */
    public $ci;
    /**
     * Summary of nombre
     * @var 
     */
    public $nombre;
    /**
     * Summary of apellido
     * @var 
     */
    public $apellido;
    /**
     * Summary of conexion
     * @var 
     */
    protected $conexion;

    /**
     * Utilizar Hash de entrada encriptado de getUserHash este != personal->hash
     * @param mixed $ci
     */
    public function __construct($ci)
    {
        $this->ci = desencriptar($ci);

        $this->conexion = new Conexion;

        $consulta = "SELECT * FROM personal WHERE ci = '$this->ci'";

        $sentencia = $this->conexion->query($consulta);

        if ($sentencia->num_rows > 0) {
            $data = $sentencia->fetch_array();

            $this->nombre = strtolower($data['nombre']);
            $this->apellido = strtolower($data['apellido']);
        }
    }

    /**
     * Obtener datos del personal
     * @return PersonalDetails
     */
    public function getDetails()
    {

        $consulta = "SELECT * FROM personal p
                         INNER JOIN estados e ON p.id_estado = e.id_estado
                         INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                         INNER JOIN sedes s ON p.sede_id = s.sede_id
                         INNER JOIN cargo g ON g.id_cargo = p.cargo
                         INNER JOIN departamentos d ON d.id_direccion = p.departamento
                         WHERE p.ci = '$this->ci'";

        $sentencia = $this->conexion->query($consulta);

        if ($sentencia->num_rows > 0) {
            $detail = new PersonalDetails($sentencia->fetch_array());
        }

        return $detail;
    }
}