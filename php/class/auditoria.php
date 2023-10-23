<?php

/**
 * Gestion de datos del sistema
 * movimientos
 * usuarios
 * solicitudes
 * Data de personal
 * registro de cambios
 */
class Auditoria
{
    private $idEntrada;
    private $arrayEntrada;

    protected $connec;
    public $aplicacion;

    /**
     * declarando getRange
     * inicializando conexion global
     * REORDENAR REGISTROS
     * REORDENAR USUARIOS
     */
    public function __construct()
    {
        /**
         * recorrer rango de fechas y devolver array
         * @param mixed $date_ini
         * @param mixed $date_end
         * @return array
         */
        function getRangeDate($date_ini, $date_end)
        {
            $dt_ini = DateTime::createFromFormat("Y-m-d", $date_ini);
            $dt_end = DateTime::createFromFormat("Y-m-d", $date_end);
            $period = new DatePeriod(
                $dt_ini,
                new DateInterval('P1D'),
                $dt_end,
            );
            $range = [];
            foreach ($period as $date) {
                $range[] = $date->format("Y-m-d");
            }
            $range[] = $date_end;
            return $range;
        }

        //Creamos el obj, instanciando la clase Conexion()
        $this->connec = new Conexion();
        $this->aplicacion = array();

        // REORDENAR REGISTROS
        $this->connec->query("SET @autoid := 0");
        $this->connec->query("UPDATE auditoria SET id = (@autoid := @autoid + 1)");
        $this->connec->query("ALTER TABLE auditoria AUTO_INCREMENT = 1");

        // REORDENAR USUARIOS
        $this->connec->query("SET @autoid := 0");
        $this->connec->query("UPDATE registro SET id_usuario = (@autoid := @autoid + 1)");
        $this->connec->query("ALTER TABLE registro AUTO_INCREMENT = 1");


    }

    /**
     * Registro de salida de sesion en BD
     * @param string $idEntrada ID de usuario 
     * @return bool
     */
    public function sesionInit($idEntrada)
    {
        $consu = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $idEntrada");
        $fechi = mysqli_fetch_assoc($consu);
        $user = $fechi["user"];

        $query = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida, user_name) VAlUES ('$idEntrada', now(), 1, '$user')");

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro de entrada de sesion en BD
     * @param string $idEntrada ID de usuario 
     * @return bool
     */
    public function sesionClose($idEntrada)
    {
        $consu = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $idEntrada");
        $fechi = mysqli_fetch_assoc($consu);
        $user = $fechi["user"];

        $sql = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida, user_name) VAlUES ('$idEntrada', now(), 0, '$user')");
        $this->connec->close();

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Comprobar usuarios activos en el sistema
     * @return  array $result array:[[cedula],[user],[active]]
     */
    public function usersActives()
    {
        $sql = $this->connec->query("SELECT * FROM registro ORDER BY sesion DESC");

        $row = [];
        $result = [];

        while ($row = mysqli_fetch_array($sql)) {

            if ($row['adp'] != 2) {
                $result[] = [
                    "ci" => encriptar($row['ci']),
                    "user" => ucfirst(strtolower($row['user'])),
                    "active" => $row['sesion']
                ];
            }
        }

        return $result;
    }

