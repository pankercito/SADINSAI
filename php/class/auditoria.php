<?php

class based
{
    protected $connec;
    public $aplicacion;

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
    }
}

/**
 * Gestion de datos de usuarios
 */
class auditoria extends based
{
    private $idEntrada;
    private $arrayEntrada;

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
        $this->connec->close();

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
     * Comprobar usuarios loggeados en el sistema
     * @return array  de usuarios activos en el sistema DATA =>
     * ci || user || active
     */
    public function usersActives()
    {
        $sql = $this->connec->query("SELECT * FROM registro ORDER BY sesion DESC");

        $row = [];
        $result = [];

        while ($row = mysqli_fetch_array($sql)) {

            $result[] = [
                "ci" => encriptar($row['ci']),
                "user" => ucfirst(strtolower($row['user'])),
                "active" => $row['sesion']
            ];
        }

        return $result;
    }

    /**
     * Registrar Cambios por el usuario
     * @param $arrayEntrada
     * @return mixed
     */
    public function registrarCambios()
    { /// XDD,así no brou pero bueno, lo importante qué funcione

        $sql = "SELECT * FROM registro_entrada_salida";
        $this->connec->close();

    }

    /**
     * Consultas de inicios de sesion por rango de fechas
     * @param string $range
     * @return array
     */
    public function userStats($dat1, $dat2)
    {
        // obtenemos recorrido del rango de fechas 
        $fech = getRangeDate($dat1, $dat2);

        $con = count($fech);
        $i = 0;
        $result = [];

        while ($i <= $con - 1) {
            $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE entradaSalida = 1 AND DATE(fecha) = '" . $fech[$i] . "' GROUP BY id_usuario_init, DATE(fecha)");
            $f = mysqli_num_rows($num);
            $result[] = [$f];
            $i++;
        }
        return $result;
    }

    /**
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function solicitudStats($dat1, $dat2)
    {
        // obtenemos recorrido del rango de fechas 
        $fech = getRangeDate($dat1, $dat2);

        $con = count($fech);
        $i = 0;
        $result = [];

        while ($i <= $con - 1) {
            $num = $this->connec->query("SELECT * FROM solicitudes WHERE DATE(fecha) = '" . $fech[$i] . "'");
            $f = mysqli_num_rows($num);
            $result[] = [$f];
            $i++;
        }
        return $result;
    }

    /**
     * consulta solicitudes en rango de fechas
     * @param mixed $dat1
     * @param mixed $dat2
     * @return array
     */
    public function archivesStats($dat1, $dat2)
    {
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
        return $result;
    }

    public function userInixStats()
    {

        $fech = date('Y-m-d');


        $q = $this->connec->query("SELECT * FROM registro");

        $i = [];
        $result = [];

        while ($i = $q->fetch_object()) {
            $num = $this->connec->query("SELECT * FROM registro_entrada_salida WHERE id_usuario_init = $i->id_usuario AND entradaSalida = 1 AND DATE(fecha) = '$fech'");
            $f = mysqli_num_rows($num);
            $result[] = [
                "id" => $i->id_usuario,
                "user" => strtoupper($i->user),
                "cont" => $f
            ];
        }
        return $result;
    }

    /**
     * Summary of solicitudDetailstStats
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
                $num = $this->connec->query("SELECT * FROM solicitudes WHERE DATE(fecha) = '" . $rango[$i] . "'");
                $f = mysqli_num_rows($num);
                $result[] = [$f];
                $i++;
            }
            return $result;
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

            return $result;
        }

    }
}