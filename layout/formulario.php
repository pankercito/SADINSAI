<div class="contenido1">
  <form action="../php/procesar.php" method="post">
    <div class="lmao row">
      <div class="one row">
        <p>Nombre </p>
        <input name="name" type="text">
        <p>Cedula </p>
        <input name="ci" type="int">
      </div>
      <div class="two row">
        <p>Apellido </p>
        <input name="apellido" type="text">
        <p>Telefono </p>
        <input name="telefono" type="text"> 
    </div>
    </div>
    <div class="selects row">
      <div class="sel1">
        <label for="Estados">Estado</label>
        <select id="Estados" name="estado">
          <option value>- seleciona un Estado -</option>
            <?php 
              include("../php/stadosForm.php")
            ?>
        </select>
      </div>
      <div class="sel2">
        <label for="Ciudades">Ciudad</label>
        <select id="Ciudades" name="ciudad">
          <option value="0">- Seleciona una ciudad -</option>
        </select>
      </div>
    </div>
    <div class="lmao row">
      <div class="one row">
        <p>Correo</p>
        <input name="email" type="text">
      </div>
      <div class="two row">
        <p>Direcci&oacute;n</p>
        <input name="direccion" type="text">
      </div>
    </div>
    <br>
    <button class="btn btn-warning" id="log" type="submit" name="registrar">Registrar</button>
  </form>
  <script src="../js/selectorScript.js"></script>
</div>