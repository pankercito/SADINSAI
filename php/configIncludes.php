<?php

if (!class_exists("Conexion")) {
    include "../php/class/conx.php";
}

// ########### FUNCTION SECCTION #############

if (!function_exists("encriptar")) {
    include "../php/function/criptCodes.php";
}
include "../php/function/getUser.php";
include "../php/function/getESCName.php";
include "../php/function/idGenerador.php";
include "../php/function/fHead.php";
include "../php/function/dec.php";
include "../php/function/adminSet.php";
include "../php/function/filesFunctions.php";
include "../php/function/sumarhora.php";
include "../php/function/removerAcentos.php";
include "../php/function/tpName.php";

// ########### CLASS SECCTION #############
include "../php/class/auditoria/auditoria.php";
include "../php/class/personal/personalDetails.php";
include "../php/class/personal/personal.php";
include "../php/class/personal/user.php";
include "../php/class/personal/empleado.php";
include "../php/class/auditoria/userAuditoria.php";
include "../php/class/auditoria/auditoriaGeneral.php";
include "../php/class/auditoria/gestionesAuditoria.php";
include "../php/class/auditoria/solicitudesAuditoria.php";
include "../php/class/userUseCase.php";
include "../php/class/gestiones.php";
include "../php/class/estadisticas.php";
include "../php/class/solicitudes.php";
include "../php/class/sys_usuarios.php";
include "../php/class/registroAuditoria.php";