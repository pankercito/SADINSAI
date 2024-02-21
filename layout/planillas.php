<?php
    
    $personal = new Personal($_GET['carga']);

    $_SESSION['getPlanillaNombre'] = $personal->getNombre();
    $_SESSION['getPlanillaApellido'] = $personal->getApellido();
    $_SESSION['getPlanillaCI'] = $personal->getCi();
    $_SESSION['getPlanillaCargo'] = $personal->getCargo();
    $_SESSION['getPlanillaDepart'] = $personal->getDepartament();
    $_SESSION['getPlanillaPhon'] = $personal->getTelefono();
    $_SESSION['getPlanillaEst'] = $personal->getEstado();
    $_SESSION['getPlanillaSede'] = $personal->getSede();
?>
<script src="../js/planillas.js"></script>
<style>
    .no-color {
        background: none !important;
    }
</style>

<div id="planillas" class="mx-auto col">

</div>