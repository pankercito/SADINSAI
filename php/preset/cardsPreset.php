<?php
include("../php/function/getUser.php");

$ci = desencriptar($_GET['carga']);
$tipo = $_GET['gestion'];

$sql =   $com = $conn->query("SELECT * FROM archidata a 
                              INNER JOIN arch_direc d 
                              INNER JOIN registro r
                              ON d.id_arch = a.id_archivo 
                              WHERE d.id_tipo = $tipo 
                              AND a.ci_arch = $ci
                              AND d.Id_user_sub = r.id_usuario
                              ORDER BY d.fecha DESC");
$nums = mysqli_num_rows($sql);

for ($i = 0; $i < $nums; $i++) {
    $row = mysqli_fetch_assoc($sql);

    $image = $row['direccion'];
    $nameSet = $row['nombre_archivo'];
    if (strlen($nameSet) > 15) {
        $q = 1;
        $name = substr($nameSet, 0, 15) . "...";
    }else{
        $q = 0;
        $name = $nameSet;
    }
    $f = ($q == 1) ? $nameSet : ""; 
    $fecha = $row['fecha'];
    $tipoDarch = $row['archivo'];
    $note = ($row['note'] == '') ? "sin nota": $row['note'];
    $userName = '<a href="principal.php?perfil=' . encriptar($row['ci']) .'">' . getUser($row['Id_user_sub'], "") . '</a>';
    $c = ($row['size'] / 1024);
    $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c /1024, 2) . "MB";

    if ( $tipoDarch != "pdf"){
        $d = '<img class="card__image" src="' . @$image . '" alt="fotos" width="298" height="223.5"/>';
    } else {
        $d = '<iframe src="' . @$image . '" scrolling="yes"  title="'. @$name .'" width="298" height="223.5">documento</iframe>';
    }

    echo '
    <div class="card">
      <div class="card__image-holder">
        ' . @$d . '
      </div>
      <div class="card-title">
        <a href="#" class="toggle-info btn btn-success">
          <span class="left"></span>
          <span class="right"></span>
        </a>
        <div class="titleti" style="width: 16rem;
        padding: 10px 1rem 0 0;">
        <h4 style="">
          ' . @$name . '  
        </h4>
        </div>
        <br>
        <div class="subtitle">
          <small style="color: #7a7a7a;">Subido el' . @$fecha . '</small>
        </div>
      </div>
        <div class="card-flap flap1">
          <h6 class="mx-3">'. $f. '</h6>
          <div class="card-description">
            <p>Nota: 
              <br>' . @$note . ' 
            </p>
            <div class="strContent d-flex mx-auto">
              <p class="str mx-auto">subido por ' . @$userName . ' </p>
              <span class="c"> | </span>
              <p class="str mx-auto text-center">tamaño ' . @$size . ' </p>
            </div>
          </div>
        <div class="card-flap flap2">
          <div class="card-actions">
            <a href="' . @$image . '" class="btn btn-primary" download="My File.pdf">Abrir</a>
            <a href="#" class="btn btn-secondary">Editar</a>
          </div>
        </div>
      </div>
    </div>';
}