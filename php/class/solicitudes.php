<?php

/**
 * Retorna creacion o obtencion de planilla 
 * define constantes de tipo
 * 
 * ---------------
 * _metodos_
 * CrearSolicitud
 * obtenerSolicitud
 */
class Solicitud
{
    const de_anticipo = 1;
    const de_permiso = 2;
    const de_vacaciones = 3;
    const de_carta_aval = 4;
    const de_licencia_paternidad = 5;

    /**
     * Devuelve una instancia de CtrSolicitudes
     * @param mixed $tipo constantes de solicitud solicitud::[tipo_de_solicitud]
     * @param mixed $array datos de solicitud
     * @param mixed $paraquien ci de solicitante
     * @return CrSolicitudes
     */
    public static function crearSolicitud($tipo, $array, $paraquien)
    {
        return new CrSolicitudes($tipo, $array, $paraquien);
    }

    /**
     * Devuelve una instancia de obtSolicitudes
     * @param mixed $id null para obtener todas las solicitudes del sistema
     * @return ObtSolicitudes
     */
    public static function obtenerSolicitud($id = null)
    {
        if (is_null($id)) {
            return new ObtSolicitudes();
        } else {
            return new ObtSolicitudes($id);
        }
    }
}

/**
 * - Crear solicitudes y permisos 
 * - Cargar solicitudes creadas
 */
class CrSolicitudes
{
    /**
     * Summary of tipo
     * @var 
     */
    private $tipo;
    /**
     * Summary of data
     * @var 
     */
    private $data;
    /**
     * Summary of forWho
     * @var 
     */
    private $forWho;

    private $auditoria;

    /**
     * Summary of conn
     * @var 
     */
    private $conn;

    /**
     * Summary of __construct
     * @param mixed $tipo
     * @param mixed $array
     * @param mixed $forWho
     */
    public function __construct($tipo, $array, $paraquien)
    {
        $this->conn = new Conexion;
        $this->tipo = $this->conn->real_escape($tipo);
        $this->forWho = $this->conn->real_escape($paraquien);
        $this->data = $array;
    }

    /**
     * Carga en la base de datos la solicitud creada
     * @return 
     */
    public function cargar()
    {
        $b = array_keys($this->data);
        $arryData = '';
        foreach ($b as $key) {
            $arryData .= $key . ": " . $this->data[$key] . " -- ";
        }

        //VALIDA ID EN LA BASE DE DATOS
        do {
            $id = generarId();

            $sql = $this->conn->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = $id");
            $dan = $sql->num_rows;

        } while ($dan != 0);

        $data = $this->conn->real_escape($arryData);

        $q = $this->conn->query("INSERT INTO solicitudes_y_permisos (`id_solicitud_permiso`, `tipo_permiso`, `ci_permiso`, `data_solicitudes`, `fecha_permiso`, `estado_permiso`) 
                                        VALUES ('$id', '$this->tipo', '$this->forWho', '$data', now(), 1)");

        if ($q == true) {
            $this->auditoria = new SolicitudesAuditoria($id);

            if ($this->auditoria->creacionDeSolicitudes()) {
                return true;
            }
        } else {
            // Registra el error
            echo error_log($this->conn->error(), 0);

            // Muestra un mensaje de error al usuario
            echo "Ocurrió un error al insertar la solicitud.";
            echo "<br>Not nice <br> <hr>" . $arryData;
        }

    }

}

/**
 * Obtener informacion de solicitudes
 * - Todas 
 * - Detalles por id 
 * - Informacion presisa de la planilla
 */
class ObtSolicitudes
{
    /**
     * Summary of id
     * @var 
     */
    private $id;

    /**
     * Summary of idAgent
     * @var 
     */
    private $idAgent = null;

    /**
     * Summary of conn
     * @var 
     */
    private $conn;

    private $auditoria;

    /**
     * Summary of __construct
     * @param mixed $id
     */
    public function __construct($id = null)
    {
        $this->conn = new Conexion;

        $this->id = ($id != null) ? $this->conn->real_escape($id) : '';

        if ($id != null) {
            $this->auditoria = new SolicitudesAuditoria($id);
        }

    }

