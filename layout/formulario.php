<div class="contenido1">
  <form action="../php/registroPersonal.php" method="post">
    <div class="lmao row">
      <div class="one row">
        <label for="Name">Nombre</label>
        <input id="Name" name="name" type="text">
        <label for="Ci">Cedula</label>
        <input id="Ci" name="ci" type="num" onblur="verificarCI()">
        <div id="mensajeCi"></div>
      </div>
      <div class="two row">
        <label for="Apellido">Apellido </label>
        <input id="Apellido" name="apellido" type="text">
        <label for="Phone">Telefono </label>
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
        <label for="Email">Email</label>
        <input id="Email" name="email" type="text">
      </div>
      <div class="two row">
        <label for="Direccion">Direccion</label>
        <input id="Direccion" name="direccion" type="text">
      </div>
    </div>
    <br>
    <button class="btn btn-lg btn-warning" id="log" type="submit" name="registrar" disabled>Registrar</button>
  </form>
  <script src="../js/formRegistroValidacion.js"></script>
  <script src="../js/selectorScript.js"></script>
  <script src="../js/activarInput.js"></script>
</div>