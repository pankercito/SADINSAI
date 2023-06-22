<?php

class Personal {
    private $ci;

    public function __construct($ci) {
        $this->ci = $ci;
        $this->loadData();
    }   

    private function loadData() {
        include('../php/conect.php');
        
        $pCi = $this->ci;

        if ($pCi != '') {
            
            $pCi = desencriptar($this->ci);

            $cnce = mysqli_query($connec, "SELECT * FROM personal p
                                           INNER JOIN estados e ON p.id_estado = e.id_estado
                                           INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                                           INNER JOIN sedes s ON p.sede_id = s.sede_id
                                           WHERE p.ci = $pCi");

            $count_results = mysqli_num_rows($cnce);

            if ($count_results > 0) {
                $perfils = mysqli_fetch_array($cnce);

                $this->nombre = ucwords(strtolower($perfils['nombre']));
                $this->apellido = ucwords(strtolower($perfils['apellido']));
                $this->telefono = $perfils['telefono'];
                $this->ci = $perfils['ci'];
                $this->email = strtolower($perfils['email']);
                $this->direccion = ucfirst($perfils['direccion']);
                $this->estado = $perfils['estado'];
                $this->idEstado = $perfils['id_estado'];
                $this->ciudad = $perfils['ciudad'];
                $this->idCiudad = $perfils['id_ciudad'];
                $this->sede = $perfils['nombre_sede'];
                $this->idSede = $perfils['sede_id'];
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
        }else{
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

        $connec->close();
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getCi() {
        return $this->ci;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getIdEstado() {
        return  $this->idEstado;
    }
    public function getCiudad() {
        return $this->ciudad;
    }
    public function getIdCiudad() {
        return $this->idCiudad;
    }
    public function getSede() {
        return $this->sede;
    }
    public function getIdSede() {
        return $this->idSede;
    }
}
