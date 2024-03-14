<style>
    .classErrorInput {
        border: solid red 1px;
        box-shadow: 0px 1.5px 2px 1px #ff000059;
        border-radius: 14;
    }
</style>

<?php

session_start();

$planilla = $_POST['planilla'];

include "planilla-" . $planilla . ".php";