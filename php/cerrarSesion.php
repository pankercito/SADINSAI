<?php

session_start();

session_destroy();

header("Location: ../index.php"); // redirige al usuario a la página de inicio de sesión

exit;