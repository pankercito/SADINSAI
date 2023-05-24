<?php

include('conect.php');

$v_data = $_GET['perfil']; //dato a comparar

if (isset($v_data)){
    $cnce = mysqli_query($connec, "SELECT * FROM personal WHERE ci = $v_data ");
    $count_results = mysqli_num_rows($cnce);

    if ($count_results > 0 ){
        $perfils = mysqli_fetch_array($cnce);

        $pname = ucwords(strtolower(''.$perfils['nombre'].' '.$perfils['apellido'].''));
        $pci = $perfils['ci'];
        $pphone = $perfils['telefono'];

    }else{
        $pname = "Sin datos";
        $pci = "Sin datos";
        $pphone = "Sin datos";
    }
}else{
    $pname = "Sin datos";
    $pci = "Sin datos";
    $pphone = "Sin datos";
}