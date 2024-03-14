<?php
// Conexión a la base de datos
include "../php/configIncludes.php";

$conn = new Conexion();
// Escapar los caracteres especiales
$taken = $conn->real_escape( $_POST["nameArchive"]);
$tipeArch = $conn->real_escape($_POST["gestionArch"]);
$ci = $conn->real_escape(desencriptar($_POST["ciArch"]));
$note = $conn->real_escape(cor_acentos($_POST["textArchive"]));
$carion = $_FILES["inpArch"]["name"];
$arch = $_FILES["inpArch"]["tmp_name"];

// Obtener la ruta de la carpeta
$folDestino = '../data/archives/' . $tipeArch;

// id para archivoss y Consulta de ID
do {
    $id = generarId() . generarId();
    $sql = $conn->query("SELECT id_archivo FROM archidata WHERE id_archivo = $ci");
    $dan = mysqli_num_rows($sql);
} while ($dan != 0);

// nombre de archivo
$nombreArch = ($taken == "") ? $ci . "=" . $carion : $ci . "=" . $taken;

// Mover archivos E Inyeccion
if (moveFile($arch, $folDestino, $nombreArch) == true) {//mover archivos a la ruta espesifica
    // Variables de archivos
    @session_start();

    $idUserAg = $_SESSION['sesion'];
    $size = $_FILES["inpArch"]["size"];
    $fech = hora();
    $direccion = $folDestino . "/" . $nombreArch;
    $tipo = extencion($carion);

    // Inyección a BD
    $sql = "INSERT INTO archidata (id_archivo, ci_arch,  archivo, note, nombre_archivo,  size) VALUES ('$id', '$ci', '$tipo', '$note', '$taken', '$size')";

    $sql1 = "INSERT INTO arch_direc (id_arch, id_user_sub, id_tipo, direccion, fecha) VALUES ('$id', '$idUserAg', '$tipeArch', '$direccion', '$fech')";

    if ($conn->query($sql) && $conn->query($sql1)) {
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "error";
}