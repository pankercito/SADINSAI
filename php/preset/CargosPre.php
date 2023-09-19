<?php

@include('../conx.php');

$conn = new Conexion();

$sql = $conn->query("SELECT * FROM cargo");

if ($sql == true) {
    if ($sql->num_rows > 0) {
        while ($fech = $sql->fetch_assoc()) {
            echo '<option value="' . $fech['id_cargo'] . '">' . $fech['cargo_nombre'] . '</option>';
        }
    } else {
        echo "<option> añadada un cargo </option> ";
    }

}