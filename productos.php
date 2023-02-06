<?php include("template/cabecera.php"); 
 //include 'carrito.php';
 include 'global/config.php';
include 'global/conexion.php';
?>

<?php

if($pdo===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")

{


   
    $result = $pdo->prepare("select * from producto ");
    $result->execute();
    $row = $result->fetch();

}

	?>

        <?php if(""){?>

        <div class="alert alert-success">
        <br>
            <?php
           
            echo $mensaje;
            ?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>

            <?php } else?>
            <?php


            
            ?>

			
           
        
    </div>

    <div class="row">

    <?php
    
        $sentencia=$pdo->prepare("SELECT 
        inventario.stock,
        producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
        inner join sucursal on (inventario.id_suc=sucursal.id)
        inner join producto on (inventario.id_pro=producto.id)
        where  producto.activo = 1 ");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        


    ?>

     <?php foreach($listaProductos as $producto){?>

        <div class="col-3 mt-4">
            <div class="card ">
                <img 
                height="317px"
                title="<?php echo $producto['nombre'];?>"
                alt="<?php echo $producto['nombre'];?>"
                class="card-img-top mt-3"  
                src="../../img/<?php echo $producto['imagen'];?>" 
                data-bs-toggle="popover"
                data-trigger="hover"
                data-bs-content="<?php echo $producto['descripcion'];?>"
                
                >
                
                
                

                <div class="card-body">
                    <span><?php echo $producto['nombre'];?></span>
                    <h5 class="card-title">$<?php echo $producto['precio'];?></h5>
                    

                    <form action="" method="POST">

                            <input type="hidden" name="id" id="id" value="<?php echo $producto['id']; ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre'];?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'];?>">
                            
                       
                        <button class="btn btn-primary" 
                                name="btnAccion" 
                                value="Agregar" 
                                type="submit" >
                            Agregar al carrito
                        </button>

                    </form>


                   

                </div>
            </div>
        </div>
    
    
    <?php }  ?>

   
    
</div>

<?php  
    include 'template/pie.php';
?>




