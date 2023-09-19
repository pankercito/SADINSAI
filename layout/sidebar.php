<div class="croma col-lg-12  col-ms-12">
    <?php
    echo '<p class="welcome">¡Bienvenido ' . $wname . '!</p>';

    if (isset($_GET["perfil"])) {
        include('../layout/archives.php');
    }
    ?>
</div>