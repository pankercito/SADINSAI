<?php

/**
 * Gestion de datos del sistema
 * movimientos
 * usuarios
 * solicitudes
 * Data de personal
 * registro de cambios
 * promedios de movimientos
 */
abstract class Auditoria
{
    protected $connec;
    private $user;
    protected $id;
    protected $username;

    /**
     * inicializando conexion global
     * REORDENAR REGISTROS
     * REORDENAR USUARIOS
     */
    public function __construct()
    {
        @session_start();

        //Creamos el obj, instanciando la clase Conexion()
        $this->connec = new Conexion();

        // REORDENAR REGISTROS
        $this->connec->query("SET @autoid := 0");
        $this->connec->query("UPDATE auditoria SET id = (@autoid := @autoid + 1)");
        $this->connec->query("ALTER TABLE auditoria AUTO_INCREMENT = 1");

        // REORDENAR USUARIOS
        $this->connec->query("SET @autoid := 0");
        $this->connec->query("UPDATE registro SET id_usuario = (@autoid := @autoid + 1)");
        $this->connec->query("ALTER TABLE registro AUTO_INCREMENT = 1");

        $this->userDeclare();
    }

    private function userDeclare()
    {
        $this->user = new User(getUserHash($_SESSION['sesion']));
        $this->id = $this->user->getUserId();
        $this->username = $this->user->usuario;
    }
}