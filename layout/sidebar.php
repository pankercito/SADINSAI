<section name="cromaconten">
    <div class="col contencroma">
        <div class="croma col">
            <?php

            echo '<div class="col d-flex"><p class="welcome">¡Bienvenido ' . $wname . '!</p><img src="../resources/ins.png" alt="insailogo" class="logito"  height="32"></div>';

            if (isset($_GET["perfil"])) {
                include '../layout/archives.php';
            }
            ?>
        </div>
    </div>
</section>