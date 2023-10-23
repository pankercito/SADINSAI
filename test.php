<?php

class solicitudes
{
    const Solicitud_Vacaciones = 'Solicitud Vacaciones';
    const Solicitud_Permiso = 'Solicitud Permiso';
    const Solicitud_Aprobacion = 'Solicitud Aprobacion';

    public static function usersActives()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=sadinsai', 'root', '');

        $query = "SELECT * FROM registro ORDER BY sesion DESC";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if ($row['adp'] != 2) {
                $result[] = [
                    "ci" => $row['ci'],
                    "user" => ucfirst(strtolower($row['user'])),
                    "active" => $row['sesion']
                ];
            }
        }

        return $result;
    }
}

$new = new solicitudes(solicitudes::Solicitud_Aprobacion, );

echo "usuarios: <br>" . solicitudes::usersActives()['1']['user'];

echo "<hr>";

interface Solicitud
{
    public function getTipo(): string;
    public function getDatos(): array;
}

class SolicitudVacaciones implements Solicitud
{
    protected $tipo;
    protected $datos;

    public function __construct($tipo, $datos)
    {
        $this->tipo = $tipo;
        $this->datos = $datos;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getDatos(): array
    {
        return $this->datos;
    }
}

class FabricaSolicitudes
{
    public static function crearSolicitud($tipo, $datos): Solicitud
    {
        switch ($tipo) {
            case 'Solicitud Vacaciones':
                return new SolicitudVacaciones($tipo, $datos);
            default:
                throw new Exception('Tipo de solicitud no válido');
        }
    }
}

$solicitud = FabricaSolicitudes::crearSolicitud('SolicitudVacaciones', [
    'fecha_inicio' => '2023-10-12',
    'fecha_fin' => '2023-10-26',
    'motivo' => 'Vacaciones familiares',
]);

echo $solicitud->getTipo();
echo '<pre>';
print_r($solicitud->getDatos());
echo '</pre>';
