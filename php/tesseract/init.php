<?php

if (!isset($_FILES["image1"])){
    exit("no hay imagen");
}

$imagen = $_FILES["image1"];
$ubicacionimg = $imagen["tmp_name"];

$comando = "tesseract " . escapeshellarg($ubicacionimg) . " stdout -l spa debug_file=/dev/null";

exec($comando, $textodetectado, $codigosalida);

if($codigosalida == 0){

    echo "<p>El texto detectado es: </p>";
    $textocomocadena = join("\n", $textodetectado);
    echo "<form action='php/fpdf/epdf.php' target='_blank' name='scan' method='post'>
          <textarea type='textarea' name='textscan' class='edit-scan' value='".$textocomocadena."'>".$textocomocadena."</textarea>";
    echo "<br><input class='btn btn-defaul' type='submit' name='scans'>";
    echo "</form>";
    

}else{
    echo "Error detectando texto";
}