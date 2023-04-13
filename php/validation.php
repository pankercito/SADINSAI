<?php

session_start();

if(isset($_POST['login'])){

    include ("conect.php");

    $usuariolg = $_POST['userlg'];
    $pass = $_POST['passlg'];

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN perfiles p ON r.ci = p.ci WHERE user = '$usuariolg' AND pass = '$pass'");
    $nr = mysqli_num_rows($check);

	
    if(!isset($_SESSION['sesioninit'])){

        if($nr == 1){
        
            $dataview= mysqli_fetch_array($check);
            $n1 = $dataview['nombre'];
            $n2 = $dataview['apellido'];
            
            $_SESSION['sesioninit'] = ''.$n1.' '.$n2.'';
            $_SESSION['cidelusuario'] = $dataview['ci'];
            $_SESSION['admincheck'] = $dataview['adp'];

            // Redirecciono al usuario a la página principal del sitio.
            header("HTTP/1.1 302 Moved Temporarily"); 
            header('location:../principal.php?perfil='.$_SESSION['cidelusuario'].'');
        }else {
            header("HTTP/1.1 302 Moved Temporarily"); 
	        header('location:../index.php?fallo=true');
        }
    }else{
        session_destroy();
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../index.php?session.dup=true');
    }
}