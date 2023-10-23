<script type="text/javascript">
    // Obtener verifiacion de notificación desde PHP
    const activo = "<?php  echo $_SESSION["noti"]?>";

    <?php

    // URL actual sin los parámetros GET
    $actUrl = strtok($_SERVER['REQUEST_URI'], '?');

    if ($actUrl != '/public/gestionData.php') {
        ?>

        const mensaje = "Solicitud realizada con exito";

        <?php
    } else {
        ?>

        const mensaje = "Gestion de datos realizada con exito";

        <?php
    }

    ?>

    localStorage.setItem('activeSection', '<?php echo (strtok($_SERVER['REQUEST_URI'], '?') == '/public/solicitudes.php') ? 4 : 5 ?>');

    if (window.onload) {

        setTimeout(() => {
            // tipo,
            // msj,
            // activo.
            notifySolis(1, mensaje, activo);
        }, 1500);
    }
</script>

<?php $_SESSION["noti"] = 0 ?>