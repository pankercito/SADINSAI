<?php

class solicitudesMerge
{
    private $connec;

    public function __construct()
    {
        //Creamos el obj, instanciando la clase Conexion()
        $this->connec = new Conexion();
    }

    /**
     * Agrega los datos de precarga a la tabla personal
     * @param string $id id solicitud
     * @return boolean | array  as array || estado || redirec
     */
    public function addPersonal($id)
    {
        $sql = $this->connec->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = $id");

        if ($sql == true) {

            $dat = $sql->fetch_assoc();

            $ci = $dat['ci_pre'];
            $nombre = $dat['nombre_pre'];
            $apellido = $dat['apelido_pre'];
            $grado = $dat['grado_ac_pre'];
            $fecha = $dat['fecha_nac_pre'];
            $sexo = $dat['sexo_pre'];
            $estado = $dat['id_estado_pre'];
            $ciudad = $dat['id_ciudad_pre'];
            $sede = $dat['id_sede_pre'];
            $dirr = $dat['direccion_pre'];
            $mail = $dat['email_pre'];
            $celp = $dat['telefono_pre'];
            $cargo = $dat['cargo_pre'];


            $sql1 = $this->connec->query("INSERT INTO personal (ci, nombre,apellido, grado_ac, fecha_nac, sexo, id_estado, id_ciudad ,sede_id,direccion, email, telefono, cargo)
                                                 VALUES ('$ci', '$nombre', '$apellido', '$grado', '$fecha', '$sexo', '$estado', '$ciudad', '$sede', '$dirr', '$mail', '$celp',' $cargo')");

            if ($sql1 != true) {
                $cake = false;
            } else {
                $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");
                $location[] = [
                    'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_pre']) . '&parce=true',
                    'estado' => 'succes.personal.ingres'
                ];
                $cake = $location;
            }
        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Edita los datos de la tabla personal con los datos de Solicitud precarga
     * @param string $id id solicitud
     * @return boolean | array  as array || estado || redirec
     */
    public function editPersonal($id)
    {
        // aceptar solicitud 
        $sql = $this->connec->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = s.id_solicitud WHERE s.id_solicitud = $id");

        if ($sql == true) {

            $dat = $sql->fetch_assoc();

            $sql1 = $this->connec->query("UPDATE personal SET nombre = '{$dat['nombre_pre']}', 
                                                      apellido = '{$dat['apelido_pre']}',
                                                      grado_ac = '{$dat['grado_ac_pre']}',
                                                      fecha_nac = '{$dat['fecha_nac_pre']}',
                                                      sexo = '{$dat['sexo_pre']}',
                                                      id_estado = '{$dat['id_estado_pre']}', 
                                                      id_ciudad = '{$dat['id_ciudad_pre']}', 
                                                      sede_id = '{$dat['id_sede_pre']}', 
                                                      direccion = '{$dat['direccion_pre']}', 
                                                      email = '{$dat['email_pre']}',
                                                      telefono = '{$dat['telefono_pre']}',
                                                      cargo = '{$dat['cargo_pre']}'
                                                      WHERE ci = '{$dat['ci_solicitada']}'");
            if ($sql1 != true) {
                $cake = false;
            } else {
                $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");
                $location[] = [
                    'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_pre']) . '&parce=true',
                    'estado' => 'succes.personal.ingres'
                ];
                $cake = $location;
            }
        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Ingreso de archivo de archivos_precarga a archidata
     * @param string $id id solicitud
     * @return boolean | array  as array || estado || redirec
     */
    public function addArchive($id)
    {
        $svp = $this->connec->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p ON p.id_solicitud_archivo_pre = s.id_solicitud WHERE s.id_solicitud = '$id'");
        $sv = $svp->num_rows;

        if ($sv == 1) {
            $precarInf = $svp->fetch_assoc();

            $id = $precarInf['id_solicitud_archivo_pre'];
            $ci = $precarInf['ci_arch_pre'];
            $dire = $precarInf['d_archivo_pre'];
            $note = $precarInf['nombre_archivo_pre'];
            $taken = $precarInf['nota_pre'];
            $size = $precarInf['size_pre'];
            $tipo = $precarInf['tipo_pre'];

            $sql = $this->connec->query("INSERT INTO archidata (id_archivo, ci_arch, d_archivo, nombre_arch, nota, size, tipo_arch, ubicacion_fis, responsable, delete_arch) 
                                                            VALUES ('$id', '$ci', '$dire', '$note', '$taken', '$size', '$tipo', 2, 0, 0)");

            if ($sql != true) {
                $cake = false;
            } else {
                $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");
                $location[] = [
                    'redirec' => 'perfil.php?perfil=' . encriptar($precarInf['ci_arch_pre']) . '&parce=true',
                    'estado' => 'succes.personal.ingres'
                ];
                $cake = $location;
            }
        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Mover archivos de Data/archives a Data/delete
     * @param string $id id solicitud
     * @return boolean | array  as array || estado || redirec
     */
    public function deleteArchive($id)
    {
        @$x = $this->connec->query("SELECT * FROM solicitudes_eliminacion_arch WHERE id_solicitud_eliminacion = '$id'");

        $idArch = $x->fetch_object()->id_archivo_eliminar;

        $verifi = $this->connec->query("SELECT * FROM archidata WHERE id_archivo = $idArch AND delete_arch = 0");

        if ($verifi->num_rows == 1) {

            // Obtener la ruta de la carpeta
            $destino = '../data/delete';

            if (!file_exists($destino)) {
                mkdir($destino, 0777, true);
            }

            $id_arch = $verifi->fetch_object()->id_archivo;

            $svp = $this->connec->query("SELECT * FROM archidata WHERE id_archivo = '$id_arch'");
            $arch = $svp->fetch_object();

            $archivo = $arch->d_archivo;
            $nombreArch = $arch->nombre_arch;

            // Mover archivos 
            copy($archivo, $destino . '/' . $id_arch . '==' . $nombreArch);
            unlink($archivo);

            // comprobacion
            if (file_exists($destino . '/' . $id_arch . '==' . $nombreArch)) { //mover archivos a la ruta espesifica

                // Variables de archivos
                $newDir = $destino . "/" . $id_arch . '==' . $nombreArch;

                $change = $this->connec->query("UPDATE archidata SET d_archivo = '$newDir', delete_arch = 1 WHERE id_archivo = '$id_arch'");
                $change = $this->connec->query("UPDATE solicitudes_archivos_precarga SET d_archivo_pre = '$newDir' WHERE id_solicitud_archivo_pre = '$id_arch'");

                if ($change == true) {

                    $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$id'");

                    $location[] = [
                        'redirec' => 'perfil.php?perfil=' . encriptar($arch->ci_arch) . '&parce=true',
                        'estado' => 'succes.arch.move'
                    ];

                    $carmen = $location;
                } else {
                    $carmen = false;
                }
            } else {
                $carmen = false;
            }
        } else {
            $carmen = false;
        }

        return $carmen;
    }

    /**
     * Rechazar solicitud
     * @param string $id id de solicitud
     * @return bool 
     */
    public function rechazarSoli($id)
    {

        // rechazar solicitud
        $query = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = '$id'");

        if ($query == true) {

            $sql1 = $this->connec->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$id'");

            if ($sql1 == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}