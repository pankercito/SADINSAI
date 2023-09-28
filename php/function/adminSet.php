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
 * Esta Funcion retorna el texto dependiendo de si es Admin, Usuario o SysAdmin
 * @param string $admin textByAdmin
 * @param string $user textByUser
 * @param string $sysAdmin textBySysAdmin
 * @return string 
 */
function selectPrint($admin, $user, $sysAdmin = null)
{
    $adpval = $_SESSION['admincheck'];

    if ($adpval != 2) {
        if ($adpval == TRUE) {
            return $admin;
        } else {
            return $user;
        }
    }else {
       return $sysAdmin;
    }
}