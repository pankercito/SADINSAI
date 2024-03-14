<?php

session_start();
include "../php/configIncludes.php";

if (isset($_POST['login'])) {

    $conn = new Conexion;

    $usuariolg = $conn->real_escape(trim($_POST['userlg']));
    $pass = $conn->real_escape(trim($_POST['passlg']));

    @$userLogin = new User(getUserHash(null, null, $usuariolg));

    if ($userLogin->usuario == null) {
        // Contraseña errada
        header('location:../index.php?fallo=true');
        exit;
    }

    $userCase = new UserUseCase($userLogin);

    switch ($userCase->validarUsuario($pass, $usuariolg)) {
        case 1:
            // Contraseña correcta
            switch ($userLogin->sesion) {
                case false:
                    $_SESSION['userdata'] = ucwords("{$userLogin->nombre} {$userLogin->apellido}");
                    $_SESSION['cidelusuario'] = $userLogin->ci;
                    $_SESSION['sesion'] = $userLogin->getUserId();
                    $_SESSION['admincheck'] = $userLogin->adp;
                    $_SESSION['event'] = str_replace(" ", '', "{$userLogin->nombre}{$userLogin->apellido}{$userLogin->ci}");
                    $event = $_SESSION['event'];

                    $nueva_hora = hora10();

                    $_SESSION['LAST_ACTIVITY'] = time(); 

                    $gestionDeUsuario = new UserAuditoria();

                    if ($gestionDeUsuario->inicioDeSesion()) {
                        // eliminar evento de inicio en la base de datos si ya existe
                        $delevent = "DROP EVENT IF EXISTS $event";
                        $conn->query($delevent);

                        //variable de inicio de sesion en BD
                        if ($userCase->inicioDeSesion()) {
                            $_SESSION['sesioninit'] = $userLogin->sesion;
                        } else {
                            throw new Exception("Error iniciando sesion usercase", 1);
                        }

                        //encender eventos en la base de datos
                        $eventOn = $conn->query("SET GLOBAL event_scheduler='ON'");

                        $crtevent = "CREATE EVENT $event ON SCHEDULE AT '$nueva_hora' DO UPDATE registro SET sesion = '0' WHERE id_usuario = '{$userLogin->getUserId()}'";
                        $bdEvent = $conn->query($crtevent);

                        if (!$bdEvent) {
                            echo $conn->error();
                            echo $bdEvent;
                            throw new Exception("Error guardando el evento", 1);
                        }
                    } else {
                        throw new Exception("Error iniciando sesion", 1);
                    }

                    // Redirecciono al usuario a la página principal del sitio.
                    header("HTTP/1.1 302 Moved Temporarily");
                    switch ($userLogin->adp) {
                        case 1:
                            header('location:../public/principal.php');
                            break;
                        case 2:
                            header('location:../public/sysAdmin.php');
                            break;
                        default:
                            header('location:../public/perfil.php?perfil=' . encriptar($userLogin->ci));
                            break;
                    }
                    break;
                default:
                    header('location:../index.php?session-dup=true');
                    break;
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