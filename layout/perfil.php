<!--PERFIL BÁSICO DEL USUARIO-->
<div class="perfil" id="perfil">
    <div class="col-lg">
        <p id="ptittle">Perfil</p>

    </div>
    <div class="row justify-content-center align-items-center g-2 mb-3">
        <div class="col">
            <a><i class="bi bi-person-square"></i></a>
        </div>
        <div class="col">
            <label class="labperfil">nombre
                <?php
                echo '<p>' . $pName . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">cedula
                <?php
                echo '<p>' . $pCi . '</p>';
                ?>
            </label>
        </div>
        <div class="col"><label class="labperfil">sexo
                <?php
                echo '<p>' . $pSexo . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">grado academico
                <?php
                echo '<p>' . $pGrado . '</p>';
                ?>
            </label>
        </div>
    </div>
    <div class="row justify-content-center align-items-center g-2 mb-5">
        <div class="col">
            <label class="labperfil">fecha de nacimiento
                <?php
                echo '<p>' . $pFecha . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">tel&eacute;fono
                <?php
                echo '<p>' . $pPhone . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">correo
                <?php
                echo '<p>' . $pEmail . '</p>';
                ?>
            </label>
        </div>

        <div class="col">
            <label class="labperfil">cargo
                <?php
                echo '<p>' . $pCargo . '</p>';
                ?>
            </label>
        </div>
    </div>
    <div class="row justify-content-center align-items-center g-2 mb-3">
        <div class="col">
            <label class="labperfil">estado
                <?php
                echo '<p>' . $pStado . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">ciudad
                <?php
                echo '<p>' . $pCiudad . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">direcci&oacute;n
                <?php
                echo '<p>' . $pDireccion . '</p>';
                ?>
            </label>
        </div>
        <div class="col">
            <label class="labperfil">sede
                <?php
                echo '<p>' . $pSede . '</p>';
                ?>
            </label>
        </div>
    </div>
</div>