<?php

if (isset($_POST["cedula"])){
    
    require ("conect.php");

    $subcedula = ($_POST['cedula']);
    
    $cvp = mysqli_query($connec, "SELECT * FROM registro WHERE ci = '$subcedula'");
    $cv = mysqli_num_rows($cvp);
    
    if($cv == 1){
        
        // Redireccion
	    header('location: ../public/anadir.php?users/register=true&users/registerfall=true');
    }else{
        
        $cvp1 = mysqli_query($connec, "SELECT * FROM personal WHERE ci = '$subcedula'");
        $cv1 = mysqli_num_rows($cvp1);

        if ($cv1 == 1){

            session_start();
            $_SESSION['subcedula']= $subcedula;
    	    header('location: ../public/anadir.php?users/register-two=true');
        }else{
	        
            header('location: ../public/anadir.php?users/register=true&users/register/cvfail=true');
        } 
        
    }
}