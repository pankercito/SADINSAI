<?php

if (isset($_GET["perfil"])) {
    require_once "../layout/perfil.php";
} else {
    echo "lo sentimos hay un error en el servidor :(";
}