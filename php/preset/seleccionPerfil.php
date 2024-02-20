<?php

if (isset($_GET["perfil"])){
    require_once "../layout/perfil.php";
}else
if(isset($_GET["editar_usuario"])){
    require_once "../layout/editarUsuario.php";
}else{
    echo "lo sentimos hay un error en el servidor :(";
}