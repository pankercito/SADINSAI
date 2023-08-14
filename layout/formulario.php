<div class="contenido1">
  <form action="../php/registroPersonal.php" method="post">
    <div class="lmao row">
      <div class="one row">
        <p>Nombre </p>
        <input id="Name" name="name" type="text">
        <p>Cedula </p>
        <input id="Ci" name="ci" type="num" onblur="verificarCI()">
        <div id="mensajeCi"></div>
      </div>
      <div class="two row">
        <p>Apellido </p>
        <input id="Apellido" name="apellido" type="text">
        <p>Telefono </p>
        <input id="Phone" name="telefono" type="text" maxlength="11">
    </div>
    </div>
    <div class="selects row">
      <div class="sel1">
        <label for="Estados">Estado</label>
        <select id="Estados" name="estado">
          <option value="0">- seleciona un Estado -</option>
            <?php 
              include("../php/preset/stadosForm.php")
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
      <div class="sel3">
        <label for="Sede">Sede</label>
        <select id="Sede" name="sede">
          <option value="0">- selecione su sede-</option>
        </select>
      </div>
    </div>
    <div class="lmao row">
      <div class="one row">
        <p>Correo</p>
        <input id="Email" name="email" type="text">
      </div>
      <div class="two row">
        <p>Direcci&oacute;n</p>
        <input id="Direccion" name="direccion" type="text">
      </div>
    </div>
    <br>
    <button class="btn btn-warning" id="log" type="submit" name="registrar" disabled>Registrar</button>
  </form>
  <script src="../js/formRegistroValidacion.js"></script>
  <script src="../js/selectorScript.js"></script>
  <script src="../js/activarInput.js"></script>
</div>