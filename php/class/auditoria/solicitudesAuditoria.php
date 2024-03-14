<?php

/**
 * Auditoria sobre solicitudes del sistema
 */
class SolicitudesAuditoria extends Auditoria
{
    private $idSoli;

    /**
     * Summary of __construct
     */
    public function __construct($idSoli)
    {
        if ($idSoli == '') {
            throw new Exception("Error Processing Request", 1);
        }
        @session_start();

        parent::__construct();

        $this->idSoli = $this->connec->real_escape($idSoli);
    }

     /**
     * Summary of regisAceptacionSolicitudes
     * @param mixed $idSoli
     * @param mixed $array
     * @return bool
     */
    public function creacionDeSolicitudes()
    {
        $inf = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = {$this->idSoli}");
        $soli = $inf->fetch_object();

        $nombres = [
            '1' => "anticipo",
            '2' => "permiso",
            '3' => "vacaciones",
            '4' => "carta de aval",
            '5' => "licencia de paternidad"
        ];

        $d = 'Creacion de solicitud de planilla por ' . $this->username . '. Id de solicitud: ' . $this->idSoli . '. Solicitante: ' . $soli->ci_permiso . '. <br> Tipo: ' . $nombres[$soli->tipo_permiso] . ' -- ';

        $cambios = $soli->data_solicitudes;

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($cambios as $clave => $valor) {
            $d .= "{$clave}: {$valor} == ";
        }

        $contenido = $this->connec->real_escape($d);
        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 14, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of regisAceptacionSolicitudes
     * @param mixed $idSoli
     * @param mixed $array
     * @return bool
     */
    public function aceptacionDeSolicitudes($array)
    {
        $inf = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = {$this->idSoli}");
        $soli = $inf->fetch_object();

        $nombres = [
            '1' => "anticipo",
            '2' => "permiso",
            '3' => "vacaciones",
            '4' => "carta de aval",
            '5' => "licencia de paternidad"
        ];

        $d = 'Aceptacion de solicitud de planilla por ' . $this->username . '. Id de solicitud: ' . $this->idSoli . '. Solicitante: ' . $soli->ci_permiso . '. <br> Tipo: ' . $nombres[$soli->tipo_permiso] . ' -- ';

        $cambios = $array;

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($cambios as $clave => $valor) {
            $d .= "{$clave}: {$valor} -- ";
        }

        $contenido = $this->connec->real_escape($d);
        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 9, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro de rechazo de solicitude para [sadinsai.auditoria]
     * @return bool
     */
    public function rechazoDeSolicitudes()
    {
        $inf = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = {$this->idSoli}");
        $soli = $inf->fetch_object();

        $nombres = [
            '1' => "anticipo",
            '2' => "permiso",
            '3' => "vacaciones",
            '4' => "carta de aval",
            '5' => "licencia de paternidad"
        ];

        $d = 'Rechazo de solicitud por ' . $this->username . '. Id de solicitud: ' . $this->idSoli . ', dirigida a: ' . $soli->ci_permiso . '. Tipo: ' . $nombres[$soli->tipo_permiso];

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 10, NOW())");
        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}