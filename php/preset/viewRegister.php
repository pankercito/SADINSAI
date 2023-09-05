<?php

$regisview = $conn->query("SELECT * FROM registro r INNER JOIN personal p ON r.ci = p.ci");
    
$count_results = mysqli_num_rows($regisview);

//Si ha resultados

if ($count_results > 0) {
    //Muestra la cantidad de usuarios    
    
    while ($v = mysqli_fetch_array($regisview)){

        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a id="vrname" href="perfil.php?perfil='.encriptar($v['ci']).'&parce=true">'.strtoupper(strtolower($v['user'])).'</a></td>';
        echo '<td><a>'.ucwords(strtolower($v['nombre'])).'</a></td>';
        echo '<td><a>'.ucwords(strtolower($v['apellido'])).'</a></td>';
        echo '<td><a>'.$v['ci'].'</a></td>';
        echo '</tr>';
    }
}else {
        //Si no hay registros encontrados
        echo '<h2>No se encuentran resultados con los criterios de búsqueda.</h2>';
    }