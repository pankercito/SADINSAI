<?php

session_start();

if (isset($_POST['login'])) {

    include "class/classIncludes.php";
    include "function/criptCodes.php";
    include "function/sesion.php";
    include "function/sumarhora.php";

    $conn = new Conexion;

    $usuariolg = $conn->real_escape(trim($_POST['userlg']));
    $pass = $conn->real_escape(trim($_POST['passlg']));

    $auditoria = new Auditoria;

    $userLogin = new UserModel($usuariolg);

    if ($userLogin->user == null) {
        // Contraseña errada2
        header('location:../index.php?fallo=true');
        exit;
    }

    $trix = desencriptar($userLogin->hash);

    $gestionUsuarios = new GestionDeUsuarios($userLogin);

    // si el usuario esta desactivado
    if ($userLogin->active == 2 || $userLogin->active == 0) {
        header('location:../index.php?userdes=true');
        exit;
    }

    if ($pass == $trix) { //contraseña correcta 
        $resultado = 1;
    } else {
        if (!isset($_SESSION['errorContra'])) {
            $_SESSION['errorContra'] = 1;
        }

        if ($_SESSION['errorName'] != $usuariolg) {
            $_SESSION['errorContra'] = 1;
        }

        if ($_SESSION['errorContra'] == 3 && $_SESSION['errorName'] == $usuariolg) {
            $gestionUsuarios->supenderUsuario();
            $_SESSION['errorContra'] = 0;
            $resultado = 2;
        } else {
            $_SESSION['errorContra']++;
            $_SESSION['errorName'] = $usuariolg;
            $resultado = 3;
        }
    }

    switch ($resultado) {
        case 1: // Contraseña correcta
            if ($userLogin->sesion == FALSE) { //no hay sesion activa
                $_SESSION['userdata'] = '' . ucwords(strtolower($userLogin->nombre)) . ' ' . ucwords(strtolower($userLogin->apellido)) . '';
                $_SESSION['cidelusuario'] = $userLogin->ci;
                $_SESSION['sesion'] = $userLogin->id;
                $_SESSION['sesioninit'] = $userLogin->sesion;
                $_SESSION['admincheck'] = $userLogin->adp;

                $id = strval($userLogin->id);
                $taken = str_replace(' ', '', strtolower($userLogin->nombre . $userLogin->apellido));
                $_SESSION['event'] = $taken . $id;
                $event = $taken . $id;

                $nueva_hora = hora10();

                if ($auditoria->sesionInit($id)) {
                    $delevent = "DROP EVENT IF EXISTS $event";
                    $conn->query($delevent);

                    //encender eventos en la base de datos
                    @$eventOn = $conn->query("SET GLOBAL event_scheduler='ON'");

                    $event = "CREATE EVENT $event ON SCHEDULE AT '$nueva_hora' DO UPDATE registro r SET sesion = '0' WHERE r.id_usuario = '$id'";
                    $conn->query($event);
                }

                $_SESSION['LAST_ACTIVITY'] = time();

                initSesion($userLogin->id); //variable de inicio de sesion en BD

                // Redirecciono al usuario a la página principal del sitio.
                header("HTTP/1.1 302 Moved Temporarily");
                if ($userLogin->adp == 1) {
                    header('location:../public/principal.php');
                } elseif ($userLogin->adp == 2) {
                    header('location:../public/sysAdmin.php');
                } else {
                    header('location:../public/perfil.php?perfil=' . encriptar($_SESSION['cidelusuario']));
                }
            } else if ($userLogin->sesion == TRUE) {
                header('location:../index.php?session-dup=true');
            }
            break;
        case 2: // Usuario deshabilitado
            header('location:../index.php?userdes=true');
            break;
        default: // Contraseña errada
            header('location:../index.php?fallo=true');
            break;
    }
}