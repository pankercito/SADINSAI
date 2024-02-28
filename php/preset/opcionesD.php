<?php

if (!class_exists("Conexion")) {
    include "../php/class/conx.php";
}

$conn = new Conexion;

$d = $conn->query("SELECT * FROM `departamentos`");

while ($row = $d->fetch_object()) {
    ?>
    <option value="<?php echo $row->id_direccion ?>">
        <?php echo $row->dir_nombre ?>
    </option>
    <?php
}