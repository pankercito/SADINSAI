<?php

class AuditoriaSolicitudes extends Auditoria
{

    public function __construct(){
        parent::__construct(); 
    }

    public function regisAceptacionSolicitudes($idSoli, $array)
    {
        @session_start();

        $ID = $_SESSION['sesion'];

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = $idSoli");
        $ci = $inf->fetch_object();

        $nombres = [
            '1' => "anticipo",
            '2' => "permiso",
            '3' => "vacaciones",
            '4' => "carta de aval",
            '5' => "licencia de paternidad"
        ];

        $d = 'Aceptacion de Solicitud de planilla/permiso por ' . $fr->user . '. Id de solicitud: ' . $idSoli . '. Solicitante: ' . $ci->ci_permiso . '. <br> Tipo: ' . $nombres[$ci->tipo_permiso] . ' -- ';

        $cambios = $array;

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($cambios as $clave => $valor) {

            $d .= "{$clave}: {$valor} -- ";

        }

        $contenido = $this->connec->real_escape($d);
        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 9, NOW())");

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
    public function registSolisRechaz($idSoli)
    {
        @session_start();

        $ID = $_SESSION['sesion'];

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = $idSoli");
        $ci = $inf->fetch_object();

        $nombres = [
            '1' => "anticipo",
            '2' => "permiso",
            '3' => "vacaciones",
            '4' => "carta de aval",
            '5' => "licencia de paternidad"
        ];

        $d = 'Rechazo de solicitud por ' . $fr->user . '. Id de solicitud: ' . $idSoli . ', dirigida a: ' . $ci->ci_permiso . '. Tipo: ' . $nombres[$ci->tipo_permiso];

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 10, NOW())");
        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}
