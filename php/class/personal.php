<?php

/**
 * Obtener datos de personal mediante CI
 * ----------- _n o t a_ -----------
 * 
 * string de entrada debe estar codificado
 */
class Personal
{
    private $ci;
    private $nombre;
    private $apellido;
    private $grado;
    private $sexo;
    private $fecha;
    private $telefono;
    private $departamento;
    private $idDepartamento;
    private $email;
    private $direccion;
    private $estado;
    private $idEstado;
    private $ciudad;
    private $idCiudad;
    private $sede;
    private $idSede;
    private $cargo;
    private $idCargo;
    private $conexion;

    public function __construct($ci)
    {
        $this->ci = $ci;
        $this->conexion = new Conexion;
        $this->getDatos();
    }

    private function getDatos()
    {
        $pCi = desencriptar($this->ci);

        if (ctype_digit($pCi)) {
            $consulta = "SELECT * FROM personal p
                         INNER JOIN estados e ON p.id_estado = e.id_estado
                         INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                         INNER JOIN sedes s ON p.sede_id = s.sede_id
                         INNER JOIN cargo g ON g.id_cargo = p.cargo
                         INNER JOIN departamentos d ON d.id_direccion = p.departamento
                         WHERE p.ci = '$pCi'";

            $sentencia = $this->conexion->query($consulta);

            if ($sentencia->num_rows > 0) {
                $data = $sentencia->fetch_array();

                $this->ci = $data['ci'];
                $this->nombre = ucwords(strtolower($data['nombre']));
                $this->apellido = ucwords(strtolower($data['apellido']));
                $this->grado = strtolower($data['grado_ac']);
                $this->fecha = $data['fecha_nac'];
                $this->telefono = $data['telefono'];
                $this->email = strtolower($data['email']);
                $this->direccion = ucwords(strtolower($data['direccion']));
                $this->estado = $data['estado'];
                $this->idEstado = $data['id_estado'];
                $this->ciudad = $data['ciudad'];
                $this->idCiudad = $data['id_ciudad'];
                $this->sede = $data['nombre_sede'];
                $this->idSede = $data['sede_id'];
                $this->cargo = $data['cargo_nombre'];
                $this->idCargo = $data['cargo'];
                $this->sexo = strtolower($data['sexo']);
                $this->departamento = ucwords(strtolower($data['dir_nombre']));
                $this->idDepartamento = $data['departamento'];
            } else {
                $this->setValoresPorDefecto();
            }
        } else {
            $this->setValoresPorDefecto();
        }

        $sentencia->close();
        $this->conexion->close();
    }

    private function setValoresPorDefecto()
    {
        $this->nombre = "Sin datos";
        $this->apellido = "Sin datos";
        $this->telefono = "Sin datos";
        $this->ci = "Sin datos";
        $this->email = "Sin datos";
        $this->direccion = "Sin datos";
        $this->estado = "Sin datos";
        $this->idEstado = "Sin datos";
        $this->ciudad = "Sin datos";
        $this->idCiudad = "Sin datos";
        $this->sede = "Sin datos";
        $this->idSede = "Sin datos";
        $this->cargo = "Sin datos";
        $this->idCargo = "Sin datos";
        $this->fecha = "Sin datos";
        $this->sexo = "Sin datos";
        $this->grado = "Sin datos";
        $this->departamento = "Sin datos";
        $this->idDepartamento = "Sin datos";
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getCi()
    {
        return $this->ci;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return mixed|string estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return mixed|string ID estado
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @return mixed|string Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @return mixed|string ID Ciudad
     */
    public function getIdCiudad()
    {
        return $this->idCiudad;
    }

    /**
     * @return mixed|string Sede
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * @return mixed|string ID Sede
     */
    public function getIdSede()
    {
        return $this->idSede;
    }

    /**
     * @return mixed|string cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }
    /**
     * @return mixed|string ID cargo
     */
    public function getIdCargo()
    {
        return $this->idCargo;
    }

    /**
     * @return mixed
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    
    /**
     * @return mixed
     */
    public function getDepartament()
    {
        return $this->departamento;
    }


    /**
     * @return mixed
     */
    public function getIdDepart()
    {
        return $this->idDepartamento;

    }

    
}