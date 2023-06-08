<?php

if (isset($_GET["perfil"])){
    require_once ("../layout/perfil.php");
}else
if(isset($_GET["editar"])){

}else{
    echo "lo sentimos hay un error en el servidor :(";
}