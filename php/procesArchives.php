<?php
// Conexión a la base de datos
include("../php/conect.php");
include("../php/funtion/removerAcentos.php");
include("../php/funtion/idGenerador.php");
include("../php/funtion/sumarHora.php");

// Escapar los caracteres especiales
$taken = mysqli_real_escape_string($connec, $_POST["nameArchive"]);
$tipeArch = mysqli_real_escape_string($connec, $_POST["gestionArch"]);
$ci = mysqli_real_escape_string($connec, $_POST["ciArch"]);
$note = mysqli_real_escape_string($connec, remover_acentos($_POST["textArchive"]));
$carion = basename($_FILES["inpArch"]["name"]);

// Obtener la ruta de la carpeta
$folder_des = '../data/archives/' . $tipeArch;
if (!file_exists($folder_des)) {
    mkdir($folder_des, 0777, true);
    echo "creado";
}

// id para archivoss
$id = generarId() . generarId();

// nombre de archivo
if ($taken == "") {
    $aa = $id . "=" . $carion;
} else {
    $aa = $id . "=" . $taken;
}

// Guardar la imagen en la carpeta
if (move_uploaded_file($_FILES["inpArch"]["tmp_name"], $folder_des . "/" . $aa)) {
    // si el archivo se movio correctamente
    if (file_exists($folder_des . "/" . $aa)) {

        // Variables de archivos
        session_start();
        $ciAg = $_SESSION['cidelusuario'];
        $nombre = $aa;
        $size = $_FILES["inpArch"]["size"];
        $fech = hora();
        $dirreccion = $folder_des . "/" . $aa;

        // inyeccion a BD
        $sql = "INSERT TO archidata (ci_arch, id_archivo, fecha, archivo, nombre_archivo, size) 
                VALUES ('$ci', '$id', '$fech',  )";


        echo "success";
    }


} else {
    echo "error";
}