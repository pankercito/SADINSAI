<?php

/**
 * Gestion de datos del sistema
 * movimientos
 * usuarios
 * solicitudes
 * Data de personal
 * registro de cambios
 * promedios de movimientos
 */
class Auditoria
{
    private $idEntrada;
    private $arrayEntrada;
    protected $connec;

    /**
     * inicializando conexion global
     * REORDENAR REGISTROS
     * REORDENAR USUARIOS
     */
    public function __construct()
    {

        //Creamos el obj, instanciando la clase Conexion()
        $this->connec = new Conexion();

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
     * recorrer rango de fechas y devolver array
     * @param mixed $date_ini
     * @param mixed $date_end
     * @return array
     */
    public function getRangeDate($date_ini, $date_end)
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

        $d = 'Ingreso de personal aceptado por ' . $fr->user . '. Id de gestion ' . $idSoli . ' personal agregado: ' . $arrayA['ci'] . ' -- ';

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
     * Guarda en la Base de Datos registro de Cambios en [sadinsai.personal]
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

        $d = 'Cambio de datos aceptados por ' . $fr->user . '. Id de gestion: ' . $idSoli . '. para ' . $arrayA['ci'] . ' -- ';

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

    /**
     * Registro de ingresos de archivos para [sadinsai.auditoria]
     * @return bool
     */
    public function registArch()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Ingreso de archivos aceptado por ' . $fr->user . '. Id de gestion: ' . $idSoli . '. agregado a: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 3, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro de eliminacion de Archivos para [sadinsai.auditoria]
     * @return bool
     */
    public function registArchDel()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Eliminacion de archivos aceptado por ' . $fr->user . '. Id de gestion: ' . $idSoli . '. carpeta de: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 4, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Registro de registro de nuevos usuarios para [sadinsai.auditoria]
     * @return bool
     */
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

        $ID = $_SESSION['sesion'] ?? null;
        @$user = $this->connec->real_escape($_POST['userId']);
        @$radio = $this->connec->real_escape($_POST['radio']);


        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $registro1 = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $user");

        $fr = $registro->fetch_object(); // usuario activo
        $fc = $registro1->fetch_object(); // usuario pasivo

        $a = ($radio == 1) ? 'Activacion de usuario ' : 'Desactivacion de usuario ';

        @$d = $a . 'por: ' . $fr->user . ', hacia el usuario: ' . $fc->user;

        // Comparamos los elementos de los arrays

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 6, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Summary of registDeleteUser
     * @return void
     */
    public function registDeleteUser() : bool
    {
        @session_start();

        $ID = $_SESSION['sesion'] ?? null;
        @$user = $this->connec->real_escape($_POST['userId']);
        @$radio = $this->connec->real_escape($_POST['radio']);


        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $registro1 = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $user");

        $fr = $registro->fetch_object(); // usuario activo
        $fc = $registro1->fetch_object(); // usuario pasivo

        @$d = "Eliminacion de usuario por {$fr->user}. a {$fc->user} - usuario de {$fc->ci}";

        // Comparamos los elementos de los arrays

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 6, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Resgitro de cambio de ubicacion de archivo para [sadinsai.auditoria]
     * @return bool
     */
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

    /**
     * Registro de rechazo de solicitude para [sadinsai.auditoria]
     * @return bool
     */
    public function registRechaz()
    {
        @session_start();

        $ID = $_SESSION['sesion'];
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Rechazo de gestion por ' . $fr->user . '. Id de gestion: ' . $idSoli . ', dirigida a: ' . $ci->ci_solicitada;

        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 8, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }

    public function registRequerid($ci, $data)
    {
        @session_start();

        $ID = $_SESSION['sesion'];

        $registro = $this->connec->query("SELECT * FROM registro WHERE id_usuario = $ID");
        $fr = $registro->fetch_object();

        $contenido = "Cambios por {$fr->user}, en los requerimientos de: {$ci} -- " . $data;

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '$ID', '$contenido', 11, NOW())");
        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}