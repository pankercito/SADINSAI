<?php

    if($_POST['verificar_usuarios'] == "") { //<-- Verificas que exista el index
        
        echo = "";

    }else{

        $inclue('conect.php');

        $v_data = $_POST['verificar_usuarios']; //dato a comparar

        $cnce = mysqli_query($connec, "SELECT * FROM registro WHERE user = $v_data ");

        $count_results = mysqli_num_rows($cnce);
        if ($count_results > 0 ){
            
            echo '<div id="Error">Cedula ya existente</div>'; 
        }else{

            echo '<div id="Save">Cachito</div>';
        }
    }