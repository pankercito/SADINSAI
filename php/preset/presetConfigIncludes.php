<?php

if (!class_exists("Conexion")) {
    include "../class/conx.php";
}

// ########### FUNCTION SECCTION #############

if (!function_exists("encriptar")) {
    include "../function/criptCodes.php";
}
include "../function/getUser.php";
include "../function/getESCName.php";
include "../function/idGenerador.php";
include "../function/fHead.php";
include "../function/dec.php";
include "../function/adminSet.php";
include "../function/filesFunctions.php";
include "../function/sumarhora.php";
include "../function/tpName.php";

// ########### CLASS SECCTION #############
include "../class/auditoria/auditoria.php";
include "../class/personal/personalDetails.php";
include "../class/personal/personal.php";
include "../class/personal/user.php";
include "../class/personal/empleado.php";
include "../class/auditoria/userAuditoria.php";
include "../class/auditoria/auditoriaGeneral.php";
include "../class/auditoria/gestionesAuditoria.php";
include "../class/auditoria/solicitudesAuditoria.php";
include "../class/userUseCase.php";
include "../class/gestiones.php";
include "../class/estadisticas.php";
include "../class/solicitudes.php";
include "../class/sys_usuarios.php";
include "../class/registroAuditoria.php";