<link rel="stylesheet" href="../styles/editarUsuarios.css">
<?php include_once("../php/editSet.php")?>
<div class="contenido1">
  <form action="../php/registroPersonal.php" method="post">
    <div class="lmao row">
      <div class="one row">
        <p>Nombre </p>
        <input id="Name" name="name" type="text" value="<?php echo $SetName?>" disabled>
        <p>Cedula </p>
        <input id="Ci" name="ci" type="int" onblur="verificarCI()" value="<?php echo $SetCi?>" disabled>
        <div id="mensajeCi"></div>
      </div>
      <div class="two row">
        <p>Apellido </p>
        <input id="Apellido" name="apellido" type="text" value="<?php echo $SetApellido?>" disabled>
        <p>Telefono </p>
        <input id="Phone" name="telefono" type="text" maxlength="11" value="<?php echo $SetPhone?>"  disabled>
    </div>
    </div>
    <div class="selects row">
      <div class="sel1">
        <label for="Estados">Estado</label>
        <select id="Estados" name="estado" disabled>
          <option value="">- selecione un estado</option>
          <?php include("../php/preset/stadosForm.php")?>
        </select>
      </div>
      <div class="sel2">
        <label for="Ciudades">Ciudad</label>
        <select id="Ciudades" name="ciudad" disabled>
          <option value="">- selecione una ciudad -</option>
        </select>
      </div>
    </div>
    <div class="lmao row">
      <div class="sel3">
        <label for="Sede">Sede</label>
        <select id="Sede" name="sede" disabled>
          <option value="">- selecione una sede-</option>
        </select>
      </div>
    </div>
    <div class="lmao row">
      <div class="one row">
        <p>Correo</p>
        <input id="Email" name="email" type="text" value="<?php echo $SetEmail?>" disabled>
      </div>
      <div class="two row">
        <p>Direcci&oacute;n</p>
        <input id="Direccion" name="direccion" type="text" value="<?php echo $SetDireccion?>" disabled>
      </div>
    </div>
    <br>
    <button class="btn btn-warning" id="log" type="submit" name="registrar" disabled>Guardar cambios</button>
  </form>
</div>