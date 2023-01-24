<?php

session_start();

if(isset($_SESSION['nombredelusuario']))
{
	header('location:../principal.php');
}

if(isset($_POST['login']))
{
    include ("../php/conect.php");

    $usuario=$_POST['usuario'];
    $pass=$_POST['password'];

    $check=mysqli_query($connec,"SELECT * FROM registro where user = '$usuario' AND pass = '$pass'");
    $nr=mysqli_num_rows($check);

	
if (!isset($_SESSION['nombredelusuario']))
    {
    if($nr == 1)
    {
        $dataview= mysqli_fetch_assoc($check);

        $_SESSION['nombredelusuario']=$dataview['nombre'];
        // Redirecciono al usuario a la página principal del sitio.
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../principal.php');
    }
    else {
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../index.php?fallo=true');
    }
    }
}