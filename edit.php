<?php
include("conexion-barbara.php");
$perfiles = "SELECT * FROM perfiles";
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>panel de edicion</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="edit-estilo.css">
</head> 
<body>      
  <div class="container-table container-table--edicion">
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
      <div class="table__item"><?php echo $row["nombre"];?></div>
      <div class="table__item"><?php echo $row["apellido"];?></div>
      <div class="table__item"><?php echo $row["id_estado"];?></div>
      <div class="table__item"><?php echo $row["id_sede"];?></div>
      <div class="table__item"><?php echo $row["ubicacion"];?></div>
      <div class="table__item"><?php echo $row["telefono"];?></div>
      <div class="table__item">
         <a href="actualizar.php?id=<?php echo $row["id_ci"];?>" class="table__item__link">editar</a>|

         <a href="procesar-eliminar.php?id=<?php echo $row["id_ci"];?>" class="table__item__link">eliminar</a>
      </div>
      <?php } mysqli_free_result($resultado); ?>
 </div>
 <script src="confirmacio.js"></script>
</body>    