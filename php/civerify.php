<?php

if (isset($_POST["cedula"])){
    
    require ("conect.php");

    $subcedula = ($_POST['cedula']);
    
    $cvp = mysqli_query($connec, "SELECT * FROM perfiles WHERE ci = '$subcedula'");
    
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