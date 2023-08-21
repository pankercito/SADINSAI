<link rel="stylesheet" href="../styles/cards.css">
<?php
         for($i = 0; $i < 6; $i++){  
            echo '
            <div class="card">
              <div class="card__image-holder">
                <img class="card__image" src="' . @$image .'" alt="fotos" />
              </div>
              <div class="card-title">
                <a href="#" class="toggle-info btn btn-success">
                  <span class="left"></span>
                  <span class="right"></span>
                </a>
                <h2>
                  ' . @$name . ' Titulo
                  <small>Subido el'. @$fecha .'</small>
                </h2>
              </div>
                <div class="card-flap flap1">
                <iframe src="" width="30%" height="30%" frameborder="0" scrolling="yes"></iframe>
                  <div class="card-description">
                    <p>Nota: 
                      <br>' . @$nota . ' 
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
                    </p>
                    <div class="strContent d-flex mx-auto">
                      <p class="str mx-auto">subido por ' . @$userName . ' EikerR </p>
                      <span class="c"> | </span>
                      <p class="str mx-auto text-center">tamaño ' . @$zica . ' 1.3MB </p>
                    </div>
                  </div>
                <div class="card-flap flap2">
                  <div class="card-actions">
                    <a href="#" class="btn btn-primary">Abrir</a>
                    <a href="#" class="btn btn-secondary">Editar</a>
                  </div>
                </div>
              </div>
            </div>';
}
?>
<script src="../js/cards.js"></script>