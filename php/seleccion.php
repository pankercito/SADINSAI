<?php

if (isset($_GET["perfil"])){
    require_once ("layout/perfil.php");
}
if (isset($_GET["users"])){
    require_once ("layout/usuarios.php");
}  
if(isset($_GET["users/register"])){
    require_once ("layout/registrar.php");
}
if(isset($_GET["users/register-two"])){
    require_once ("layout/registrar2.php");
}
if(isset($_GET["users/viewregister"])){
    require_once ("layout/tablauser.php");
}
if(isset($_GET["states"])){
    require_once ("layout/tablestates.php");
}
if(isset($_GET["onlystate"])){
    require_once ("layout/statesgrid.php");
}
if(isset($_GET["onlysede"])){
    require_once ("layout/sedegrid.php");
}
if(isset($_GET["adminregister"])){
    require_once ("adregis.php");
<<<<<<< HEAD
}
if(isset($_GET["scan"])){
    require_once("tesseract/form-image.php");
}
if(isset($_GET["result"])){
    require_once("tesseract/init.php");
=======
>>>>>>> ef454668b094ed648e94e17d925e51a7f585f6bd
}