<?php
include("conexion-barbara.php");
$perfiles = "SELECT * FROM perfiles";
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>usuarios</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="edit-estilo.css">
</head> 
<body>      
  <div class="container-table">
      <div class="table__title">datos de usuarios<a href="edit.php"class="title_edit">editar</a></div>
      <div class="table__header">nombre</div>
      <div class="table__header">apellido</div>
      <div class="table__header">id_estado</div>
      <div class="table__header">id_sede</div>
      <div class="table__header">ubicacion</div>
      <div class="table__header">telefono</div>
      <?php $resultado = mysqli_query($conexion, $perfiles);
      while($row=mysqli_fetch_assoc($resultado)) {?>
      <div class="table_item"><?php echo $row["nombre"];?></div>
      <div class="table_item"><?php echo $row["apellido"];?></div>
      <div class="table_item"><?php echo $row["id_estado"];?></div>
      <div class="table_item"><?php echo $row["id_sede"];?></div>
      <div class="table_item"><?php echo $row["ubicacion"];?></div>
      <div class="table_item"><?php echo $row["telefono"];?></div>
      <?php } mysqli_free_result($resultado); ?>
 </div>
</body>    