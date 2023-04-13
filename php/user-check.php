<?php
    $v_tabla = 'registro'; //tabla
    $v_colum = 'user'; //columna de la tabla   
    $v_data = $_POST['verificar_usuarios']; //dato a comparar

    if($v_data == "") { //<-- Verificas que exista el index
        echo = "";

    }else{

        $v_tabla = 'registro'; //tabla
        $v_colum = 'user'; //columna de la tabla   
        $v_data = $_POST['verificar_usuarios']; //dato a comparar

        include_once('query.where.php');

        $count_results = mysqli_num_rows($regisview);
    
        if ($count_results > 0 ){
            echo '<div id="Error">Cedula ya existente</div>'; 
        }else{
            echo '<div id="Save">Cachito</div>';
        }
    }