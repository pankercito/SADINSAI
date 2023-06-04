<?php

if (isset($_GET["solicitud"])){
    require_once ("../layout/solicitudFormulario.php");
}else{
    echo "";
}