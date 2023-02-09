<?php

session_start();

if(isset($_SESSION['nombredelusuario']))
{
	header('location:../principal.php');
}

if(isset($_POST['login']))
{
    include ("conect.php");

    $usuariolg=$_POST['userlg'];
    $pass=$_POST['passlg'];

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN perfiles p ON r.ci = p.ci WHERE user = '$usuariolg' AND pass = '$pass;");
    $nr=mysqli_num_rows($check);

	
if (!isset($_SESSION['nombredelusuario']))
    {
    if($nr == 1){
        
        $dataview= mysqli_fetch_assoc($check);

        $_SESSION['nombredelusuario']= $dataview['nombre'];
        $_SESSION['apellidodelusuario']= $dataview['apellido'];
        $_SESSION['admincheck']= $dataview['adp'];

        // Redirecciono al usuario a la página principal del sitio.
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../principal.php?perfil=true');
    }
    else {
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../index.php?fallo=true');
    }
    }
}
