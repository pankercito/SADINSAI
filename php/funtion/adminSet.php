<?php


function incluir($admin, $noAdmin){
    $adpval = $_SESSION['admincheck'];

    if ($adpval == TRUE){
        include($admin);
    }else{
        include($noAdmin);
    }
}

function imprime($admin, $noAdmin){
    $adpval = $_SESSION['admincheck'];
    
    if($adpval == TRUE){
        echo $admin;
    }else{
        echo $noAdmin;
    } 
}