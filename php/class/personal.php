<?php
/**
 * Obtener datos de personal mediante CI
 * ----------- _n o t a_ ------------
 * 
 * string de entrada debe estar codificado
 */
class Personal
{
    private $ci;
    private $nombre;
    private $apellido;
    private $telefono;
    private $email;
    private $direccion;
    private $estado;
    private $idEstado;
    private $ciudad;
    private $idCiudad;
    private $sede;
    private $idSede;
    private $connec;

    /**
     * Summary of __construct
     * @param mixed $ci
     */
    public function __construct($ci)
    {   
        $this->connec = new Conexion();
        $this->ci = $ci;
        $this->getDatos();
    }

    /**
     * Summary of getDatos
     * @return void
     */
    private function getDatos()
    {

        $pCi = $this->ci;

        if ($pCi != '') {

            $pCi = desencriptar($this->ci);

            $cnce = $this->connec->query("SELECT * FROM personal p
                                           INNER JOIN estados e ON p.id_estado = e.id_estado
                                           INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                                           INNER JOIN sedes s ON p.sede_id = s.sede_id
                                           WHERE p.ci = $pCi");

            $count_results = mysqli_num_rows($cnce);

            if ($count_results > 0) {
                $data = mysqli_fetch_array($cnce);

                $this->nombre = ucwords(strtolower($data['nombre']));
                $this->apellido = ucwords(strtolower($data['apellido']));
                $this->telefono = $data['telefono'];
                $this->ci = $data['ci'];
                $this->email = strtolower($data['email']);
                $this->direccion = ucwords(strtolower($data['direccion']));
                $this->estado = $data['estado'];
                $this->idEstado = $data['id_estado'];
                $this->ciudad = $data['ciudad'];
                $this->idCiudad = $data['id_ciudad'];
                $this->sede = $data['nombre_sede'];
                $this->idSede = $data['sede_id'];
            } else {
                $this->nombre = "Sin datos";
                $this->apellido = "Sin datos";
                $this->telefono = "Sin datos";
                $this->email = "Sin datos";
                $this->direccion = "Sin datos";
                $this->estado = "Sin datos";
                $this->idEstado = "Sin datos";
                $this->ciudad = "Sin datos";
                $this->idCiudad = "Sin datos";
                $this->sede = "Sin datos";
                $this->idSede = "Sin datos";
            }
        } else {
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
        }
    }

    /**
     * @return string nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    /**
     * @return string apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }
    /**
     * @return mixed|string ci desencriptada
     */
    public function getCi()
    {
        return $this->ci;
    }
    /**
     * @return mixed|string telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @return string direccion
     */
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
}