    /**
     * Obtener usuarios en el sistema
     * @param  string $yo sesion de usuario
     * @return  array $result array 
     */
    public function users($yo)
    {
        $regisview = $this->connec->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci");

        // verificacion de tipo de usuario
        $verifi = $this->connec->query("SELECT * FROM registro WHERE id_usuario = '$yo'");
        $yoadp = $verifi->fetch_object();

        //Si ha resultados
        if ($regisview->num_rows > 0) {

            $v = [];
            while ($v = $regisview->fetch_object()) {

                $delete = ($yoadp->adp == 2) ? '<span class="e mx-1"></span><a  onclick="deleteUser(' . $v->id_usuario . ')" class="pencil alert alert-danger"><i class="bi bi-trash"></i></a>' : "";

                $r = ($v->active != 1) ? '<div class="d-inline-flex"><a class="pan alert alert-secondary">desactivado</a><span class="e mx-1"></span><a onclick="gestionUser(' . $v->id_usuario . ')". class="pencil alert alert-warning" ><i class="bi bi-pencil"></i></a>' . $delete . '</div>'
                    : '<div class="d-inline-flex"><a class="panel alert alert-success">activo</a><span class="e mx-1"></span><a  onclick="gestionUser(' . $v->id_usuario . ')" class="pencil alert alert-warning"><i class="bi bi-pencil"></i></a>' . $delete . '</div>';


                $ad = ($v->adp == 1) ? '<i class="admin me-2 bi bi-person-fill-gear"></i>' : '<i class="no-admin me-2 bi bi-person"></i>';

                $g = ($v->adp == 1) ? 'proper' : 'no-proper';

                if ($yo != $v->id_usuario) {
                    if ($v->adp != 2) {
                        // Poner los datos en un array en el orden de los campos de la tabla
                        $data[] = [
                            "<a class='vrname " . $g . "' onclick=location.replace('perfil.php?perfil=" . encriptar($v->ci) . "&parce=true')>" . $ad . strtoupper(strtolower($v->user)) . "</a>",
                            ucwords(strtolower($v->nombre)),
                            ucwords(strtolower($v->apellido)),
                            $v->ci,
                            $r
                        ];
                    }
                }
            }
            // crear un array con el array de los datos
            $new_array = ["data" => $data];
        } else {
            //Si no hay registros encontrados
            $data[] = [
                "error no se",
                "encuentran",
                "resultados ",
                "con los criterios",
                "de busqueda"
            ];
            $new_array = ["data" => $data];
        }

        return $new_array;
    }

