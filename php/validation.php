<?php

session_start();

if(isset($_SESSION['nombredelusuario'])){

    header('location:../principal.php');
}

if(isset($_POST['login'])){

    include ("conect.php");

<<<<<<< HEAD
    $usuariolg = $_POST['userlg'];
    $pass = $_POST['passlg'];

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN perfiles p ON r.ci = p.ci WHERE user = '$usuariolg' AND pass = '$pass'");
    $nr = mysqli_num_rows($check);

	
    if (!isset($_SESSION['nombredelusuario'])){

        if($nr == 1){
        
            $dataview= mysqli_fetch_assoc($check);
=======
    $usuariolg=$_POST['userlg'];
    $pass=$_POST['passlg'];

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN perfiles p ON r.ci = p.ci WHERE user = '$usuariolg' AND pass = '$pass'");
    $nr=mysqli_num_rows($check);

	
if (!isset($_SESSION['nombredelusuario']))
    {
    if($nr == 1){
        
        $dataview= mysqli_fetch_assoc($check);

        $_SESSION['nombredelusuario']= $dataview['nombre'];
        $_SESSION['apellidodelusuario']= $dataview['apellido'];
        $_SESSION['admincheck']= $dataview['adp'];
>>>>>>> 55d05f745a4f7d3d2e337ea2b3f8c7d9c882ffbe

            $_SESSION['nombredelusuario']= $dataview['nombre'];
            $_SESSION['apellidodelusuario']= $dataview['apellido'];
            $_SESSION['admincheck']= $dataview['adp'];

            // Redirecciono al usuario a la página principal del sitio.
            header("HTTP/1.1 302 Moved Temporarily"); 
            header('location:../principal.php?perfil=true');
        }else {
            header("HTTP/1.1 302 Moved Temporarily"); 
	        header('location:../index.php?fallo=true');
        }
    }
}
