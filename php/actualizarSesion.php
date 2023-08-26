<?php

// Establecer la duración de la sesión
ini_set('session.cookie_lifetime', 600); // un minuto para pruebas 
include("conx.php");

@session_start();

$conn = new Conexion();

// REESTABLECER EVENTO EN BDs
if(isset($_SESSION['event'])){ 
    include("function/sumarhora.php");

    $na = $_SESSION['sesion'];
    $nueva_hora = hora10();
    $evento  = $_SESSION['event'];

    $delevent = "DROP EVENT IF EXISTS $evento";
    $sql = $conn->query($delevent);

    $event = "CREATE EVENT $evento ON SCHEDULE AT '$nueva_hora' DO UPDATE registro r SET sesion = '0' WHERE r.id_usuario = '$na'";                
    $sql = $conn->query($event);

}

// Actualizar la última actividad de la sesión
$_SESSION['LAST_ACTIVITY'] = time();