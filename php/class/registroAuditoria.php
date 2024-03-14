<?php

final class RegistroAuditoria
{
    private $conexion;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->conexion = new Conexion;
    }

    /**
     * retorna una instancia de AuditoriaModel
     * @param mixed $id
     * @return AuditoriaModel
     */
    public function porID($id)
    {
        return new AuditoriaModel($id);
    }


    /**
     * Retorna array de instancias de AuditoriaModel
     * @return array<AuditoriaModel>
     */
    public function auditsList()
    {
        $precarInf = $this->conexion->query("SELECT * FROM auditoria a INNER JOIN registro r ON r.id_usuario = a.id_usuario_audi  ORDER BY fecha_audi DESC");

        $au = [];
        while ($key = $precarInf->fetch_object()) {
            $au[] = ($precarInf->num_rows > 0) ? new AuditoriaModel($key->id) : [];
        }
        return $au;
    }
}


class AuditoriaModel
{
    public $id;
    public $idUsuario;
    public $usuario;
    public $tipo;
    public $cambios;
    public $fecha;
    public $conexion;

    function __construct($id)
    {
        $this->conexion = new Conexion;
        $this->id = $this->conexion->real_escape($id);

        $precarInf = $this->conexion->query("SELECT * FROM auditoria a INNER JOIN registro r ON r.id_usuario = a.id_usuario_audi WHERE id = '{$this->id}'");

        if ($precarInf->num_rows > 0) {
            while ($d = $precarInf->fetch_object()) {
                $this->id = $d->id;
                $this->idUsuario = $d->id_usuario;
                $this->usuario = $d->user;
                $this->tipo = $d->tipo_movi;
                $this->cambios = $d->cambios;
                $this->fecha = $d->fecha_audi;
            }
        } else {
            $this->setValoresPorDefecto();
        }
        $this->conexion->close();
    }

    private function setValoresPorDefecto()
    {
        $this->id = 'sin datos';
        $this->usuario = 'sin datos';
        $this->tipo = 'sin datos';
        $this->cambios = 'sin datos';
        $this->fecha = 'sin datos';
    }
}


