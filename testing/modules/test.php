<?php

include "../../php/class/conx.php";

// ########### FUNCTION SECCTION #############
include "../../php/function/criptCodes.php";
include "../../php/function/getUser.php";

// ########### CLASS SECCTION #############
include "../../php/class/registroAuditoria.php";
include "../../php/class/auditoria/auditoria.php";
include "../../php/class/estadisticas.php";
include "../../php/class/gestiones.php";
include "../../php/class/personal/personal.php";
include "../../php/class/personal/personalDetails.php";
include "../../php/class/personal/user.php";

$new = new Estadistica;

print_r($new->userInixStats(date('y-m-d')));