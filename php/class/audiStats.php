<?php

class Estadistica extends Auditoria
{

    /**
     * Consultas de inicios de sesion por rango de fechas
     * @param string $range
     * @return array
     */

    public function userStats($dat1, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = $this->getRangeDate($dat1, $dat2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i < $con) {
                $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init NOT IN (1) AND entradaSalida = 1 AND DATE(fecha) = '" . $fech[$i] . "' GROUP BY id_usuario_init, DATE(fecha)");
                $f = mysqli_num_rows($num);
                $result[] = [$f];
                $i++;
            }
        } else {
            $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init NOT IN (1) AND entradaSalida = 1 AND DATE(fecha) = '$dat1' GROUP BY id_usuario_init, DATE(fecha)");
            $f = mysqli_num_rows($num);
            $result[] = [$f];
        }

        return $result;
    }

    /**
     * Consulta la cantidad de inicios diarios de un usuario
     * @param mixed $fecha
     * @param mixed $fech2 para rango de fechas
     * @return array
     */
    public function userInixStats($fech = null, $fech2 = null)
    {
        $q = $this->connec->query("SELECT * FROM registro WHERE adp NOT IN (2)");

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $fech = $this->getRangeDate($fech, $fech2);

            $conu = count($fech);
            $i = 0;
            $result = [];

            while ($i < $conu) {

                while ($v = $q->fetch_object()) {
                    $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init = '$v->id_usuario' AND entradaSalida = 1 AND DATE(fecha) = '" . $fech[$i] . "'");
                    $f = $num->num_rows;

                    if ($f != 0) {
                        $result[] = [
                            "id" => $v->id_usuario,
                            "user" => strtoupper($v->user),
                            "count" => $f,
                            "fecha" => $fech[$i]
                        ];
                    }
                }

                $i++;
            }

        } else if ($fech != null) {
            // FECHA SIMPLE
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init = '$i->id_usuario' AND entradaSalida = 1 AND DATE(fecha) = '$fech'");
                $f = $num->num_rows;

                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => $fech
                    ];
                }
            }
        } else {
            // NO FECH
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init = '$i->id_usuario' AND entradaSalida = 1");
                $f = $num->num_rows;

                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => 'todas'
                    ];
                }
            }
        }
        return $result;
    }

    /**
     * Comprobar cantidad de gestiones realizadas por usuarios
     * @param mixed $fecha
     * @param mixed $fech2
     * @return array
     */
    public function userGestionStats($fecha = null, $fech2 = null)
    {
        $q = $this->connec->query("SELECT * FROM registro WHERE adp NOT IN (2)");

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $fech = $this->getRangeDate($fecha, $fech2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i < $con) {
                while ($v = $q->fetch_object()) {

                    $num = $this->connec->query("SELECT * FROM solicitudes WHERE id_emisor = '$v->id_usuario' AND DATE(fecha) = '$fech[$i]'");
                    $f = $num->num_rows;

                    $result[] = [
                        "id" => $v->id_usuario,
                        "user" => strtoupper($v->user),
                        "count" => $f,
                        "fecha" => $fech[$i]
                    ];
                }
                $i++;
            }
        } else if ($fecha != null) {
            // FECHA SIMPLE
            $i = [];
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM solicitudes WHERE id_emisor = '$i->id_usuario' AND DATE(fecha) = '$fecha'");
                $f = $num->num_rows;
                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => $fecha
                    ];
                }
            }
        } else {
            // NO FECH
            $i = [];
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM solicitudes WHERE id_emisor  = '$i->id_usuario'");
                $f = $num->num_rows;

                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => 'todas'
                    ];
                }
            }
        }
        return $result;
    }

    /**
     * Comprobar cantidad de solicitudes realizadas por usuarios
     * @param mixed $fecha
     * @param mixed $fech2
     * @return array
     */
    public function userSolisStats($fecha = null, $fech2 = null)
    {
        $q = $this->connec->query("SELECT * FROM registro");

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $fech = $this->getRangeDate($fecha, $fech2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i < $con) {
                while ($v = $q->fetch_object()) {

                    $num = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE ci_permiso = '$v->ci' AND DATE(fecha_permiso) = '$fech[$i]'");
                    $f = $num->num_rows;

                    $result[] = [
                        "id" => $v->id_usuario,
                        "user" => strtoupper($v->user),
                        "count" => $f,
                        "fecha" => $fech[$i]
                    ];
                }
                $i++;
            }
        } else if ($fecha != null) {
            // FECHA SIMPLE
            $i = [];
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE ci_permiso = '$i->ci' AND DATE(fecha_permiso) = '$fecha'");
                $f = $num->num_rows;
                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => $fecha
                    ];
                }
            }
        } else {
            // NO FECH
            $i = [];
            $result = [];

            while ($i = $q->fetch_object()) {
                $num = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE ci_permiso = '$i->ci'");
                $f = $num->num_rows;

                if ($f != 0) {
                    $result[] = [
                        "id" => $i->id_usuario,
                        "user" => strtoupper($i->user),
                        "count" => $f,
                        "fecha" => 'todas'
                    ];
                }
            }
        }
        return $result;
    }

    /**
     * consulta gestiones en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function gestionStats($dat1, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = $this->getRangeDate($dat1, $dat2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {
                $num = $this->connec->query("SELECT * FROM solicitudes WHERE DATE(fecha) = '" . $fech[$i] . "'");
                $f = $num->num_rows;

                $result[] = [$f];
                $i++;
            }
        } else {
            $num = $this->connec->query("SELECT * FROM solicitudes WHERE DATE(fecha) = '$dat1'");
            $f = $num->num_rows;

            $result[] = [$f];
        }

        return $result;
    }

    /**
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function solisStats($dat1, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = $this->getRangeDate($dat1, $dat2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {
                $num = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE DATE(fecha_permiso) = '" . $fech[$i] . "'");
                $f = $num->num_rows;

                $result[] = [$f];
                $i++;
            }
        } else {
            $num = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE DATE(fecha_permiso) = '$dat1'");
            $f = $num->num_rows;

            $result[] = [$f];
        }

        return $result;
    }

    /**
     * CONSULTA POR TIPOS LA CANTIDAD DE SOLICITUDES
     * @param string $fech
     * @param string $fech2 || opcional rango de fechas
     * @return array
     */
    public function gestionDetailstStats($fech, $fech2 = null)
    {
        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = $this->getRangeDate($fech, $fech2);

            $con = count($rango);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {

                $c = 0;
                while ($c != 4) {
                    $data = $this->connec->query("SELECT * FROM solicitudes WHERE  tipo = '$c' AND DATE(fecha) = '" . $rango[$i] . "' ");
                    $total = $data->num_rows;
                    if ($total != 0) {
                        $result[] = [
                            'tipo' => $c,
                            'count' => $total,
                            'dia' => $rango[$i]
                        ];
                    }

                    $c++;
                }

                $i++;
            }
        } else {
            //UNA FECHA
            $result = [];
            $i = 0;

            while ($i != 4) {

                $data = $this->connec->query("SELECT * FROM solicitudes WHERE DATE(fecha) = '$fech' AND tipo = '$i'");
                $total = $data->num_rows;

                $result[] = [
                    'tipo' => $i,
                    'count' => $total
                ];

                $i++;
            }

        }
        return $result;
    }

    /**
     * Consulta de movimientos de Gestiones avanzados
     * @param mixed $fech
     * @param mixed $fech2
     * @param mixed $estado
     * @return array
     */
    function gestionPrecise($fech = 'dia presente', $fech2 = null, $estado = null)
    {
        $estatus = ($estado != null) ? "AND apr_estado  = $estado" : '';

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = $this->getRangeDate($fech, $fech2);

            $con = count($rango);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {

                $c = 0;
                while ($c != 4) {

                    $data = $this->connec->query("SELECT * FROM solicitudes WHERE  tipo = '$c' AND DATE(fecha) = '" . $rango[$i] . "' " . $estatus);
                    $total = $data->num_rows;

                    if ($total != 0) {
                        $result[] = [
                            'tipo' => $c,
                            'count' => $total,
                            'dia' => $rango[$i]
                        ];
                    }
                    $c++;
                }
                $i++;
            }
        } else if ($fech != null) {
            //UNA FECHA
            $result = [];
            $i = 0;

            while ($i != 4) {
                $data = $this->connec->query("SELECT * FROM solicitudes WHERE tipo = '$i'  AND DATE(fecha) = '$fech'" . $estatus);
                $total = $data->num_rows;
                if ($total != 0) {
                    $result[] = [
                        'tipo' => $i,
                        'count' => $total,
                        'dia' => ($fech != 0) ? $fech : 'todas'
                    ];
                }
                $i++;
            }

        } else {
            //UNA FECHA
            $result = [];
            $i = 0;

            while ($i != 4) {

                $data = $this->connec->query("SELECT * FROM solicitudes WHERE tipo = '$i'" . $estatus);
                $total = $data->num_rows;

                $result[] = [
                    'tipo' => $i,
                    'count' => $total,
                    'dia' => ($fech != 0) ? $fech : 'todas'
                ];

                $i++;
            }
        }
        return $result;
    }

    /**
     * Summary of solisPrecise
     * @param mixed $fech
     * @param mixed $fech2
     * @param mixed $estado
     * @return array
     */
    function SolisPrecise($fech = null, $fech2 = null, $estado = null)
    {
        $estatus = ($estado != null) ? "AND estado_permiso  = $estado" : '';

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = $this->getRangeDate($fech, $fech2);

            $con = count($rango);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {

                $c = 1;
                while ($c != 5) {

                    $data = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE  tipo_permiso = '$c' AND DATE(fecha_permiso) = '" . $rango[$i] . "' " . $estatus);
                    $total = $data->num_rows;

                    if ($total != 0) {
                        $result[] = [
                            'tipo' => $c,
                            'count' => $total,
                            'dia' => $rango[$i]
                        ];
                    }
                    $c++;
                }
                $i++;
            }
        } else if ($fech != null) {
            //UNA FECHA
            $result = [];
            $i = 1;

            while ($i != 5) {
                $data = $this->connec->query("SELECT * FROM FROM solicitudes_y_permisos WHERE  tipo_permiso = '$i'  AND DATE(fecha_permiso) = '$fech'" . $estatus);
                $total = $data->num_rows;
                if ($total != 0) {
                    $result[] = [
                        'tipo' => $i,
                        'count' => $total,
                        'dia' => ($fech != 0) ? $fech : 'todas'
                    ];
                }
                $i++;
            }

        } else {
            //UNA FECHA
            $result = [];
            $i = 1;

            while ($i != 6) {

                $data = $this->connec->query("SELECT * FROM solicitudes_y_permisos WHERE  tipo_permiso = '$i'" . $estatus);
                $total = $data->num_rows;

                $result[] = [
                    'tipo' => $i,
                    'count' => $total,
                    'dia' => ($fech != 0) ? $fech : 'todas'
                ];

                $i++;
            }
        }
        return $result;
    }

    /**
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function archivesStats($dat1 = null, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = $this->getRangeDate($dat1, $dat2);

            $con = count($fech);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {
                $num = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE s.tipo = '2' AND s.apr_estado = 1 AND DATE(s.fecha) = '" . $fech[$i] . "'");
                $f = mysqli_num_rows($num);
                $result[] = [$f];
                $i++;
            }
        } else if ($dat1 != null) {
            $num = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE s.tipo = '2' AND s.apr_estado = 1 AND DATE(s.fecha) = '$dat1'");
            $f = mysqli_num_rows($num);
            $result[] = [$f];
        } else {
            $num = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE s.tipo = '2' AND s.apr_estado = 1");
            $f = mysqli_num_rows($num);
            $result[] = ["total" => $f];
        }
        return $result;
    }

    public function archivesDetailsStats($fech = null, $fech2 = null, $estatus = null)
    {
        $estado = ($estatus != 0) ? " AND a.delete_arch = '1'" : " AND a.delete_arch = '0'";

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = $this->getRangeDate($fech, $fech2);

            $con = count($rango);
            $i = 0;
            $result = [];

            while ($i <= $con - 1) {
                $c = 1001;
                while ($c < 1045) {

                    $data = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE a.tipo_arch = '$c' AND s.tipo = '2'  AND DATE(fecha) = '" . $rango[$i] . "'" . $estado);
                    $fetch = $data->fetch_object();
                    $total = $data->num_rows;

                    if ($total != 0) {
                        $result[] = [
                            'tipo' => $fetch->tipo_arch,
                            'count' => $total,
                            'dia' => $rango[$i]
                        ];
                    }

                    $c++;
                }

                $i++;
            }

        } else if ($fech != null) {
            //UNA FECHA
            $i = 1001;
            while ($i < 1045) {
                $data = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE a.tipo_arch = '$i' AND s.tipo = '2' " . $estado . " AND DATE(fecha) = '$fech' ");
                $fetch = $data->fetch_object();
                $total = $data->num_rows;
                if ($total > 0) {
                    $result[] = [
                        'tipo' => $i,
                        'count' => $total,
                        'dia' => $fech,
                    ];
                }
                $i++;
            }
        } else {
            $i = 1001;
            while ($i < 1045) {
                $data = $this->connec->query("SELECT * FROM archidata a INNER JOIN solicitudes s ON a.id_archivo = s.id_solicitud WHERE  a.tipo_arch = '$i'  AND s.tipo = '2' " . $estado);
                $total = $data->num_rows;
                $fetch = $data->fetch_object();

                if ($total != 0) {
                    $result[] = [
                        'tipo' => $i,
                        'count' => $total,
                        'dia' => "total"
                    ];
                }
                $i++;
            }
        }
        return $result;
    }
    /**
     * Summary of TotalUsers
     * @return int
     */
    public function TotalUsers(): int
    {
        $data = $this->connec->query("SELECT * FROM registro");
        $subtotal = $data->num_rows;

        $total = $subtotal - 1;

        return $total;
    }
}