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
        $query = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida) VAlUES ('$idEntrada', now(), 1)");
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
        $sql = $this->connec->query("INSERT INTO registro_entrada_salida (id_usuario_init, fecha, entradaSalida) VAlUES ('$idEntrada', now(), 0)");
        $this->connec->close();

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Comprobar usuarios loggeados en el sistema
     * @return string echo a[href] con usuarios activos y no activos
     */
    public function usersActives()
    {
        $sql = $this->connec->query("SELECT * FROM registro");

        if (!$sql || mysqli_num_rows($sql) == 0) {
            $r = "error al optener datos";
        } else {
            $r = "";
            while ($row = mysqli_fetch_array($sql))
                if ($row['sesion'] != 0) {
                    $r .= '<a class="aUser" href="perfil.php?perfil=' . encriptar($row['ci']) . '"> <i class="bi bi-dot active"></i>' . ucfirst(strtolower($row['user'])) . ' </a>';
                } else {
                    $r .= '<a class="aUser" href="perfil.php?perfil=' . encriptar($row['ci']) . '"> <i class="bi bi-dot"></i>' . ucfirst(strtolower($row['user'])) . ' </a>';
                }
        }
        $this->connec->close();
        return $r;
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
}