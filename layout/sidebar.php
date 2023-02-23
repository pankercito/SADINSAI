<div class="croma col-lg-12  col-ms-12">
    <?php    
        echo '<p class="welcome">¡Bienvenido '.$wname.' '.$wlastname.'!</p>';
    ?>
    <?php
        if (isset($_GET["perfil"])){
            include('archives.php');
        }
    ?>
</div>