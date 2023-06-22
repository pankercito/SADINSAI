<?php

$db_host="localhost"; //variables de conexion a base de datos
$db_user="root";
$db_password="";
$db_name="sadinsai";

$connec = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die(mysql_error()); //conexion a base de datos

if (!$connec) { //verificacion de conexion exitosa en la base de datos
    echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
    die;
} 
