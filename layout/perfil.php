<!--PERFIL BÁSICO DEL USUARIO-->
<div class="perfil" id="perfil">
    <div class="col-lg">
        <p id="ptittle">Perfil</p>
        <a>
            <i class="bi bi-person-square"></i>
        </a>
    </div>
    <div class="plist1 row">
        <div class="name form-group">
            <label class="labperfil" class="labperfil">Nombre
                <?php
                echo '<p>' . $pName . '</p>';
                ?>
            </label>
        </div>
        <div class="ci form-group">
            <label class="labperfil">Cedúla
                <?php
                echo '<p>' . $pCi . '</p>';
                ?>
            </label>
        </div>
        <div class="phone form-group">
            <label class="labperfil">Tel&eacute;fono
                <?php
                echo '<p>' . $pPhone . '</p>';
                ?>
            </label>
        </div>
        <div class="email form-group">
            <label class="labperfil">Correo
                <?php
                echo '<p>' . $pEmail . '</p>';
                ?>
            </label>
        </div>
    </div>
    <div class="plist2 row">
        <div class="state form-group">
            <label class="labperfil">Estado
                <?php
                echo '<p>' . $pStado . '</p>';
                ?>
            </label>
        </div>
        <div class="ciudad form-group">
            <label class="labperfil">Ciudad
                <?php
                echo '<p>' . $pCiudad . '</p>';
                ?>
            </label>
        </div>
        <div class="direccion form-group">
            <label class="labperfil">Direcci&oacute;n
                <?php
                echo '<p>' . $pDireccion . '</p>';
                ?>
            </label>
        </div>
        <div class="sede form-group">
            <label class="labperfil">Sede
                <?php
                echo '<p>' . $pSede . '</p>';
                ?>
            </label>
        </div>
        <div class="cargo form-group">
            <label class="labperfil">Cargo
                <?php
                echo '<p>' . $pName . '</p>';
                ?>
            </label>
        </div>
    </div>
</div>