<?php
    $v_tabla = 'perfiles'; //tabla
    $v_colum = 'ci'; //columna de la tabla    
    $v_data = $_GET['perfil']; //dato a comparar

    include_once('query.where.php');

    $count_results = mysqli_num_rows($regisview);
    
    if ($count_results > 0 ){
        $perfils = mysqli_fetch_array($regisview);

        $n1 = ''.$perfils['nombre'].' '.$perfils['apellido'].'';
        $pname = $n1;
        $pci = $perfils['ci'];
        $pphone = $perfils['telefono'];

    }else{
        $pname = "Sin datos";
        $pci = "Sin datos";
        $pphone = "Sin datos";
    }