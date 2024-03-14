<?php

/**
 * Auditoria sobre gestiones del sistema
 */
class AuditoriaGeneral extends Auditoria
{
    public function __construct()
    {
        parent::__construct();
    }

    public function nuevaSede($array)
    {
        $sede = $array['sede'];
        $estado = $array['estado'];

        $d = "Nueva sede agregada por {$this->username}, sede agregada: {$sede}, ubicada en: {$estado}";

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 12, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    public function nuevoCargo($array)
    {
        $sede = $array;

        $d = "Nuevo cargo agregado por {$this->username}, nombre del cargo: {$sede}";

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 13, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of cambioDeRequerimientos
     * @param mixed $ci
     * @param mixed $data
     * @return bool
     */
    public function cambioDeRequerimientos($ci, $data): bool
    {
        $contenido = "Cambios por {$this->username}, en los requerimientos de: {$ci} -- " . $data;

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 11, NOW())");
        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

}