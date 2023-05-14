<?php

session_start();

if(isset($_POST['login'])){

    include ("conect.php");

    $usuariolg = mysqli_real_escape_string($connec, $_POST['userlg']);
    $pass = mysqli_real_escape_string($connec, $_POST['passlg']);

    $check = mysqli_query($connec,"SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci WHERE user = '$usuariolg' AND pass = '$pass'");
    $nr = mysqli_num_rows($check);

    if(!isset($_SESSION['sesioninit'])){
        
        if($nr == 1){
        
            $dataview= mysqli_fetch_array($check);
    
            $_SESSION['sesioninit'] = ''.ucwords(strtolower($dataview['nombre'])).' '.ucwords(strtolower($dataview['apellido'])).'';
            $_SESSION['cidelusuario'] = $dataview['ci'];
            $_SESSION['admincheck'] = $dataview['adp'];

            // Redirecciono al usuario a la página principal del sitio.
            header("HTTP/1.1 302 Moved Temporarily"); 
            header('location:../public/principal.php?perfil='.$_SESSION['cidelusuario'].'');
        }else {
            
            header("HTTP/1.1 302 Moved Temporarily"); 
	        header('location:../index.php?fallo=true');
        }
    }else{
        
        header("HTTP/1.1 302 Moved Temporarily"); 
	    header('location:../index.php?session-dup=true');
    }
}