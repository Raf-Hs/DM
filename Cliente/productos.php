<?php include("template/cabecera.php"); 
 include 'carrito.php';
 include '../global/config.php';
include '../global/conexion.php';

?>

<?php


$po=mysqli_connect($host,$user,$password,$db);


if($pdo===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")

{

   
   
	$sucursal=$_POST["sucursal"];
    $_SESSION["sucursal"]=$sucursal;
   
    $result = $conexion->prepare("select * from producto ");
    $result->execute();
    $row = $result->fetch();

   

	?>






        <?php if($mensaje!=""){?>

        <div class="alert alert-success">
        <br>
            <?php
            
            echo $mensaje;
            ?>
            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>

            <?php }?>


			
           
        
    </div>

















<?php

 if($sucursal=="MONTERREY"){ 
    $_SESSION["sucursal"]=1;
    $_SESSION["suc"]="MONTERREY";

   
?>



    <div class="row">

    <?php
    
        $sentencia=$pdo->prepare("SELECT 
        inventario.stock,
        producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
        inner join sucursal on (inventario.id_suc=sucursal.id)
        inner join producto on (inventario.id_pro=producto.id)
        where inventario.id_suc = 1 and producto.activo = 1 ");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        


    ?>

     <?php foreach($listaProductos as $producto){?>

        <div class="col-3">
            <div class="card ">
                <img 
                height="317px"
                title="<?php echo $producto['nombre'];?>"
                alt="<?php echo $producto['nombre'];?>"
                class="card-img-top" 
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
                            <input type="text" name="cantidad" id="cantidad" value="" min="1" max="99" placeholder="Cantidad" required>
                       
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
 }


	elseif($sucursal=="GUADALAJARA")

  
	{
        $_SESSION["sucursal"]=2;
        $_SESSION["suc"]="GUADALAJARA";
        ?>


<div class="row">

<?php

    $sentencia=$pdo->prepare("SELECT 
    inventario.stock,
    producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
    inner join sucursal on (inventario.id_suc=sucursal.id)
    inner join producto on (inventario.id_pro=producto.id)
    where inventario.id_suc = 2 and producto.activo = 1");
    $sentencia->execute();
    $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    


?>

 <?php foreach($listaProductos as $producto){?>

    <div class="col-3">
        <div class="card ">
            <img 
            height="317px"
            title="<?php echo $producto['nombre'];?>"
            alt="<?php echo $producto['nombre'];?>"
            class="card-img-top" 
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
                        <input type="text" name="cantidad" id="cantidad" value="" min="1" max="99" placeholder="Cantidad" required>
  
                       


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


	<?php
    }
    ?>

		

		
<?php
	
    }
	elseif($sucursal=="QUERETARO")

	{
        
        $_SESSION["sucursal"]=3;
        $_SESSION["suc"]="QUERETARO";
        ?>

<div class="row">

    <?php
    
        $sentencia=$pdo->prepare("SELECT 
        inventario.stock,
        producto.nombre, producto.id,precio,descripcion,imagen,activo  from inventario
        inner join sucursal on (inventario.id_suc=sucursal.id)
        inner join producto on (inventario.id_pro=producto.id)
        where inventario.id_suc = 3 and producto.activo = 1");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        


    ?>

     <?php foreach($listaProductos as $producto){?>


        <div class="col-3">
            <div class="card ">
                <img 
                height="317px"
                title="<?php echo $producto['nombre'];?>"
                alt="<?php echo $producto['nombre'];?>"
                class="card-img-top" 
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
                            <input type="hidden" name="sucursala" id="sucursala" value="3">
                            <input type="text" name="cantidad" id="cantidad" value="" min="1" max="99" placeholder="Cantidad" required>

                            

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
    
       
		
        <?php
    }
    ?>
		

		
        <?php
	}

	else

	{ ?>

        <h5 class="card-title"> La sucursal no existe</h5>
        <br>

	<?php } 

}


?>
<form action="#" method="POST">
<div>
	<label>Sucursal</label>

	<input type="TEXT" name="sucursal" value="" required>
	<input type="submit" value="Entrar"  >
</div>

</form>



<!--<form action="#" method="POST">
<div>
	<label>Sucursal</label>
   
	
    <select name="sucursal" required  <?php echo ($_SESSION['CARRITO']<5)?"disabled":""; ?>>
    <option VALUE="MONTERREY">MONTERREY </option>
     <option VALUE="GUADALAJARA">GUADALAJARA  </option>
     <option VALUE="QUERETARO">QUERETARO </option>
   
/*

*/
</select>
	<input type="submit" value="sucursal">
</div>

</form>
-->



        <br>
<br>



<?php  

    include 'template/pie.php';
?>



