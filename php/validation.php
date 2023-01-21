<?php

session_start();

if(isset($_SESSION['nombredelusuario']))
{
	header('location:../principal.php');
}

if(isset($_POST['login']))
{
    include ("../php/conect.php");

    $nombre=$_POST['email'];
    $pass=$_POST['password'];

    $query=mysqli_query($connec,"SELECT * FROM registro where email = '$nombre' AND pass = '$pass'");
    $nr=mysqli_num_rows($query);

	
if (!isset($_SESSION['nombredelusuario']))
    {
    if($nr == 1)
    {
    $_SESSION['nombredelusuario']=$nombre;
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