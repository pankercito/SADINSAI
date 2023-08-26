<?php 
// Conexión a la base de datos
include("php/function/removerAcentos.php");
include("php/function/idGenerador.php");
include("php/conx.php");

// Escapar los caracteres especiales
$taken = mysqli_real_escape_string($connec, remover_acentos($_POST["nameArchive"]));
$tipeArch = mysqli_real_escape_string($connec, $_POST["gestionArch"]);
$ci = mysqli_real_escape_string($connec, $_POST["ciArch"]);
$note = mysqli_real_escape_string($connec, remover_acentos($_POST["textArchive"]));
$carion = basename($_FILES["inpArch"]["name"]);

// Obtener la ruta de la carpeta
$folDestino = 'data/archives/' . $tipeArch;
if (!file_exists($folDestino)) {
    mkdir($folDestino, 0777, true);
    echo "creado";
}

$taken = generarId() . generarId() .  "==" . $carion;

// Guardar la imagen en la carpeta
if(!file_exists($folDestino.$taken)){
        if(move_uploaded_file($_FILES["inpArch"]["tmp_name"], $folDestino ."/". $taken)){
            echo "success";
        } else {
            echo "error";
        }
} else {
       echo "Archivo ya existe";
}