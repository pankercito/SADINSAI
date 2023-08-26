<?php

 class Conexion
{
    protected $connec;

    public function __construct()
    {
        $this->connec = new mysqli("localhost", "root", "", "sadinsai");
    }

    public function query($query)
    {
        $a = $this->connec->query($query);
        return $a;
    }
}