<?php

/**
 * Usuario del Sistema
 */
class User extends Personal
{
    /**
     * Summary of usuario
     * @var 
     */
    public $usuario;
    /**
     * Summary of id
     * @var 
     */
    private $id;
    /**
     * Summary of adp
     * @var 
     */
    public $adp;
    /**
     * Summary of active
     * @var 
     */
    public $active;
    /**
     * Summary of sesion
     * @var 
     */
    public $sesion;
    /**
     * Summary of pin
     * @var 
     */
    private $pin;
    /**
     * Summary of hash
     * @var 
     */
    private $hash;

    /**
     * Summary of __construct
     * @param mixed $userparam
     */
    public function __construct($userparam)
    {
        @session_start();

        parent::__construct($userparam);

        $data = $this->conexion->query("SELECT * FROM registro WHERE ci = '{$this->ci}'");

        if ($data != null) {

            $mercer = $data->fetch_object();

            if (!isset($_SESSION['sesion'])) {
                $_SESSION['sesion'] = $mercer->id_usuario;
            }

            $this->usuario = $mercer->user;
            $this->id = $mercer->id_usuario;
            $this->adp = $mercer->adp;
            $this->active = $mercer->active;
            $this->sesion = $mercer->sesion;
            $this->hash = $mercer->pass;
            $this->pin = $mercer->pin;
        }
    }

    /**
     * Summary of getHash
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Summary of getPin
     * @return int
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Summary of getUserId
     * @return int
     */
    public function getUserId()
    {
        return $this->id;
    }
}
