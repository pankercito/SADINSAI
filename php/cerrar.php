<?php 

session_start();

if(isset($_SESSION['nombredelusuario']))
<<<<<<< HEAD
{   
=======
{
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
    session_destroy();
	header('location: ../index.php');
}else{
    session_destroy();
	header('location: ../index.php');
}
