<?php

include '../php/conx.php';

function replaceArrows(string $text): string
{
    $text = str_replace("\\", "<i class='bi bi-arrow-right'></i>", $text);
    return $text;
}

$conn = new Conexion();

$id = $_POST['id'];

$sql = $conn->query("SELECT * FROM auditoria WHERE id = $id");

$c = $sql->fetch_object();

if ($sql == true) {

    $pre = explode(" -- ", $c->cambios);

    echo '<h6 class="px-2 mt-4 panel-color">' . $pre[0] . '</h6>';
    echo "<hr style='border-color: black;'>";
    unset($pre[0]);

    echo '<hr>';
    foreach ($pre as $text) {
        $text = replaceArrows($text);

        echo "<p class='panel-color'>".ucwords(strtolower($text)) . "</p>";
    }
}