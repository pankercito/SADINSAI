<?php 

session_start();

if(isset($_SESSION['nombredelusuario']))
{
<<<<<<< HEAD
    session_destroy();
	header('location: ../index.php');
}else{
=======
>>>>>>> 55d05f745a4f7d3d2e337ea2b3f8c7d9c882ffbe
    session_destroy();
	header('location: ../index.php');
}
