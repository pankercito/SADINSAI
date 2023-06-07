<?php

function initSesion($user){
    include("conect.php");
    $ssn = mysqli_query($connec, "UPDATE registro SET sesion = '1' WHERE registro.id_usuario = $user");
    $connec->close();
}

function outSesion($user){    
    include("conect.php");
    $ssn = mysqli_query($connec, "UPDATE registro SET sesion = '0' WHERE registro.id_usuario = $user");
    $connec->close();
}