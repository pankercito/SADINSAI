<?php


class PersonalDetails
{
    public $grado;
    public $fecha;
    public $telefono;
    public $email;
    public $direccion;
    public $estado;
    public $idEstado;
    public $ciudad;
    public $idCiudad;
    public $sede;
    public $idSede;
    public $cargo;
    public $idCargo;
    public $sexo;
    public $departamento;
    public $idDepartamento;

    public function __construct($data)
    {
        if (is_array($data)) {

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
    }

    /**
     * Summary of setValoresPorDefecto
     * @return void
     */
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
}