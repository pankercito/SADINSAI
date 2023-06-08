<?php

include('conect.php');

if($_POST["ci"] != ""){
  // Verificación de la CI ingresada en la base de datos
  $com = mysqli_real_escape_string($connec, $_POST["ci"]);

  $sql = "SELECT * FROM personal WHERE ci = $com";

  $result = mysqli_query($connec, $sql);
  if($result->num_rows > 0) {  
    $sql = "SELECT * FROM registro WHERE ci = $com";
    $result = mysqli_query($connec, $sql);

    if($result->num_rows > 0){
      echo "¡La CI ingresada ya está registrada!";//esta en ambos
    }else{
      echo "true";//no esta en registro pero si en personal
    }
  }else{
    echo "!registra primero¡"; //no esta en personal
  }
  $connec->close();
}else{
  echo "false"; //vacio
}
