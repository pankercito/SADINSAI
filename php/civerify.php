<?php

if (isset($_POST["cedula"])){
    
    require ("conect.php");

    $subcedula = ($_POST['cedula']);
    
<<<<<<< HEAD
    $cvp = mysqli_query($connec, "SELECT * FROM perfiles WHERE ci = '$subcedula'");
=======
    $cvp = mysqli_query($connec, "SELECT * FROM prueba.perfiles WHERE ci = '$subcedula'");
>>>>>>> 55d05f745a4f7d3d2e337ea2b3f8c7d9c882ffbe
    
    $cv=mysqli_num_rows($cvp);
    
    if($cv == 1)
    {
        // Redireccion
	    header('location: ../principal.php?users/register=true&users/registerfall=true');
    }
    else {
        session_start();
        $_SESSION['subcedula']= $subcedula;
	    header('location: ../principal.php?users/register-two=true');
    }
}