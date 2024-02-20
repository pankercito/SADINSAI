<?php

class GestionData extends Auditoria
{

    /**
     * Summary of id
     * @var 
     */
    private $id;

    /**
     * Summary of __construct
     * @param mixed $id id del usuasrio que esta realizando la gestion
     * @throws \Exception
     */
    public function __construct($id){

        $this->id = $id;

        parent::__construct();

        if ($this->id == ''){
            throw new Exception("Estas haciendo una llamada no valida, revisa la documentacion", 1);
        }
    }

    /**
     * Agrega los datos de precarga a la tabla personal
     * @return boolean | array  as array || estado || redirec
     */
    public function addPersonal()
    {

        $sql = $this->connec->query("SELECT * FROM solicitudes t 
                                              INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = t.id_solicitud 
                                              INNER JOIN estados e ON p.id_estado_pre = e.id_estado
                                              INNER JOIN ciudades c ON p.id_ciudad_pre = c.id_ciudad
                                              INNER JOIN sedes s ON p.id_sede_pre = s.sede_id
                                              INNER JOIN cargo g ON  p.cargo_pre = g.id_cargo
                                              INNER JOIN departamentos d ON p.departamento_pre = d.id_direccion
                                              WHERE t.id_solicitud = $this->id");

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
            $departament = $dat['departamento_pre'];

            $array = [
                'ci' => $dat['ci_pre'],
                'nombre' => $dat['nombre_pre'],
                'apellido' => $dat['apelido_pre'],
                'grado' => $dat['grado_ac_pre'],
                'fecha' => $dat['fecha_nac_pre'],
                'sexo' => $dat['sexo_pre'],
                'estado' => $dat['estado'],
                'ciudad' => $dat['ciudad'],
                'sede' => $dat['nombre_sede'],
                'direccion' => $dat['direccion_pre'],
                'email' => $dat['email_pre'],
                'telefono' => $dat['telefono_pre'],
                'cargo' => $dat['cargo_nombre'],
                'departamento' => $dat['dir_nombre']
            ];

            if ($this->registIngres($array)) { // REGISTRO DE MOVIMIENTO

                $sql1 = $this->connec->query("INSERT INTO personal (ci, nombre,apellido, grado_ac, fecha_nac, sexo, id_estado, id_ciudad ,sede_id,direccion, email, telefono, cargo, departamento)
                                                 VALUES ('$ci', '$nombre', '$apellido', '$grado', '$fecha', '$sexo', '$estado', '$ciudad', '$sede', '$dirr', '$mail', '$celp',' $cargo', '$departament')");

                if ($sql1 != true) {
                    $cake = "error.to.sql";
                } else {

                    $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$this->id'");

                    $location[] = [
                        'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_pre']) . '&parce=true',
                        'estado' => 'succes.personal.ingres'
                    ];
                    $cake = $location;
                }
            }
        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Edita los datos de la tabla personal con los datos de Solicitud precarga
     * @return boolean | array  as array || estado || redirec
     */
    public function editPersonal()
    {
        // aceptar solicitud 
        $sql = $this->connec->query("SELECT * FROM solicitudes t 
                                              INNER JOIN solicitudes_precarga p ON p.id_solicitud_precarga = t.id_solicitud 
                                              INNER JOIN estados e ON p.id_estado_pre = e.id_estado
                                              INNER JOIN ciudades c ON p.id_ciudad_pre = c.id_ciudad
                                              INNER JOIN sedes s ON p.id_sede_pre = s.sede_id
                                              INNER JOIN cargo g ON  p.cargo_pre = g.id_cargo
                                              INNER JOIN departamentos d ON p.departamento_pre = d.id_direccion
                                              WHERE t.id_solicitud = $this->id");
        $dat = $sql->fetch_assoc();

        $personalData = $this->connec->query("SELECT * FROM personal p
                                                       INNER JOIN estados e ON p.id_estado = e.id_estado
                                                       INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                                                       INNER JOIN sedes s ON p.sede_id = s.sede_id
                                                       INNER JOIN cargo g ON  p.cargo = g.id_cargo
                                                       INNER JOIN departamentos d ON p.departamento = d.id_direccion
                                                       WHERE ci = '{$dat['ci_pre']}'");
        $dat2 = $personalData->fetch_assoc();

        if ($sql == true) {

            $arry2 = [
                'ci' => trim($dat['ci_solicitada']),
                'nombre' => trim($dat['nombre_pre']),
                'apellido' => trim($dat['apelido_pre']),
                'grado' => trim($dat['grado_ac_pre']),
                'nacimiento' => trim($dat['fecha_nac_pre']),
                'sexo' => trim($dat['sexo_pre']),
                'estado' => trim($dat['estado']),
                'ciudad' => trim($dat['ciudad']),
                'sede' => trim($dat['nombre_sede']),
                'direccion' => trim($dat['direccion_pre']),
                'email' => trim($dat['email_pre']),
                'telefono' => trim($dat['telefono_pre']),
                'cargo' => trim($dat['cargo_nombre']),
                'departamento' => trim($dat['dir_nombre'])
            ];

            $arry1 = [
                'ci' => trim($dat2['ci']),
                'nombre' => trim($dat2['nombre']),
                'apellido' => trim($dat2['apellido']),
                'grado' => trim($dat2['grado_ac']),
                'nacimiento' => trim($dat2['fecha_nac']),
                'sexo' => trim($dat2['sexo']),
                'estado' => trim($dat2['estado']),
                'ciudad' => trim($dat2['ciudad']),
                'sede' => trim($dat2['nombre_sede']),
                'direccion' => trim($dat2['direccion']),
                'email' => trim($dat2['email']),
                'telefono' => trim($dat2['telefono']),
                'cargo' => trim($dat2['cargo_nombre']),
                'departamento' => trim($dat2['dir_nombre'])
            ];

            if ($this->registChange($arry1, $arry2)) {
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
                                                      cargo = '{$dat['cargo_pre']}',
                                                      departamento = '{$dat['cargo_pre']}'
                                                      WHERE ci = '{$dat['ci_pre']}'");
                if ($sql1 != true) {
                    $cake = false;
                } else {
                    $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$this->id'");
                    $location[] = [
                        'redirec' => 'perfil.php?perfil=' . encriptar($dat['ci_pre']) . '&parce=true',
                        'estado' => 'succes.personal.ingres'
                    ];
                    $cake = $location;
                }
            }


        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Ingreso de archivo de archivos_precarga a archidata
     * @return boolean | array  as array || estado || redirec
     */
    public function addArchive()
    {
        $svp = $this->connec->query("SELECT * FROM solicitudes s INNER JOIN solicitudes_archivos_precarga p ON p.id_solicitud_archivo_pre = s.id_solicitud WHERE s.id_solicitud = '$this->id'");
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

            if ($this->registArch()) {
                $sql = $this->connec->query("INSERT INTO archidata (id_archivo, ci_arch, d_archivo, nombre_arch, nota, size, tipo_arch, ubicacion_fis, responsable, delete_arch) 
                                                            VALUES ('$this->id', '$ci', '$dire', '$note', '$taken', '$size', '$tipo', 2, 0, 0)");

                if ($sql != true) {
                    $cake = false;
                } else {
                    $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$this->id'");
                    $location[] = [
                        'redirec' => 'perfil.php?perfil=' . encriptar($precarInf['ci_arch_pre']) . '&parce=true',
                        'estado' => 'succes.personal.ingres'
                    ];
                    $cake = $location;
                }
            }

        } else {
            $cake = false;
        }
        return $cake;
    }

    /**
     * Mover archivos de Data/archives a Data/delete
     * @return bool | array  as array || estado || redirec
     */
    public function deleteArchive()
    {
        @$x = $this->connec->query("SELECT * FROM solicitudes_eliminacion_arch WHERE id_solicitud_eliminacion = '$this->id'");

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

            if ($this->registArchDel()) {
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

                        $sql2 = $this->connec->query("UPDATE solicitudes SET apr_estado = '1' WHERE id_solicitud = '$this->id'");

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
    public function rechazarSoli()
    {
        if ($this->registRechaz() == true) {
            // rechazar solicitud
            $query = $this->connec->query("SELECT * FROM solicitudes WHERE id_solicitud = '$this->id'");

            if ($query == true) {

                $sql1 = $this->connec->query("UPDATE solicitudes SET apr_estado = '2' WHERE id_solicitud = '$this->id'");

                if ($sql1 == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
