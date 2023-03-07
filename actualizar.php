<?php
include("conexion-barbara.php");
$id = $_GET["id"];
$perfiles = "SELECT * FROM perfiles WHERE id_ci = '$id'";
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>actualicion</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="edit-estilo.css">
</head> 
<body>      
  <from class="container-table container-table--edicion" action="procesar-editar.php" method="post">
      <div class="table__title table__title--edicion">datos de usuarios</div>
      <div class="table__header">nombre</div>
      <div class="table__header">apellido</div>
      <div class="table__header">id_estado</div>
      <div class="table__header">id_sede</div>
      <div class="table__header">ubicacion</div>
      <div class="table__header">telefono</div>
      <div class="table__header">operacion</div>
      <?php $resultado = mysqli_query($conexion, $perfiles);
      while($row=mysqli_fetch_assoc($resultado)) {?>
      <input type="hidden" class="table__item" vaule="<?php echo $row["id_ci"];?>" name="id">
      <input type="text" class="table__input" vaule="<?php echo $row["nombre"];?>" name="nombre">
      <input type="text" class="table__input" vaule="<?php echo $row["apellido"];?>" name="apellido">
      <input type="text" class="table__input" vaule="<?php echo $row["id_estado"];?>" name="id_estado">
      <input type="text" class="table__input" vaule="<?php echo $row["id_sede"];?>" name="id_sede">
      <input type="text" class="table__input" vaule="<?php echo $row["ubicacion"];?>" name="ubicacion">
      <input type="text" class="table__input" vaule="<?php echo $row["telefono"];?>" name="telefono">
      <?php } mysqli_free_result($resultado); ?>
      <input type="submit" vaule="actualizar" class="container__submit container__submit--actualizar">
  </from>
</body>