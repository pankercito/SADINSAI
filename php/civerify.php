<?php

include "../php/class/conx.php";

if (isset($_POST["cedula"])){

    $conn = new Conexion();

    $subcedula  = $conn->real_escape($_POST["cedula"]);
    
    $cvp = $conn->query("SELECT * FROM registro WHERE ci = '$subcedula'");
    $cv = mysqli_num_rows($cvp);
    
    if($cv == 1){
        // Redireccion
	    header('location: ../public/anadir.php?users/register=true&users/registerfall=true');
    }else{
        $cvp1 = $conn->query("SELECT * FROM personal WHERE ci = '$subcedula'");
        $cv1 = mysqli_num_rows($cvp1);
        
        if ($cv1 == 1){
            session_start();
            $_SESSION['subcedula']= $subcedula;
            // Redireccion
    	    header('location: ../public/anadir.php?users/register-two=true');
        }else{
            // Redireccion
            header('location: ../public/anadir.php?users/register=true&users/register/cvfail=true');
        }    
    }
}