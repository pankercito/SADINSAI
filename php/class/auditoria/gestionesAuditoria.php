<?php

/**
 * Auditoria sobre gestiones del sistema
 */
class GestionesAuditoria extends Auditoria
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Guarda en la bade de Datos registro de ingreso en [sadinsai.personal]
     * usar arrays asociativos para que sea funcional
     * @param mixed $arrayA Datos base
     * @param mixed $arrayB Nuevos Datos
     * @return bool
     */
    public function ingresoDePersonal($arrayA)
    {
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $d = 'Ingreso de personal aceptado por ' . $this->username . '. Id de gestion ' . $idSoli . ' personal agregado: ' . $arrayA['ci'] . ' -- ';

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($arrayA as $clave => $valor) {
            if ($clave != $valor) {
                $d .= $clave . ': ' . $arrayA[$clave] . ' --  ';
            }
        }

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 1, NOW())");

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
    public function edicionDePersonal($arrayA, $arrayB)
    {
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $d = 'Cambio de datos aceptados por ' . $this->username . '. Id de gestion: ' . $idSoli . '. para ' . $arrayA['ci'] . ' -- ';

        // Comparamos los valores de los arrays

        // Usamos array_diff_assoc() para obtener una lista de los elementos que han cambiado
        $cambios = array_diff_assoc($arrayA, $arrayB);

        // Recorremos la lista de cambios e imprimimos los cambios
        foreach ($cambios as $clave => $valor) {
            if ($clave != $valor) {
                $d .= $clave . ': antes: ' . $arrayA[$clave] . ' \ despues: ' . $arrayB[$clave] . ' -- ';
            }
        }

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 2, NOW())");

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
    public function ingresoDeArchivo()
    {
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $soli = $inf->fetch_object();

        $d = 'Ingreso de archivos aceptado por ' . $this->username . '. Id de gestion: ' . $idSoli . '. agregado a: ' . $soli->ci_solicitada;

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 3, NOW())");

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
    public function eliminacionDeArchivo()
    {
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $soli = $inf->fetch_object();

        $d = 'Eliminacion de archivos aceptado por ' . $this->username . '. Id de gestion: ' . $idSoli . '. carpeta de: ' . $soli->ci_solicitada;

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 4, NOW())");

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
    public function cambioDeUbicacionArchivo()
    {
        $arch = $this->connec->real_escape($_POST["idArch"]);
        $res = $this->connec->real_escape($_POST["responsable"]);
        $dir = $this->connec->real_escape($_POST["ndireccion"]);

        $registro = $this->connec->query("SELECT * FROM archidata a JOIN tiposarch t JOIN departamentos d ON a.tipo_arch = t.id_tipo AND d.id_direccion = a.ubicacion_fis WHERE id_archivo = $arch");
        $n = $this->connec->query("SELECT * FROM departamentos WHERE id_direccion = $dir");

        $fc = $registro->fetch_object(); // usuario pasivo
        $dire = $n->fetch_object(); // usuario pasivo

        $d = $this->username . ' realizo un cambio de ubicacion a: ' . $dire->dir_nombre . '. En el archivo: ' . $fc->nombre_arch . '. tipo: ' . $fc->nombre_tipo_arch . '. hacia el usuario: ' . $fc->ci_arch . '. Responsable: ' . $res;

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 7, NOW())");

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
    public function gestionRechazada()
    {
        $idSoli = $this->connec->real_escape($_POST['idSoli']);

        $inf = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = $idSoli");
        $ci = $inf->fetch_object();

        $d = 'Rechazo de gestion por ' . $this->username . '. Id de gestion: ' . $idSoli . ', dirigida a: ' . $ci->ci_solicitada;

        // Escapamos el contenido antes de agregarlo a la base de datos
        $contenido = $this->connec->real_escape($d);

        $inyec = $this->connec->query("INSERT INTO auditoria (id, id_usuario_audi, cambios, tipo_movi, fecha_audi) VALUES ('', '{$this->id}', '$contenido', 8, NOW())");

        if ($inyec == true) {
            return true;
        } else {
            return false;
        }
    }
}