


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>



  </head>
  <body>

    <?php  $url="http://".$_SERVER['HTTP_HOST']."/luran/Admin/" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>index.php">Inicio</a>
           
            <a class="nav-item nav-link" href="<?php echo $url;?>productos.php">Productos</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>usuarios.php">Usuarios</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>clientes.php">Clientes</a>
          
            <a class="nav-item nav-link" href="<?php echo $url;?>cerrar.php">Cerrar</a>

            
        </div>
    </nav>
  <div class="container">
  <br/>
          <div class="row">