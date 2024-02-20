<?php

class UserModel
{
    private $conn;
    public $user;
    public $nombre;
    public $apellido;
    public $ci;
    public $id;
    public $adp;
    public $active;
    public $sesion;
    public $pin;
    public $hash;

    function __construct($userparam)
    {
        $this->conn = new Conexion;

        $data = $this->conn->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci WHERE r.user = '$userparam'");

        if ($data != null) {

            $mercer = $data->fetch_object();

            $this->user = $mercer->user;
            $this->nombre = $mercer->nombre;
            $this->apellido = $mercer->apellido;
            $this->ci = $mercer->ci;
            $this->id = $mercer->id_usuario;
            $this->adp = $mercer->adp;
            $this->active = $mercer->active;
            $this->sesion = $mercer->sesion;
            $this->hash = $mercer->pass;
            $this->pin = $mercer->pass;
        }
    }
}
