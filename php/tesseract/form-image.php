<div class="scan-form">
    <form action="?result" enctype="multipart/form-data" method="post">
        <input class="btn btn-defaul" type="file" name="image1" REQUIRED>
        <br>
        <br>
        <button class="btn btn-defaul" type="sumbit">ir</button>
    </form>
</div>
<?php

if(isset($_GET['result'])){
    include("init.php");
}