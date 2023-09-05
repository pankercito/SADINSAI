<?php

session_start();

if (isset($_POST['login'])) {

    include("conx.php");
    include("function/criptCodes.php");
    include("function/sesion.php");
    include("function/sumarhora.php");
    include("class/auditoria.php");

    $usuariolg = $_POST['userlg'];
    $pass = $_POST['passlg'];


    $auditoria = new auditoria();
    $conn = new Conexion();

    $check = $conn->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci WHERE user = '$usuariolg'");
    $nr = mysqli_num_rows($check);
    $dataview = mysqli_fetch_array($check);
    $trix = desencriptar($dataview['pass']);

    if ($nr == 1 && $pass == $trix) { //contraseña correcta

        if ($dataview['sesion'] == FALSE) { //no hay sesion activa         
            $_SESSION['userdata'] = '' . ucwords(strtolower($dataview['nombre'])) . ' ' . ucwords(strtolower($dataview['apellido'])) . '';
            $_SESSION['cidelusuario'] = $dataview['ci'];
            $_SESSION['sesion'] = $dataview['id_usuario'];
            $_SESSION['sesioninit'] = $dataview['sesion'];
            $_SESSION['admincheck'] = $dataview['adp'];

            $id = strval($dataview['id_usuario']);
            $taken = str_replace(' ', '', strtolower($dataview['nombre']));
            $_SESSION['event'] = $taken . $id;
            $event = $taken . $id;

            $nueva_hora = hora10();

            if ($auditoria->sesionInit($dataview['id_usuario'])) {
                $delevent = "DROP EVENT IF EXISTS $event";
                $conn->query($delevent);

                $event = "CREATE EVENT $event ON SCHEDULE AT '$nueva_hora' DO UPDATE registro r SET sesion = '0' WHERE r.id_usuario = '$id'";
                $conn->query($event);
            }

            $_SESSION['LAST_ACTIVITY'] = time();

            $sn = initSesion($dataview['id_usuario']); //variable de inicio de sesion en BD

            // Redirecciono al usuario a la página principal del sitio.
            header("HTTP/1.1 302 Moved Temporarily");
            if($dataview['adp']==1){
                header('location:../public/principal.php');
            }else{
                header('location:../public/perfil.php?perfil=' . encriptar($_SESSION['cidelusuario']) );
                
            }
        } else if ($dataview['sesion'] == TRUE) {
            header("HTTP/1.1 302 Moved Temporarily");
            header('location:../index.php?session-dup=true');
        }
    } else {
        //Contraseña errada
        header("HTTP/1.1 302 Moved Temporarily");
        header('location:../index.php?fallo=true');
    }
}