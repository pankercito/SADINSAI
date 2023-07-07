<div class="centro col-lg-12" id="centroEdit">
  <?php include_once("../php/editSet.php")?>
  <div class="contenido1" id="editSet" display="none">
    <form action="../php/registroSolicitud.php" method="post" id="editForm" name="xdit">
    <h4>Editar perfil</h4>
        <div class="lmao row">
          <div class="one row">
            <p>Nombre </p>
            <input id="Name" name="name" type="text" value="<?php echo $SetName?>">
            <p>Cedula </p>
            <input id="Ci" name="ci" type="int" onblur="verificarCI()" value="<?php echo $SetCi?>">
            <div id="mensajeCi"></div>
          </div>
          <div class="two row">
            <p>Apellido </p>
            <input id="Apellido" name="apellido" type="text" value="<?php echo $SetApellido?>">
            <p>Telefono </p>
            <input id="Phone" name="telefono" type="text" maxlength="11" value="<?php echo $SetPhone?>">
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
            <input id="Email" name="email" type="text" value="<?php echo $SetEmail?>">
          </div>
          <div class="two row">
            <p>Direcci&oacute;n</p>
            <input id="Direccion" name="direccion" type="text" value="<?php echo $SetDireccion?>">
          </div>
        </div>
        <br>
        <button class="btn btn-warning" id="log" type="submit" name="editLog">Solicitar cambio</button>
      </form>
      <script type="text/javascript">
        var idE = <?php echo $SetIdEstado?>;
        var idC = <?php echo $SetIdCiudad?>;
        var idS = <?php echo $SetIdSede?>;
      </script>
      <link rel="stylesheet" href="../styles/editarUsuarios.css">
  </div>
  <script type="text/javascript">
    // Datos del formulario precargados
    const datosFormularioPre = {
          "nombre": "<?php echo $SetName?>",
          "cedula": "<?php echo $SetCi?>",
          "apellido": "<?php echo $SetApellido?>",
          "telefono": "<?php echo $SetPhone?>",
          "estado": "<?php echo $SetEstado?>",
          "ciudad": "<?php echo $SetCiudad?>",
          "sede": "<?php echo $SetSede?>",
          "email": "<?php echo $SetEmail?>",
          "direccion": "<?php echo $SetDireccion?>"
          // Agrega aquí los demás campos del formulario
      };
  </script>
  <script src="../js/editUserModal.js"></script>
</div>