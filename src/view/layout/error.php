<?php $app = \app\App::get();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Title -->
    <title>Greška</title>

    <!-- Favicon -->
    <link rel="icon" href="<?=$app->resource('img/core-img/favicon.ico')?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=$app->resource('style.css')?>">

</head>

<body>
    <div class="alert alert-danger" role="alert">
        Greška: <br>
        <?=$content?>
    </div>   
    <script src="<?=$app->resource('js/bootstrap/bootstrap.min.js')?>"></script>
</body>



