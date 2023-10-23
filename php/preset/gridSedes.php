<?php

$sdonly = $_GET['onlysede'];

$sql = $conn->query("SELECT * FROM personal WHERE sede_id = '$sdonly'");

$count_results = mysqli_num_rows($sql);

if ($count_results !== 0) {
    while ($v = mysqli_fetch_array($sql)) {

        //Lista de los usuarios
        echo '<tr>';
        echo '<td><a></a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" href="perfil.php?perfil=' . encriptar($v['ci']) . '&parce=true">' . $v['ci'] . '</a></td>';
        echo '<td style="border-left: none;"><a class="idsvtate" >' . ucwords(strtolower($v['nombre'])) . '</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">' . ucwords(strtolower($v['apellido'])) . '</a></td>';
        echo '<td style="border-left: 1px solid #dee2e6;"><a class="svtate">' . $v['telefono'] . '</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td><a></a></td>';
    echo '<td style="border-left: none;"><a class="idsvtate">No</a></td>';
    echo '<td style="border-left: none;"><a class="idsvtate">hay</a></td>';
    echo '<td style="border-left: none;"><a class="svtate">registros</a></td>';
    echo '<td style="border-left: none;"><a class="svtate">:(</a></td>';
    echo '</tr>';
}