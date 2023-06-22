<?php

class Departamento{
    public $Trabajadores;
    public $Estrategias;
    public $Areas;

    public function
    __construct($Trabajadores, $Estrategias, $Areas){
        $this->Trabajadores = $Trabajadores;
        $this->Estrategias = $Estrategias;
        $this->Areas = $Areas;
    }

    public function conteo(){
        echo "en el departamento hay :". $this->Trabajadores . " trabajadores, cada uno usa: " . $this->Estrategias ." estrategias
         y estan divididos en: ". $this->Areas. " areas";
    }
}


$previo = new Departamento("223", "2", "12");

$previo->conteo();