    /**
     * Consultas de inicios de sesion por rango de fechas
     * @param string $range
     * @return array
     */
    public function userStats($dat1, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = getRangeDate($dat1, $dat2);

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
            $fech = getRangeDate($fech, $fech2);

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
     * Comprobar cantidad de solicitudes realizadas por usuarios
     * @param mixed $fecha
     * @param mixed $fech2
     * @return array
     */
    public function userSolisStats($fecha = null, $fech2 = null)
    {
        $q = $this->connec->query("SELECT * FROM registro WHERE adp NOT IN (2)");

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $fech = getRangeDate($fecha, $fech2);

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
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function solicitudStats($dat1, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = getRangeDate($dat1, $dat2);

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
     * CONSULTA POR TIPOS LA CANTIDAD DE SOLICITUDES
     * @param string $fech
     * @param string $fech2 || opcional rango de fechas
     * @return array
     */
    public function solicitudDetailstStats($fech, $fech2 = null)
    {
        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = getRangeDate($fech, $fech2);

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

    function solicitudPrecise($fech = 'dia presente', $fech2 = null, $estado = null)
    {
        $estatus = ($estado != null) ? "AND apr_estado  = $estado" : '';

        if ($fech2 != null) {
            //RANGO DE FECHAS
            $rango = getRangeDate($fech, $fech2);

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
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function archivesStats($dat1 = null, $dat2 = null)
    {
        if ($dat2 != null) {
            // obtenemos recorrido del rango de fechas 
            $fech = getRangeDate($dat1, $dat2);

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
            $rango = getRangeDate($fech, $fech2);

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
     * Guarda en la bade de Datos registro de ingreso en [sadinsai.personal]
     * usar arrays asociativos para que sea funcional
     * @param mixed $arrayA Datos base
     * @param mixed $arrayB Nuevos Datos
     * @return bool
     */
    public function registIngres($arrayA)
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);


        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $d = 'Ingreso de personal aceptado por ' . $fr->user . '. id de solicitud ' . $idSoli . ' personal agregado: ' . $arrayA['ci'] . ' -- ';

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($arrayA as $clave => $valor) {
            if ($clave != $valor) {
                $d .= $clave . ': ' . $arrayA[$clave] . ' --  ';
            }
        }

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 1, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * Guarda en la bade de Datos registro de Cambios en [sadinsai.personal]
     * usar arrays asociativos para que sea funcional
     * @param mixed $arrayA Datos base
     * @param mixed $arrayB Nuevos Datos
     * @return bool
     */
    public function registChange($arrayA, $arrayB)
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);


        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $d = 'Cambio de datos aceptados por ' . $fr->user . '. id de solicitud: ' . $idSoli . '. para ' . $arrayA['ci'] . ' -- ';

        // Comparamos los valores de los arrays

        // Usamos array_diff_assoc() para obtener una lista de los elementos que han cambiado
        $cambios = array_diff_assoc($arrayA, $arrayB);

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($cambios as $clave => $valor) {
            if ($clave != $valor) {
                $d .= $clave . ': antes: ' . $arrayA[$clave] . ' \ despues: ' . $arrayB[$clave] . ' -- ';
            }
        }

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 2, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    public function registArch()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Ingreso de archivos aceptado por ' . $fr->user . '. id de solicitud: ' . $idSoli . '. agregado a: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 3, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    public function registArchDel()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Eliminacion de archivos aceptado por ' . $fr->user . '. id de solicitud: ' . $idSoli . '. carpteda de: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 4, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    public function registUser()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $userN = $this->connec->real_escape($_POST['user']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");

        $fr = $registro->fetch_object(); // usuario activo

        $d = 'Registro de nuevo usuario por: ' . $fr->user . '. Nuevo usuario: ' . strtoupper($userN);

        // Comparamos los elementos de los arrays

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 5, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda en la Bade de Datos registro de activacion y desactivacion de usuarios
     * @return bool
     */
    public function registActivUser(): bool
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $user = $this->connec->real_escape($_POST['userId']);
        $radio = $this->connec->real_escape($_POST['radio']);


        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $registro1 = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $user");

        $fr = $registro->fetch_object(); // usuario activo
        $fc = $registro1->fetch_object(); // usuario pasivo

        $a = ($radio == 1) ? 'Activacion de usuario ' : 'Desactivacion de usuario ';

        $d = $a . 'por: ' . $fr->user . ' hacia el usuario: ' . $fc->user;

        // Comparamos los elementos de los arrays

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 6, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }

    }

    public function registArchUbi()
    {
        @session_start();

        $ID = $_SESSION['sesion'];

        $arch = $this->connec->real_escape($_POST["idArch"]);
        $res = $this->connec->real_escape($_POST["responsable"]);
        $dir = $this->connec->real_escape($_POST["ndireccion"]);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $registro1 = $this->connec->query("SELECT * FROM archidata a JOIN tiposarch t JOIN departamentos d ON a.tipo_arch = t.id_tipo AND d.id_direccion = a.ubicacion_fis WHERE id_archivo = $arch");
        $n = $this->connec->query("SELECT * FROM departamentos WHERE id_direccion = $dir");

        $fr = $registro->fetch_object(); // usuario activo
        $fc = $registro1->fetch_object(); // usuario pasivo
        $dire = $n->fetch_object(); // usuario pasivo

        $d = $fr->user . ' realizo un cambio de ubicacion a: ' . $dire->dir_nombre . '. En el archivo: ' . $fc->nombre_arch . '. tipo: ' . $fc->nombre_tipo_arch . '. hacia el usuario: ' . $fc->ci_arch . '. Responsable: ' . $res;

        // Comparamos los elementos de los arrays

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 7, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }

    }

    public function registRechaz()
    {

        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Rechazo de solicitud por ' . $fr->user . '. id de solicitud: ' . $idSoli . '. dirigida a: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 8, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}