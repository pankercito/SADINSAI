<?php

/**
 * Esta Funcion añade al documento un archivo
 * dependiendo de si es Admin o Usuario
 * @param string $admin archive Admin
 * @param string $user archive User
 * @return void
 */
function incluir($admin, $user)
{
    $adpval = $_SESSION['admincheck'];

    if ($adpval == TRUE) {
        include($admin);
    } else {
        include($user);
    }
}

/**
 * Esta Funcion imprime en el documento un archivo
 * dependiendo de si es Admin o Usuario
 * @param string $admin textByAdmin
 * @param string $user textByUser
 * @return void
 */
function imprime($admin, $user)
{
    $adpval = $_SESSION['admincheck'];

    if ($adpval == TRUE) {
        echo $admin;
    } else {
        echo $user;
    }
}