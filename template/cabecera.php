
<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="shortcut icon" href="img/Botella.ico">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
   

</head>
<body>
    

    <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php"> Deadmanstale</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">



                <li class="nav-item active">
                    <a class="nav-link" href="productos.php">Tienda <span class="sr-only"></span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Inicio de sesion <span class="sr-only"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mostrarCarrito.php">Carrito </a>
                </li>
                
            </ul>
           
        </div>
    </nav>

    <br/>
    <br/>
    <div class="container text-center">

   <div class="row"> 
