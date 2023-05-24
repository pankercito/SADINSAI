<?php

include('conect.php');

if(isset($_GET['onlystate'])){
    $stonly = $_GET['onlystate'];
    $sql = mysqli_query($connec,"SELECT * FROM estados WHERE id_estado = '$stonly'");

    $count_results = mysqli_num_rows($sql);

    while($row_searched = mysqli_fetch_array($sql)){
        $estados = array(
            $row_searched['id_estado'] => $row_searched['estado'],
        );
    }
}else{

}
    
