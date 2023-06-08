<?php

if (isset($_GET['perfil'])){
    
    include('conect.php');
    
    $pCi = desencriptar($_GET['perfil']); //dato a comparar
    
    if (isset($pCi)){
        $cnce = mysqli_query($connec, "SELECT * FROM personal p
                                       INNER JOIN estados e ON p.id_estado = e.id_estado
                                       INNER JOIN ciudades c ON p.id_ciudad = c.id_ciudad
                                       INNER JOIN sedes s ON p.sede_id = s.sede_id
                                       WHERE p.ci = $pCi");
                                            
        $count_results = mysqli_num_rows($cnce);

        if ($count_results > 0 ){
            $perfils = mysqli_fetch_array($cnce);

            $pName = ucwords(strtolower(''.$perfils['nombre'].' '.$perfils['apellido'].''));
            $pCi = $perfils['ci'];
            $pPhone = $perfils['telefono'];
            $pEmail =  strtolower($perfils['email']);
            $pDireccion = ucfirst($perfils['direccion']);
            $pStado = $perfils['estado'];
            $pCiudad = $perfils['ciudad'];

        }else{
            $pName = "Sin datos";
            $pCi = "Sin datos";
            $pPhone = "Sin datos";
            $pEmail =  "Sin datos";
            $pDireccion = "Sin datos";
            $pStado = "Sin datos";
            $pCiudad = "Sin datos";
        }
    }else{
        $pName = "Sin datos";
        $pCi = "Sin datos";
        $pPhone = "Sin datos";
        $pEmail = "Sin datos";
        $pDireccion = "Sin datos";
        $pStado = "Sin datos";
        $pCiudad = "Sin datos";
    }
}else{
    echo 'no llego esa mondaa'; 
}
$connec->close();