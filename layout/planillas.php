<?php

$personal = new Empleado($_GET['c']);

$_SESSION['getPlanillaNombre'] = $personal->nombre;
$_SESSION['getPlanillaApellido'] = $personal->apellido;
$_SESSION['getPlanillaCI'] = $personal->ci;

$personal = $personal->getDetails();

$_SESSION['getPlanillaCargo'] = $personal->cargo;
$_SESSION['getPlanillaDepart'] = $personal->departamento;
$_SESSION['getPlanillaPhon'] = $personal->telefono;
$_SESSION['getPlanillaEst'] = $personal->estado;
$_SESSION['getPlanillaSede'] = $personal->sede;
?>

<script src="../js/planillas.js"></script>
<style>
    .no-color {
        background: none !important;
    }
</style>

<div id="planillas" class="mx-auto col">
    <p>seleccione una planilla</p>
</div>