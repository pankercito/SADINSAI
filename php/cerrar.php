<?php 

session_start();

if(isset($_SESSION['nombredelusuario']))
{
    session_destroy();
	header('location: ../index.php');
}else{
    session_destroy();
	header('location: ../index.php');
}
