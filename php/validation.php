<?php

session_start();

if(isset($_POST['login'])){

    include("conect.php");
    include("funtion/encriptDesencript.php");
    include("funtion/sesion.php");
    include("funtion/sumarhora.php");

    $usuariolg = mysqli_real_escape_string($connec, $_POST['userlg']);
    $pass = mysqli_real_escape_string($connec, $_POST['passlg']);

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci WHERE user = '$usuariolg'");
    $nr = mysqli_num_rows($check);
    $dataview= mysqli_fetch_array($check);
    $trix = desencriptar($dataview['pass']);

    if($nr == 1 && $pass == $trix){ //contraseña correcta
        
        if($dataview['sesion'] == FALSE){//no hay sesion activa         
            $_SESSION['userdata'] = ''.ucwords(strtolower($dataview['nombre'])).' '.ucwords(strtolower($dataview['apellido'])).'';
            $_SESSION['cidelusuario'] = $dataview['ci'];
            $_SESSION['sesion'] = $dataview['id_usuario'];
            $_SESSION['sesioninit'] = $dataview['sesion'];
            $_SESSION['admincheck'] = $dataview['adp'];
            
            $id = strval($dataview['id_usuario']);
            $taken = str_replace(' ','' ,strtolower($dataview['nombre']));
            $_SESSION['event'] = $taken.$id;
            
            $nueva_hora = hora10();
            
            $event = "CREATE EVENT $taken$id ON SCHEDULE AT '$nueva_hora' DO UPDATE registro r SET sesion = '0' WHERE r.id_usuario = '$id'";        
            $check = mysqli_query($connec, $event);
            
            $_SESSION['LAST_ACTIVITY'] = time();
            
            $sn = initSesion($dataview['id_usuario']); //variable de inicio de sesion en BD
            
            
            $connec->close();
            
            // Redirecciono al usuario a la página principal del sitio.
            header("HTTP/1.1 302 Moved Temporarily"); 
            header('location:../public/principal.php?perfil='.encriptar($_SESSION['cidelusuario']).'');
        }else if($dataview['sesion'] == TRUE){
            $connec->close();
            header("HTTP/1.1 302 Moved Temporarily"); 
            header('location:../index.php?session-dup=true');
        }
    }else{
        //Contraseña errada
        $connec->close();
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../index.php?fallo=true');
    }
}