    /**
     * Summary of allSolicitudes
     * @throws \Exception
     * @return array
     */
    public function allSolicitudes()
    {
        if ($this->id != null) {
            throw new Exception("Estas haciendo una llamada no valida, revisa la documentacion", 1);
        }

        $option = $this->idAgent == null ? "" : "WHERE ci_permiso = '{$this->idAgent}'";
        $ver = $this->conn->query("SELECT * FROM solicitudes_y_permisos " . " {$option}");
        $i = 0;

        if ($ver->num_rows > 0) {
            while ($variable = mysqli_fetch_assoc($ver)) {
                @$array[$i];
                foreach ($variable as $key => $value) {
                    if ($key == 'data_solicitudes') {
                        $ved = explode(" -- ", $value);
                        foreach ($ved as $keys => $val) {
                            if ($val != '') {
                                $vrr[] = $val;
                            }
                        }
                        $array[$i][$key] = $vrr;
                        unset($vrr);
                    } else {
                        $array[$i][$key] = $value;
                    }
                }
                $i++;
            }
        } else {
            $array = ['error' => true];
        }

        return $array;
    }

    /**
     * Summary of Detalles
     * @throws \Exception
     * @return array
     */
    public function detalles()
    {
        if ($this->id == null) {
            throw new Exception("Estas haciendo una llamada no valida, cosulta", 1);
        }

        $ver = $this->conn->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = $this->id");
        $i = 0;

        while ($variable = mysqli_fetch_assoc($ver)) {
            @$array[$i];
            foreach ($variable as $key => $value) {
                if ($key == 'data_solicitudes') {
                    $ved = explode(" -- ", $value);
                    foreach ($ved as $keys => $val) {
                        if ($val != '') {
                            $vrr[] = $val;
                        }
                    }
                    $array[$i][$key] = $vrr;
                    unset($vrr);
                } else {
                    $array[$i][$key] = $value;
                }
            }
            $i++;
        }
        return $array;
    }

    /**
     * Summary of DetallePLanillas
     * @return array
     */
    public function detallePLanillas()
    {
        if ($this->id == null) {
            throw new Exception("Estas haciendo una llamada no valida, cosulta", 1);
        }

        $vear = $this->detalles();
        $printcito = [];
        foreach ($vear as $key => $value) {
            foreach ($value as $ky => $le) {
                if ($ky == "data_solicitudes") {
                    foreach ($le as $kw) {
                        $assocs = trim(explode(':', $kw)[0]);
                        $valorcitos = trim(explode(':', $kw)[1]);

                        $printcito[$assocs] = $valorcitos;
                    }
                }
                if ($ky == "estado_permiso") {
                    $verificacionDestado = $le;
                }
            }
        }
        return [$printcito, $verificacionDestado];
    }

    /**
     * Summary of aceptarSolicitud
     * @return 
     */
    public function aceptarSolicitud()
    {
        if ($this->id == null) {
            throw new Exception("Estas haciendo una llamada no valida, cosulta", 1);
        }

        $qr = $this->conn->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = '$this->id'");

        $si = $qr->num_rows;
        if ($si > 0) {
            $this->auditoria->aceptacionDeSolicitudes($this->detallePLanillas()[0]);

            $qrt = $this->conn->query("UPDATE solicitudes_y_permisos SET estado_permiso = 2 WHERE id_solicitud_permiso = '$this->id'");

            if ($qrt) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Summary of rechazarSolicitud
     * @param mixed $motivo
     * @return bool
     */
    public function rechazarSolicitud($motivo)
    {

        $qr = $this->conn->query("SELECT * FROM solicitudes_y_permisos WHERE id_solicitud_permiso = '$this->id'");

        $si = $qr->num_rows;

        if ($si > 0) {
            $this->auditoria->rechazoDeSolicitudes();

            $qrt = $this->conn->query("UPDATE solicitudes_y_permisos SET estado_permiso = 3, motivo_permiso = '$motivo' WHERE id_solicitud_permiso = '$this->id'");

            if ($qrt) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}