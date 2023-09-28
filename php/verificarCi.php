<?php

include('conx.php');

$conn = new Conexion;

if($_POST["ci"] != ""){
  // Verificación de la CI ingresada en la base de datos
  $com = $conn->real_escape($_POST["ci"]);

  $sql = "SELECT * FROM personal WHERE ci = $com";

  $result = $conn->query( $sql);
  if($result->num_rows > 0) {  
    $sql = "SELECT * FROM registro WHERE ci = $com";
    $result =  $conn->query( $sql);

    if($result->num_rows> 0){
      session_start();
      $_SESSION["recoveryCi"] = $com;
      echo "¡La CI ingresada ya está registrada!";//esta en ambos
    }else{
      echo "true";//no esta en registro pero si en personal
    }
  }else{
    echo "!registra primero¡"; //no esta en personal
  }
}else{
  echo "false"; //vacio
}
