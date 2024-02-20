<?php


/**
 * Controlador de UserCase de usuario
 * incluir junto a este la funcion UserData
 */
class GestionDeUsuarios
{
    /**
     * Summary of id
     * @var 
     */
    private $id;
    /**
     * Summary of connec
     * @var 
     */
    private $connec;
    /**
     * Summary of sesion
     * @var 
     */
    private $sesion;
    /**
     * Summary of auditoria
     * @var 
     */
    private $auditoria;

    /**
     * Summary of __construct
     * @param mixed $id
     */
    public function __construct(UserModel $user = null)
    {
        @session_start();
        $this->sesion = $_SESSION['sesion'] ?? null;

        $this->connec = new Conexion;
        $this->auditoria = new Auditoria;

        if (@$user->id) {
            $this->id = $user->id;
        }
    }

    /**
     * Summary of byId
     * @param mixed $id
     * @return GestionDeUsuarios
     */
    public function byId($id)
    {
        $user = new UserModel(getUserData($id));

        return new GestionDeUsuarios($user);
    }

    /**
     * Summary of byCi
     * @param mixed $ci
     * @return GestionDeUsuarios
     */
    public function byCi($ci)
    {
        $user = new UserModel(getUserData(null, $ci));

        return new GestionDeUsuarios($user);
    }
    /**
     * Desactivar usuario
     * @return bool
     */
    public function supenderUsuario()
    {
        $si = $this->connec->query("UPDATE registro SET active = 2 WHERE id_usuario = {$this->id}");

        if ($this->sesion != null) {
            $this->auditoria->registActivUser();
        }

        if ($si) {
            return true;
        }
        return false;
    }

    /**
     * Activar usuario
     * @param mixed $this->id id de usuario
     * @param mixed $senha ci (opcional)
     * @return bool
     */
    public function activarUsuario()
    {
        $si = $this->connec->query("UPDATE registro SET active = 1 WHERE id_usuario = '$this->id'");

        if ($this->sesion != null) {
            $this->auditoria->registActivUser();
        }

        if ($si) {
            return true;
        }
        return false;
    }

    /**
     * Eliminar Usuario del Sistema
     * @param mixed $this->id id de usuario
     * @param mixed $senha ci (opcional)
     * @return bool
     */
    public function deleteUser()
    {

        if ($this->sesion != null) {
            $this->auditoria->registDeleteUser();
        }

        $si = $this->connec->query("DELETE FROM registro WHERE id_usuario = '$this->id'");

        if ($si) {
            return true;
        }
        return false;
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
     * Obtener listado de usuarios totales en el sistema
     * @param  string $yo sesion de usuario q no es visible en los resultado
     * @return  array $result array 
     */
    public function users($yo)
    {
        $regisview = $this->connec->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci");

        // verificacion de tipo de usuario
        $verifi = $this->connec->query("SELECT * FROM registro WHERE id_usuario = '$yo'");
        $yoadp = $verifi->fetch_object();

        //Si ha resultados
        if (mysqli_num_rows($regisview) > 1) {

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
                " ",
                " ",
                "sin informacion",
                " ",
                " "
            ];

            $new_array = ["data" => $data];
        }

        return $new_array;
    }
}